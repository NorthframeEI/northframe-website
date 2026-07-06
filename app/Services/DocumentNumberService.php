<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Quote;

class DocumentNumberService
{
    public static function nextQuoteNumber(): string
    {
        $year = now()->year;

        $last = Quote::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        $number = 1;

        if ($last) {
            $lastNumber = intval(substr($last->number, -4));
            $number = $lastNumber + 1;
        }

        return sprintf('DEV-%s-%04d', $year, $number);
    }

    public static function nextInvoiceNumber(): string
    {
        $year = now()->year;

        $last = Invoice::whereYear('created_at', $year)
            ->orderByDesc('id')
            ->first();

        $number = 1;

        if ($last) {
            $lastNumber = intval(substr($last->number, -4));
            $number = $lastNumber + 1;
        }

        return sprintf('FAC-%s-%04d', $year, $number);
    }
}