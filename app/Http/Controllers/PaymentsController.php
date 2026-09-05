<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceCancelledMail;
use App\Mail\InvoicePaidMail;
use App\Models\DepositInvoices;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PaymentsController extends Controller
{

    public function store(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['required', 'date'],
            'method' => ['required', 'in:bank_transfer,card,cash,check,other'],
            'reference' => ['nullable', 'string', 'max:255'],
        ]);

        $invoice->payments()->create($validated);

        // Mise à jour du montant payé
        $invoice->increment('paid_amount', $validated['amount']);

        // Mise à jour du statut
        if (!$request->boolean('is_deposit')) {
            if ($invoice->paid_amount >= $invoice->total) {
                $invoice->update([
                    'status' => 'paid'
                ]);
            } else {
                $invoice->update([
                    'status' => 'partially_paid'
                ]);
            }
        }
        if ($request->boolean('is_deposit')) {
            $depositInvoice = $invoice->depositInvoice;

            if ($depositInvoice) {
                $depositInvoice->update([
                    'status' => 'paid',
                ]);
            }
        }


        return redirect()
            ->back()
            ->with('success', 'Le paiement a été ajouté avec succès.');
    }

    public function paidPreview(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoice.status-pdf', [
            'invoice' => $invoice->load(['customer', 'items']),
        ]);

        return $pdf->stream($invoice->number . '.pdf');
    }

    public function generatePaidInvoice(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoice.status-pdf', [
            'invoice' => $invoice->load(['customer', 'items'])
        ]);

        $filename = $invoice->number . '-acquittee.pdf';

        $path = 'invoices/' . $filename;

        Storage::disk('private')->put(
            $path,
            $pdf->output()
        );

        return back()->with('success', 'Le PDF a été généré.');
    }

    public function previewPaidPdf(Invoice $invoice)
    {

        $path = 'invoices/' . $invoice->number . '-acquittee.pdf';

        abort_unless(Storage::disk('private')->exists($path), 404);

        return response()->file(
            Storage::disk('private')->path($path)
        );
    }

    public function sentInvoicePaid(Invoice $invoice)
    {
        // Implementation for sending invoice
        $path = 'invoices/' . $invoice->number . '-acquittee.pdf';

        abort_unless(
            Storage::disk('private')->exists($path),
            404,
            'Le PDF doit être généré avant l\'envoi.'
        );

        Mail::to($invoice->customer->email)
            ->send(new InvoicePaidMail($invoice, $path));

        return back()->with('success', 'La facture acquittée a été envoyé au client.');
    }

    public function cancelledPreview(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoice.status-pdf', [
            'invoice' => $invoice->load(['customer', 'items']),
        ]);

        return $pdf->stream($invoice->number . '.pdf');
    }

    public function generateCancelledInvoice(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoice.status-pdf', [
            'invoice' => $invoice->load(['customer', 'items'])
        ]);

        $filename = $invoice->number . '-annulee.pdf';

        $path = 'invoices/' . $filename;

        Storage::disk('private')->put(
            $path,
            $pdf->output()
        );

        return back()->with('success', 'Le PDF a été généré.');
    }

    public function previewCancelledPdf(Invoice $invoice)
    {

        $path = 'invoices/' . $invoice->number . '-annulee.pdf';

        abort_unless(Storage::disk('private')->exists($path), 404);

        return response()->file(
            Storage::disk('private')->path($path)
        );
    }

    public function sentInvoiceCancelled(Invoice $invoice)
    {
        // Implementation for sending invoice
        $path = 'invoices/' . $invoice->number . '-annulee.pdf';

        abort_unless(
            Storage::disk('private')->exists($path),
            404,
            'Le PDF doit être généré avant l\'envoi.'
        );

        Mail::to($invoice->customer->email)
            ->send(new InvoiceCancelledMail($invoice, $path));

        return back()->with('success', 'La facture annulée a été envoyé au client.');
    }
}
