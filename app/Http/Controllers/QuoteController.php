<?php

namespace App\Http\Controllers;

use App\Mail\QuoteMail;
use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\DocumentNumberService;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::all();
        return view('admin.quotes.index', compact('quotes'));
    }
    public function create()
    {
        return view('admin.quotes.create');
    }

    public function store(Request $request)
    {
        $customer = Customer::create([
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        $issuedAt = Carbon::parse($request->issued_at);

        $quote = Quote::create([
            'customer_id' => $customer->id,
            'number' => DocumentNumberService::nextQuoteNumber(),
            'issued_at' => $issuedAt,
            'valid_until' => $issuedAt->copy()->addDays(30),
            'status' => 'draft',
            'subtotal' => 0,
            'discount' => 0,
            'total' => 0,
        ]);

        return redirect()
            ->route('show-quote', $quote)
            ->with('success', 'Le devis a été créé avec succès. Vous pouvez maintenant ajouter les prestations.');
    }

    public function show(Quote $quote)
    {
        $quote->load('items', 'customer');

        return view('admin.quotes.show', compact('quote'));
    }

    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('list-quotes')->with('success', 'Devis supprimé avec succès.');
    }

    public function preview(Quote $quote)
    {
        $pdf = Pdf::loadView('admin.quotes.pdf', [
            'quote' => $quote->load(['customer', 'items']),
        ]);

        return $pdf->stream($quote->number . '.pdf');
    }

    public function previewPdf(Quote $quote)
    {

        $path = 'quotes/' . $quote->number . '.pdf';

        abort_unless(Storage::disk('private')->exists($path), 404);

        return response()->file(
            Storage::disk('private')->path($path)
        );
    }

    public function generatePdf(Quote $quote)
    {
        $pdf = Pdf::loadView('admin.quotes.pdf', [
            'quote' => $quote->load(['customer', 'items'])
        ]);

        $filename = $quote->number . '.pdf';

        $path = 'quotes/' . $filename;

        Storage::disk('private')->put(
            $path,
            $pdf->output()
        );

        $quote->update([
            'pdf_path' => $path,
        ]);

        return back()->with('success', 'Le PDF a été généré.');
    }

    public function sentQuote(Quote $quote)
    {
        $path = 'quotes/' . $quote->number . '.pdf';

        abort_unless(
            Storage::disk('private')->exists($path),
            404,
            'Le PDF doit être généré avant l\'envoi.'
        );

        Mail::to($quote->customer->email)
            ->send(new QuoteMail($quote, $path));

        $quote->update([
            'status' => 'sent',
        ]);

        return back()->with('success', 'Le devis a été envoyé au client.');
    }

    public function acceptQuote(Quote $quote)
    {
        $quote->update([
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Le devis a été accepté.');
    }

    public function rejectQuote(Quote $quote)
    {
        $quote->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Le devis a été refusé.');
    }

    public function convertToInvoice(Quote $quote)
    {
        abort_unless(
            $quote->status === 'accepted',
            403,
            'Ce devis ne peut pas être transformé en facture.'
        );


        $invoice = DB::transaction(function () use ($quote) {

            $invoice = Invoice::create([
                'customer_id' => $quote->customer_id,
                'quote_id' => $quote->id,
                'number' => DocumentNumberService::nextInvoiceNumber(),
                'status' => 'draft',
                'subtotal' => $quote->subtotal,
                'discount' => $quote->discount ?? 0,
                'total' => $quote->total,
                'paid_amount' => 0,
                'issued_at' => now(),
                'due_date' => now()->addDays(30),
                'notes' => $quote->notes,
                'vat_notice' => 'TVA non applicable, art. 293 B du CGI',
            ]);


            foreach ($quote->items->where('type', 'one_time') as $item) {

                $invoice->items()->create([
                    'designation' => $item->designation,
                    'description' => $item->description,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total' => $item->total,
                ]);
            }


            $quote->update([
                'status' => 'converted',
            ]);


            return $invoice;
        });


        return redirect()
            ->route('invoices-show', $invoice)
            ->with('success', 'Le devis a été transformé en facture.');
    }
}
