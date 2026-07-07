<?php

namespace App\Services;

class CalculationService
{
    public static function calculateOneTimeTotal($items): float
    {
        return $items
            ->where('type', 'one_time')
            ->sum(function ($item) {
                return $item->quantity * $item->unit_price;
            });
    }


    public static function calculateRecurringTotal($items): float
    {
        return $items
            ->where('type', 'recurring')
            ->sum(function ($item) {

                return $item->quantity * $item->unit_price;
            });
    }


    public static function applyDiscount(float $subtotal, float $discount = 0): float
    {
        return max(0, $subtotal - $discount);
    }
}
