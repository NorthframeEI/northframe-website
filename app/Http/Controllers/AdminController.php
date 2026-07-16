<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quote;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = now();

        /*
    |--------------------------------------------------------------------------
    | Année en cours
    |--------------------------------------------------------------------------
    */

        $yearRevenue = Invoice::whereYear('issued_at', $now->year)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $yearPaid = Invoice::whereYear('issued_at', $now->year)
            ->where('status', '!=', 'cancelled')
            ->sum('paid_amount');

        $yearRemaining = $yearRevenue - $yearPaid;


        /*
    |--------------------------------------------------------------------------
    | Mois en cours
    |--------------------------------------------------------------------------
    */

        $monthlyRevenue = Invoice::whereYear('issued_at', $now->year)
            ->whereMonth('issued_at', $now->month)
            ->where('status', '!=', 'cancelled')
            ->sum('total');

        $monthPaid = Invoice::whereYear('issued_at', $now->year)
            ->whereMonth('issued_at', $now->month)
            ->where('status', '!=', 'cancelled')
            ->sum('paid_amount');

        $monthRemaining = $monthlyRevenue - $monthPaid;


        /*
    |--------------------------------------------------------------------------
    | Charges du mois
    |--------------------------------------------------------------------------
    */

        $acreEndDate = Carbon::create(2027, 3, 31);

        $acreActive = now()->lessThanOrEqualTo($acreEndDate);

        // A adapter plus tard
        if ($acreActive) {
            $urssafRate = 12.8;
            $taxRate = 7.2;
        } else {
            $urssafRate = 25.6;
            $taxRate = 9.4;
        }

        $monthUrssaf = $monthPaid * ($urssafRate / 100);
        $monthTaxes = $monthPaid * ($taxRate / 100);
        $monthAvailable = $monthPaid - $monthUrssaf - $monthTaxes;


        /*
    |--------------------------------------------------------------------------
    | Alertes
    |--------------------------------------------------------------------------
    */

        $overdueInvoices = Invoice::where('status', 'overdue')->count();

        $draftInvoices = Invoice::where('status', 'draft')->count();

        $partiallyPaidInvoices = Invoice::where('status', 'partially_paid')->count();

        $draftQuotes = Quote::where('status', 'draft')->count();


        /*
    |--------------------------------------------------------------------------
    | Derniers documents
    |--------------------------------------------------------------------------
    */

        $latestInvoices = Invoice::with('customer')
            ->latest()
            ->take(5)
            ->get();

        $latestInvoicesToCollect = Invoice::with('customer')
    ->whereIn('status', [
        'sent',
        'partially_paid',
        'overdue'
    ])
    ->latest()
    ->take(5)
    ->get();

        $latestQuotes = Quote::with('customer')
            ->latest()
            ->take(5)
            ->get();


        return view('admin.page.dashboard', compact(
            'yearRevenue',
            'yearPaid',
            'yearRemaining',

            'monthlyRevenue',
            'monthPaid',
            'monthRemaining',

            'monthUrssaf',
            'monthTaxes',
            'monthAvailable',

            'urssafRate',
            'taxRate',
            'acreActive',
            'acreEndDate',

            'overdueInvoices',
            'draftInvoices',
            'partiallyPaidInvoices',
            'draftQuotes',

            'latestInvoices',
            'latestQuotes',
            'latestInvoicesToCollect'
        ));
    }
}
