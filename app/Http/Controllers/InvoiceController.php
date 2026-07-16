<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function listInvoices()
    {
        $invoices = Invoice::all();
        return view('admin.invoice.index', compact('invoices'));
    }

    public function showInvoice(Invoice $invoice)
    {
        if (
            $invoice->status !== 'paid' &&
            $invoice->status !== 'cancelled' &&
            $invoice->due_date->isPast()
        ) {
            $invoice->update([
                'status' => 'overdue',
            ]);
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
}
