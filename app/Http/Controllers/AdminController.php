<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Quote;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = now();

        $yearStart  = $now->copy()->startOfYear();
        $yearEnd    = $now->copy()->endOfYear();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd   = $now->copy()->endOfMonth();

        /*
        |----------------------------------------------------------------------
        | Requêtes de base
        |----------------------------------------------------------------------
        | - "émise"  : facture avec une date d'émission (PDF généré), non annulée
        | - "paiement": paiement rattaché à une facture non annulée
        */

        $issued = fn() => Invoice::whereNotNull('issued_at')
            ->where('status', '!=', 'cancelled');

        $payments = fn() => Payment::whereHas(
            'invoice',
            fn($q) => $q->where('status', '!=', 'cancelled')
        );

        /*
        |----------------------------------------------------------------------
        | Facturé (CA) : factures émises, selon issued_at
        |----------------------------------------------------------------------
        */

        $monthlyRevenue = $issued()
            ->whereBetween('issued_at', [$monthStart, $monthEnd])
            ->sum('total');

        $yearRevenue = $issued()
            ->whereBetween('issued_at', [$yearStart, $yearEnd])
            ->sum('total');

        /*
        |----------------------------------------------------------------------
        | Encaissé : paiements, selon paid_at
        |----------------------------------------------------------------------
        */

        $monthPaid = $payments()
            ->whereBetween('paid_at', [$monthStart, $monthEnd])
            ->sum('amount');

        $yearPaid = $payments()
            ->whereBetween('paid_at', [$yearStart, $yearEnd])
            ->sum('amount');

        // Encaissements mois par mois (graphique)
        $paidByMonth = $payments()
            ->whereBetween('paid_at', [$yearStart, $yearEnd])
            ->get(['amount', 'paid_at'])
            ->groupBy(fn($p) => $p->paid_at->month)
            ->map(fn($group) => (float) $group->sum('amount'));

        $monthlyPaidChart = collect(range(1, 12))
            ->map(fn($m) => $paidByMonth[$m] ?? 0)
            ->all();

        /*
        |----------------------------------------------------------------------
        | Reste à encaisser (toutes années confondues)
        |----------------------------------------------------------------------
        */

        $outstandingStatuses = ['sent', 'partially_paid', 'overdue'];

        $totalOutstanding = Invoice::whereIn('status', $outstandingStatuses)
            ->selectRaw('COALESCE(SUM(total - paid_amount), 0) as remaining')
            ->value('remaining');

        /*
        |----------------------------------------------------------------------
        | Factures en retard : calculées à partir de due_date
        |----------------------------------------------------------------------
        */

        $overdueQuery = fn() => Invoice::whereIn('status', ['sent', 'partially_paid', 'overdue'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today());

        $overdueInvoices = $overdueQuery()->count();

        $overdueAmount = $overdueQuery()
            ->selectRaw('COALESCE(SUM(total - paid_amount), 0) as remaining')
            ->value('remaining');

        /*
        |----------------------------------------------------------------------
        | Provisions du mois (sur l'encaissé)
        |----------------------------------------------------------------------
        */

        $acreEndDate = Carbon::create(2027, 3, 31);
        $acreActive  = $now->lessThanOrEqualTo($acreEndDate->copy()->endOfDay());

        // À adapter plus tard
        if ($acreActive) {
            $urssafRate = 13;
            $taxRate    = 7;
        } else {
            $urssafRate = 25.8;
            $taxRate    = 9.4;
        }

        $monthUrssaf    = $monthPaid * ($urssafRate / 100);
        $monthTaxes     = $monthPaid * ($taxRate / 100);
        $monthAvailable = $monthPaid - $monthUrssaf - $monthTaxes;

        /*
        |----------------------------------------------------------------------
        | Alertes
        |----------------------------------------------------------------------
        */

        $draftInvoices         = Invoice::where('status', 'draft')->count();
        $partiallyPaidInvoices = Invoice::where('status', 'partially_paid')->count();
        $draftQuotes           = Quote::where('status', 'draft')->count();

        /*
        |----------------------------------------------------------------------
        | Derniers documents
        |----------------------------------------------------------------------
        */

        $latestInvoices = Invoice::with('customer')
            ->latest()
            ->take(5)
            ->get();

        // Les plus anciennes échéances d'abord, les factures sans échéance à la fin
        $latestInvoicesToCollect = Invoice::with('customer')
            ->whereIn('status', $outstandingStatuses)
            ->orderByRaw('due_date IS NULL')
            ->orderBy('due_date')
            ->take(5)
            ->get();

        $latestQuotes = Quote::with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.page.dashboard', compact(
            'monthlyRevenue',
            'yearRevenue',
            'totalOutstanding',

            'monthPaid',
            'yearPaid',
            'monthlyPaidChart',

            'monthUrssaf',
            'monthTaxes',
            'monthAvailable',
            'urssafRate',
            'taxRate',
            'acreActive',
            'acreEndDate',

            'overdueInvoices',
            'overdueAmount',
            'draftInvoices',
            'partiallyPaidInvoices',
            'draftQuotes',

            'latestInvoices',
            'latestInvoicesToCollect',
            'latestQuotes'
        ));
    }
}
