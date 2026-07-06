<?php

namespace App\Services;

class CalculationService
{
    public static function calculateItemsTotal($items): float
    {
        return $items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
    }

    public static function applyDiscount(float $subtotal, float $discount = 0): float
    {
        return max(0, $subtotal - $discount);
    }
}