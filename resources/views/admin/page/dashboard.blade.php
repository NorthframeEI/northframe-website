@extends('admin.layouts.index')

@section('title', 'NF Admin - Dashboard')
@section('admin.content')

    @php
        use Carbon\Carbon;

        $fmt = fn ($value) => number_format($value, 2, ',', ' ') . ' €';
        $date = fn ($value) => $value ? Carbon::parse($value)->format('d/m/Y') : '—';

        $statusStyles = [
            'draft' => 'bg-secondary/20 text-secondary',
            'sent' => 'bg-brand/20 text-brand',
            'partially_paid' => 'bg-warning/20 text-warning',
            'paid' => 'bg-success/20 text-success',
            'overdue' => 'bg-error/20 text-error',
            'cancelled' => 'bg-error/20 text-error',
        ];

        $statusLabels = [
            'draft' => 'Brouillon',
            'sent' => 'Envoyée',
            'partially_paid' => 'Partiellement payée',
            'paid' => 'Payée',
            'overdue' => 'En retard',
            'cancelled' => 'Annulée',
        ];

        $monthLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        $chartMax = max($monthlyPaidChart) ?: 1;
        $currentMonthIndex = now()->month - 1;
    @endphp

    <div class="max-w-[1400px] mx-auto px-6 py-8">

        <div class="mb-8">
            <h1 class="text-h1 text-primary">
                Dashboard
            </h1>
            <p class="text-secondary mt-2">
                {{ now()->translatedFormat('F Y') }}
            </p>
        </div>

        {{-- =========================
        ACTIVITÉ
        ========================== --}}
        <div class="mb-10">

            <h2 class="text-h2 text-primary mb-6">
                Activité
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Facturé ce mois-ci</p>
                    <p class="text-h2 text-primary mt-3">{{ $fmt($monthlyRevenue) }}</p>
                    <p class="text-secondary text-sm mt-3">Factures émises uniquement</p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Facturé cette année</p>
                    <p class="text-h2 text-primary mt-3">{{ $fmt($yearRevenue) }}</p>
                    <p class="text-secondary text-sm mt-3">Factures émises uniquement</p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">À encaisser</p>
                    <p class="text-h2 text-warning mt-3">{{ $fmt($totalOutstanding) }}</p>
                    <p class="text-secondary text-sm mt-3">Toutes années confondues</p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Factures en retard</p>
                    <p class="text-h2 {{ $overdueInvoices > 0 ? 'text-error' : 'text-primary' }} mt-3">
                        {{ $overdueInvoices }}
                    </p>
                    <p class="text-secondary text-sm mt-3">
                        @if ($overdueInvoices > 0)
                            {{ $fmt($overdueAmount) }} à relancer
                        @else
                            Aucune relance à faire
                        @endif
                    </p>
                </div>

            </div>

        </div>


        {{-- =========================
        TRÉSORERIE
        ========================== --}}
        <div class="mb-10">

            <h2 class="text-h2 text-primary mb-6">
                Trésorerie
            </h2>

            {{-- Encaissé --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Encaissé ce mois-ci</p>
                    <p class="text-h2 text-success mt-3">{{ $fmt($monthPaid) }}</p>
                    <p class="text-secondary text-sm mt-3">Paiements reçus ce mois-ci</p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Encaissé cette année</p>
                    <p class="text-h2 text-success mt-3">{{ $fmt($yearPaid) }}</p>
                    <p class="text-secondary text-sm mt-3">Paiements reçus depuis janvier</p>
                </div>

            </div>

            {{-- Graphique encaissements --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-6">

                <h3 class="text-h3 text-primary mb-6">
                    Encaissements par mois
                </h3>

                <div class="flex items-stretch gap-2 h-48">
                    @foreach ($monthlyPaidChart as $index => $value)
                        <div class="flex-1 flex flex-col" title="{{ $monthLabels[$index] }} : {{ $fmt($value) }}">
                            <div class="flex-1 flex items-end">
                                <div class="w-full rounded-t {{ $index === $currentMonthIndex ? 'bg-success' : 'bg-success/30' }}"
                                    style="height: {{ round(($value / $chartMax) * 100) }}%; min-height: 2px;"></div>
                            </div>
                            <span class="text-secondary text-xs text-center mt-2">
                                {{ $monthLabels[$index] }}
                            </span>
                        </div>
                    @endforeach
                </div>

            </div>

            {{-- Provisions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">Provision URSSAF</p>
                    <p class="text-h2 text-warning mt-3">{{ $fmt($monthUrssaf) }}</p>

                    @if ($acreActive)
                        <p class="text-success text-sm mt-3">
                            ACRE active jusqu'au {{ $acreEndDate->format('d/m/Y') }} ({{ $urssafRate }} %)
                        </p>
                    @else
                        <p class="text-error text-sm mt-3">
                            ACRE expirée ({{ $urssafRate }} %)
                        </p>
                    @endif

                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Provision impôts</p>
                    <p class="text-h2 text-warning mt-3">{{ $fmt($monthTaxes) }}</p>
                    <p class="text-secondary text-sm mt-3">
                        {{ $taxRate }} % des encaissements du mois
                    </p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">Disponible estimé</p>
                    <p class="text-h2 text-success mt-3">{{ $fmt($monthAvailable) }}</p>
                    <p class="text-secondary text-sm mt-3">Après provisions URSSAF et impôts</p>
                </div>

            </div>

        </div>


        {{-- =========================
        À TRAITER
        ========================== --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-10">

            <h2 class="text-h3 text-primary mb-5">
                À traiter
            </h2>

            <div class="space-y-4">

                <div class="flex justify-between">
                    <span class="text-secondary">Factures en retard</span>
                    <strong class="{{ $overdueInvoices > 0 ? 'text-error' : 'text-secondary' }}">
                        {{ $overdueInvoices }}
                    </strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">Factures partiellement payées</span>
                    <strong class="text-brand">{{ $partiallyPaidInvoices }}</strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">Factures brouillon</span>
                    <strong class="text-secondary">{{ $draftInvoices }}</strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">Devis brouillon</span>
                    <strong class="text-warning">{{ $draftQuotes }}</strong>
                </div>

            </div>

        </div>


        {{-- =========================
        FACTURES À ENCAISSER
        ========================== --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-8 overflow-x-auto">

            <h3 class="text-h3 text-primary mb-5">
                Factures à encaisser
            </h3>

            <table class="w-full">

                <thead>
                    <tr class="border-b border-primary/5">
                        <th class="text-left text-secondary px-4 py-3">Numéro</th>
                        <th class="text-left text-secondary px-4 py-3">Client</th>
                        <th class="text-left text-secondary px-4 py-3">Échéance</th>
                        <th class="text-left text-secondary px-4 py-3">Montant</th>
                        <th class="text-left text-secondary px-4 py-3">Déjà payé</th>
                        <th class="text-left text-secondary px-4 py-3">Reste</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($latestInvoicesToCollect as $invoice)
                        @php
                            $isLate = $invoice->due_date && Carbon::parse($invoice->due_date)->isPast();
                        @endphp
                        <tr class="border-b border-primary/5">

                            <td class="px-4 py-4 text-primary">
                                <a href="{{ route('invoices-show', $invoice) }}" class="hover:underline cursor-pointer">
                                    {{ $invoice->number }}
                                </a>
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ $invoice->customer->company_name ?? $invoice->customer->contact_name }}
                            </td>

                            <td class="px-4 py-4 {{ $isLate ? 'text-error' : 'text-primary' }}">
                                {{ $date($invoice->due_date) }}
                            </td>

                            <td class="px-4 py-4 text-primary">{{ $fmt($invoice->total) }}</td>

                            <td class="px-4 py-4 text-primary">{{ $fmt($invoice->paid_amount) }}</td>

                            <td class="px-4 py-4 text-primary">{{ $fmt($invoice->total - $invoice->paid_amount) }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-secondary">
                                Aucune facture à encaisser
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>


        {{-- =========================
        DERNIÈRES FACTURES
        ========================== --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-8 overflow-x-auto">

            <h3 class="text-h3 text-primary mb-5">
                Dernières factures
            </h3>

            <table class="w-full">

                <thead>
                    <tr class="border-b border-primary/5">
                        <th class="text-left text-secondary px-4 py-3">Numéro</th>
                        <th class="text-left text-secondary px-4 py-3">Client</th>
                        <th class="text-left text-secondary px-4 py-3">Émise le</th>
                        <th class="text-left text-secondary px-4 py-3">Montant</th>
                        <th class="text-left text-secondary px-4 py-3">Statut</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($latestInvoices as $invoice)
                        <tr class="border-b border-primary/5">

                            <td class="px-4 py-4 text-primary">
                                <a href="{{ route('invoices-show', $invoice) }}" class="hover:underline cursor-pointer">
                                    {{ $invoice->number }}
                                </a>
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ $invoice->customer->company_name ?? $invoice->customer->contact_name }}
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ $date($invoice->issued_at) }}
                            </td>

                            <td class="px-4 py-4 text-primary">{{ $fmt($invoice->total) }}</td>

                            <td class="px-4 py-4 text-primary">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$invoice->status] ?? 'bg-secondary/20 text-secondary' }}">
                                    {{ $statusLabels[$invoice->status] ?? $invoice->status }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-secondary">
                                Aucune facture pour le moment
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>


        {{-- =========================
        DERNIERS DEVIS
        ========================== --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 overflow-x-auto">

            <h3 class="text-h3 text-primary mb-5">
                Derniers devis
            </h3>

            <table class="w-full">

                <thead>
                    <tr class="border-b border-primary/5">
                        <th class="text-left text-secondary px-4 py-3">Numéro</th>
                        <th class="text-left text-secondary px-4 py-3">Client</th>
                        <th class="text-left text-secondary px-4 py-3">Montant</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($latestQuotes as $quote)
                        <tr class="border-b border-primary/5">

                            <td class="px-4 py-4 text-primary">{{ $quote->number }}</td>

                            <td class="px-4 py-4 text-primary">
                                {{ $quote->customer->company_name ?? $quote->customer->contact_name }}
                            </td>

                            <td class="px-4 py-4 text-primary">{{ $fmt($quote->total) }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-secondary">
                                Aucun devis pour le moment
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </div>
@endsection