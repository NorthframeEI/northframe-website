<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Première année proposée dans le filtre de période
    private const FIRST_YEAR = 2020;

    public function dashboard(Request $request)
    {
        $now = now();

        /*
        |----------------------------------------------------------------------
        | Période sélectionnée (?month=10&year=2026), jamais dans le futur
        |----------------------------------------------------------------------
        */

        $year  = max(self::FIRST_YEAR, min((int) $request->query('year', $now->year), $now->year));
        $month = max(1, min((int) $request->query('month', $now->month), 12));

        $selected = Carbon::create($year, $month, 1)->startOfMonth();

        if ($selected->greaterThan($now->copy()->startOfMonth())) {
            $selected = $now->copy()->startOfMonth();
        }

        $year  = $selected->year;
        $month = $selected->month;

        $monthStart = $selected->copy()->startOfMonth();
        $monthEnd   = $selected->copy()->endOfMonth();
        $yearStart  = $selected->copy()->startOfYear();
        $yearEnd    = $selected->copy()->endOfYear();

        // Périodes de comparaison
        $prevMonth      = $selected->copy()->subMonthNoOverflow();
        $prevMonthStart = $prevMonth->copy()->startOfMonth();
        $prevMonthEnd   = $prevMonth->copy()->endOfMonth();

        $isCurrentYear = $year === $now->year;
        $prevYearStart = $yearStart->copy()->subYear();
        // Année en cours : on compare à la même période l'an dernier
        $prevYearEnd   = $isCurrentYear
            ? $now->copy()->subYear()->endOfDay()
            : $yearEnd->copy()->subYear();

        $prevMonthLabel = $prevMonth->copy()->locale('fr')->translatedFormat('F Y');
        $prevYearLabel  = $isCurrentYear
            ? 'même période en ' . $prevYearStart->year
            : (string) $prevYearStart->year;

        /*
        |----------------------------------------------------------------------
        | Requêtes de base
        |----------------------------------------------------------------------
        | - "émise"  : facture avec une date d'émission (PDF généré), non annulée
        | - "paiement": paiement rattaché à une facture non annulée
        */

        $issued = fn () => Invoice::whereNotNull('issued_at')
            ->where('status', '!=', 'cancelled');

        $payments = fn () => Payment::whereHas(
            'invoice',
            fn ($q) => $q->where('status', '!=', 'cancelled')
        );

        $revenueBetween = fn ($start, $end) => $issued()
            ->whereBetween('issued_at', [$start, $end])
            ->sum('total');

        $paidBetween = fn ($start, $end) => $payments()
            ->whereBetween('paid_at', [$start, $end])
            ->sum('amount');

        // Évolution en % (null si la période précédente est à zéro)
        $variation = fn ($current, $previous) => $previous > 0
            ? (int) round((($current - $previous) / $previous) * 100)
            : null;

        /*
        |----------------------------------------------------------------------
        | Facturé (CA) et encaissé, avec comparaison
        |----------------------------------------------------------------------
        */

        $monthlyRevenue = $revenueBetween($monthStart, $monthEnd);
        $yearRevenue    = $revenueBetween($yearStart, $yearEnd);
        $monthPaid      = $paidBetween($monthStart, $monthEnd);
        $yearPaid       = $paidBetween($yearStart, $yearEnd);

        $monthlyRevenueDelta = $variation($monthlyRevenue, $revenueBetween($prevMonthStart, $prevMonthEnd));
        $yearRevenueDelta    = $variation($yearRevenue, $revenueBetween($prevYearStart, $prevYearEnd));
        $monthPaidDelta      = $variation($monthPaid, $paidBetween($prevMonthStart, $prevMonthEnd));
        $yearPaidDelta       = $variation($yearPaid, $paidBetween($prevYearStart, $prevYearEnd));

        // Encaissements mois par mois sur l'année sélectionnée (graphique)
        $paidByMonth = $payments()
            ->whereBetween('paid_at', [$yearStart, $yearEnd])
            ->get(['amount', 'paid_at'])
            ->groupBy(fn ($p) => $p->paid_at->month)
            ->map(fn ($group) => (float) $group->sum('amount'));

        $monthlyPaidChart = collect(range(1, 12))
            ->map(fn ($m) => $paidByMonth[$m] ?? 0)
            ->all();

        /*
        |----------------------------------------------------------------------
        | Situation à ce jour (indépendante de la période choisie)
        |----------------------------------------------------------------------
        */

        $outstandingStatuses = ['sent', 'partially_paid', 'overdue'];

        $totalOutstanding = Invoice::whereIn('status', $outstandingStatuses)
            ->selectRaw('COALESCE(SUM(total - paid_amount), 0) as remaining')
            ->value('remaining');

        $overdueQuery = fn () => Invoice::whereIn('status', $outstandingStatuses)
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', today());

        $overdueInvoices = $overdueQuery()->count();

        $overdueAmount = $overdueQuery()
            ->selectRaw('COALESCE(SUM(total - paid_amount), 0) as remaining')
            ->value('remaining');

        $draftInvoices         = Invoice::where('status', 'draft')->count();
        $partiallyPaidInvoices = Invoice::where('status', 'partially_paid')->count();
        $draftQuotes           = Quote::where('status', 'draft')->count();

        /*
        |----------------------------------------------------------------------
        | Provisions du mois sélectionné (sur l'encaissé)
        |----------------------------------------------------------------------
        */

        $acreEndDate = Carbon::create(2027, 3, 31);
        $acreActive  = $monthEnd->lessThanOrEqualTo($acreEndDate->copy()->endOfDay());

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

        /*
        |----------------------------------------------------------------------
        | Navigation entre les périodes
        |----------------------------------------------------------------------
        */

        $nextMonth = $selected->copy()->addMonthNoOverflow();

        $period = [
            'month'     => $month,
            'year'      => $year,
            'label'     => $selected->copy()->locale('fr')->translatedFormat('F Y'),
            'isCurrent' => $selected->format('Y-m') === $now->format('Y-m'),
            'prev'      => $prevMonth->year >= self::FIRST_YEAR
                ? ['month' => $prevMonth->month, 'year' => $prevMonth->year]
                : null,
            'next'      => $nextMonth->lessThanOrEqualTo($now->copy()->startOfMonth())
                ? ['month' => $nextMonth->month, 'year' => $nextMonth->year]
                : null,
            'prevYear'  => $year > self::FIRST_YEAR ? $year - 1 : null,
            'nextYear'  => $year < $now->year ? $year + 1 : null,
        ];

        return view('admin.page.dashboard', compact(
            'period',
            'prevMonthLabel',
            'prevYearLabel',

            'monthlyRevenue',
            'monthlyRevenueDelta',
            'yearRevenue',
            'yearRevenueDelta',
            'totalOutstanding',

            'monthPaid',
            'monthPaidDelta',
            'yearPaid',
            'yearPaidDelta',
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