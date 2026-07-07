<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Customer;
use App\Services\DocumentNumberService;
use Carbon\Carbon;

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
        $quote->load('items', 'customer');

        return view('admin.quotes.pdf', compact('quote'));
    }
}
