<?php

namespace App\Http\Controllers;

use App\Mail\DepositInvoiceMail;
use App\Models\DepositInvoices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DepositInvoiceController extends Controller
{
    public function index(){

    $depositInvoices = DepositInvoices::all();
    return view('admin.deposit_invoices.index', compact('depositInvoices'));
    }

    public function show(DepositInvoices $depositInvoice)
    {
        return view('admin.deposit_invoices.show', compact('depositInvoice'));
    }

     public function preview(DepositInvoices $depositInvoice)
    {
        $pdf = Pdf::loadView('admin.deposit_invoices.pdf', [
            'depositInvoice' => $depositInvoice->load(['quote.customer', 'invoice']),
        ]);

        return $pdf->stream($depositInvoice->number . '.pdf');
    }

    public function previewPdf(DepositInvoices $depositInvoice)
    {

        $path = 'deposit_invoices/' . $depositInvoice->number . '.pdf';

        abort_unless(Storage::disk('private')->exists($path), 404);

        return response()->file(
            Storage::disk('private')->path($path)
        );
    }

      public function generatePdf(DepositInvoices $depositInvoice)
    {
         $pdf = Pdf::loadView('admin.deposit_invoices.pdf', [
            'depositInvoice' => $depositInvoice->load(['quote.customer', 'invoice']),
        ]);

        $filename = $depositInvoice->number . '.pdf';

        $path = 'deposit_invoices/' . $filename;

        Storage::disk('private')->put(
            $path,
            $pdf->output()
        );

        $depositInvoice->update([
            'pdf_path' => $path,
        ]);

        return back()->with('success', 'Le PDF a été généré.');
    }

     public function send(DepositInvoices $depositInvoice)
    {
        $path = 'deposit_invoices/' . $depositInvoice->number . '.pdf';

        abort_unless(
            Storage::disk('private')->exists($path),
            404,
            'Le PDF doit être généré avant l\'envoi.'
        );

        Mail::to($depositInvoice->quote->customer->email)
            ->send(new DepositInvoiceMail($depositInvoice, $path));

        $depositInvoice->update([
            'status' => 'sent',
        ]);

        return back()->with('success', 'Le devis a été envoyé au client.');
    }

}
