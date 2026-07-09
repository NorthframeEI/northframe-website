<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function listInvoices()
    {
        $invoices = Invoice::all();
        return view('admin.invoice.index', compact('invoices'));
    }

    public function showInvoice(Invoice $invoice)
    {
        return view('admin.invoice.show', compact('invoice'));
    }
}
