<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Quote;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total facturé (hors annulées)
        $totalRevenue = Invoice::where('status', '!=', 'cancelled')
            ->sum('total');


        // Total encaissé
        $totalPaid = Invoice::where('status', '!=', 'cancelled')
            ->sum('paid_amount');


        // Reste à encaisser
        $totalRemaining = $totalRevenue - $totalPaid;


        // Nombre de factures en retard
        $overdueInvoices = Invoice::where('status', 'overdue')
            ->count();


        // Dernières factures
        $latestInvoices = Invoice::with('customer')
            ->latest()
            ->take(5)
            ->get();


        // Derniers devis
        $latestQuotes = Quote::with('customer')
            ->latest()
            ->take(5)
            ->get();


        // Devis en attente
        $pendingQuotes = Quote::where('status', 'pending')
            ->count();

        // URSSAF
        $activityStartDate = \Carbon\Carbon::create(2026, 5, 6);

        $acreEndDate = \Carbon\Carbon::create(2027, 3, 31);

        $acreActive = now()->lessThanOrEqualTo($acreEndDate);

        // Exemple micro-entreprise prestation de service avec ACRE
        $urssafRate = 5.5; // à modifier selon ton taux réel


        $urssafAmount = $totalPaid * ($urssafRate / 100);


        // Impôts (à adapter selon ton choix réel)
        $taxRate = 11; // pas de versement libératoire actuellement

        $taxAmount = $totalPaid * ($taxRate / 100);


        // Ce qu'il te reste après provisions
        $availableAmount = $totalPaid - $urssafAmount - $taxAmount;


        return view('admin.page.dashboard', compact(
            'totalRevenue',
            'totalPaid',
            'totalRemaining',
            'overdueInvoices',
            'latestInvoices',
            'latestQuotes',
            'pendingQuotes',
            'acreEndDate',
            'urssafRate',
            'urssafAmount',
            'taxRate',
            'taxAmount',
            'availableAmount',
            'acreActive'
        ));
    }
}
