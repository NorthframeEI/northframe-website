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
            'quantity' => 'required|numeric|min:1',
            'unit_price' => 'required|numeric|min:0',
        ]);

        $item = $quote->items()->create([
            'designation' => $request->designation,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total' => $request->quantity * $request->unit_price,
        ]);

        $this->recalculateQuote($quote);

        return back();
    }

    private function recalculateQuote(Quote $quote)
    {
        $subtotal = $quote->items()->sum('total');

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
