<?php

namespace App\Http\Controllers;

use App\Enums\DocumentType;
use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Customer;
use App\Services\DocumentNumberService;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    public function listInvoices(Request $request)
    {
        $filter = $request->query('type');

        $invoices = Invoice::with('customer')
            ->when($filter === 'none', fn($q) => $q->whereNull('type'))
            ->when(DocumentType::tryFrom((string) $filter), fn($q, $type) => $q->where('type', $type->value))
            ->get();

        return view('admin.invoice.index', compact('invoices'));
    }

    public function showInvoice(Invoice $invoice)
    {
        if (isset($invoice->due_date)) {
            if (
                $invoice->status !== 'paid' &&
                $invoice->status !== 'cancelled' &&
                $invoice->due_date->isPast()
            ) {
                $invoice->update([
                    'status' => 'overdue',
                ]);
            }
        }


        return view('admin.invoice.show', compact('invoice'));
    }

    public function preview(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoice.pdf', [
            'invoice' => $invoice->load(['customer', 'items']),
        ]);

        return $pdf->stream($invoice->number . '.pdf');
    }

    public function previewPdf(Invoice $invoice)
    {

        $path = 'invoices/' . $invoice->number . '.pdf';

        abort_unless(Storage::disk('private')->exists($path), 404);

        return response()->file(
            Storage::disk('private')->path($path)
        );
    }

    public function generatePdf(Invoice $invoice)
    {
        $invoice->update([
            'issued_at' => now(),
            'due_date' => now()->addDays(30),
        ]);

        $pdf = Pdf::loadView('admin.invoice.pdf', [
            'invoice' => $invoice->load(['customer', 'items'])
        ]);

        $filename = $invoice->number . '.pdf';

        $path = 'invoices/' . $filename;

        Storage::disk('private')->put(
            $path,
            $pdf->output()
        );

        return back()->with('success', 'Le PDF a été généré.');
    }

    public function sentInvoice(Invoice $invoice)
    {
        // Implementation for sending invoice
        $path = 'invoices/' . $invoice->number . '.pdf';

        abort_unless(
            Storage::disk('private')->exists($path),
            404,
            'Le PDF doit être généré avant l\'envoi.'
        );

        Mail::to($invoice->customer->email)
            ->send(new InvoiceMail($invoice, $path));

        $invoice->update(['status' => 'sent']);

        return back()->with('success', 'La facture a été envoyé au client.');
    }

    public function cancelledInvoice(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Impossible d’annuler une facture déjà payée.');
        }

        if ($invoice->status === 'cancelled') {
            return back()->with('error', 'Cette facture est déjà annulée.');
        }

        if ($invoice->paid_amount > 0) {
            return back()->with(
                'error',
                'Impossible d’annuler une facture avec un paiement enregistré.'
            );
        }

        $invoice->update([
            'status' => 'cancelled',
        ]);
        return back()->with('success', 'Cette facture est annulée.');
    }

    public function create()
    {
        $customers = Customer::orderBy('company_name')->get(['id', 'company_name', 'contact_name']);

        return view('admin.invoice.create', compact('customers'));
    }

    public function store(Request $request)
    {
        if ($request->filled('siret')) {
            $request->merge(['siret' => preg_replace('/\s+/', '', $request->siret)]);
        }

        $validated = $request->validate([
            'customer_id'  => ['nullable', 'exists:customers,id'],

            // Nouveau client : obligatoire seulement si aucun client n'est choisi
            'company_name' => ['required_without:customer_id', 'nullable', 'string', 'max:255'],
            'siret'        => ['required_without:customer_id', 'nullable', 'digits:14'],
            'contact_name' => ['required_without:customer_id', 'nullable', 'string', 'max:255'],
            'email'        => ['required_without:customer_id', 'nullable', 'email', 'max:255'],
            'phone'        => ['nullable', 'string', 'max:20'],
            'address'      => ['nullable', 'string', 'max:255'],
            'postal_code'  => ['required_without:customer_id', 'nullable', 'string', 'max:10'],
            'city'         => ['required_without:customer_id', 'nullable', 'string', 'max:255'],
            'country'      => ['required_without:customer_id', 'nullable', 'string', 'max:255'],

            'subject'     => ['required', 'string', 'max:255'],
            'type'        => ['required', Rule::enum(DocumentType::class)],

            // Une seule ligne de prestation
            'designation' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity'    => ['required', 'numeric', 'min:0.01'],
            'unit_price'  => ['required', 'numeric', 'min:0'],
        ]);

        $invoice = DB::transaction(function () use ($validated) {
            $customer = ! empty($validated['customer_id'])
                ? Customer::findOrFail($validated['customer_id'])
                : Customer::firstOrCreate(
                    ['siret' => $validated['siret']],
                    [
                        'company_name' => $validated['company_name'],
                        'contact_name' => $validated['contact_name'],
                        'email'        => $validated['email'],
                        'phone'        => $validated['phone'] ?? null,
                        'address'      => $validated['address'] ?? null,
                        'postal_code'  => $validated['postal_code'],
                        'city'         => $validated['city'],
                        'country'      => $validated['country'],
                    ]
                );

            $total = round($validated['quantity'] * $validated['unit_price'], 2);

            $invoice = Invoice::create([
                'customer_id' => $customer->id,
                'type'        => $validated['type'],
                'number'      => DocumentNumberService::nextInvoiceNumber(),
                'subject'     => $validated['subject'],
                'status'      => 'draft',
                'subtotal'    => $total,
                'discount'    => 0,
                'total'       => $total,
                'paid_amount' => 0,
                'vat_notice'  => 'TVA non applicable, art. 293 B du CGI',
            ]);

            $invoice->items()->create([
                'designation' => $validated['designation'],
                'description' => $validated['description'] ?? null,
                'quantity'    => $validated['quantity'],
                'unit_price'  => $validated['unit_price'],
                'total'       => $total,
            ]);

            return $invoice;
        });

        return redirect()
            ->route('invoices-show', $invoice)
            ->with('success', 'La facture a été créée en brouillon.');
    }
}
