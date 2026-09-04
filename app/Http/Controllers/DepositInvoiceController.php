<?php

namespace App\Http\Controllers;

use App\Models\DepositInvoices;
use Illuminate\Http\Request;

class DepositInvoiceController extends Controller
{
    public function show(DepositInvoices $depositInvoice)
    {
        return view('admin.deposit_invoices.show', compact('depositInvoice'));
    }
}
