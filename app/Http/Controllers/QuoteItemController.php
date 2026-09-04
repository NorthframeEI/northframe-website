<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Services\CalculationService;
use Illuminate\Http\Request;

class QuoteItemController extends Controller
{
    public function store(Request $request, Quote $quote)
    {
        $request->validate([
            'designation' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
            'type' => [
                'required',
                'in:one_time,recurring'
            ],

            'billing_period' => [
                'nullable',
                'required_if:type,recurring',
                'in:monthly,yearly'
            ],
        ]);

        $item = $quote->items()->create([
            'designation' => $request->designation,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total' => $request->quantity * $request->unit_price,
            'type' => $request->type,
            'billing_period' => $request->type === 'recurring' ? $request->billing_period : null,
        ]);

        $this->recalculateQuote($quote);

        return back();
    }

  private function recalculateQuote(Quote $quote)
{
    $items = $quote->items;

    $subtotal = CalculationService::calculateOneTimeTotal($items);

    $total = CalculationService::applyDiscount(
        $subtotal,
        $quote->discount
    );

    $quote->update([
        'subtotal' => $subtotal,
        'total' => $total,
    ]);
}

    public function destroy(QuoteItem $item)
    {
        $quote = $item->quote;

        $item->delete();

        $subtotal = $quote->items()->sum('total');

        $total = CalculationService::applyDiscount(
            $subtotal,
            $quote->discount
        );

        $quote->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);

        return back();
    }
}
