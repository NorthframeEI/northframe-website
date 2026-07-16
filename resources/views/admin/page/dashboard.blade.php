@extends('admin.layouts.index')

@section('title', 'NF Admin - Dashboard')
@section('admin.content')
    <div class="max-w-[1400px] mx-auto px-6 py-8">

        <h1 class="text-h1 text-primary mb-8">
            Dashboard
        </h1>

        {{-- =========================
        ACTIVITÉ
        ========================== --}}
        <div class="mb-10">

            <h2 class="text-h2 text-primary mb-6">
                Activité
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">
                        CA du mois
                    </p>

                    <p class="text-h2 text-primary mt-3">
                        {{ number_format($monthlyRevenue, 2, ',', ' ') }} €
                    </p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">
                        CA annuel
                    </p>

                    <p class="text-h2 text-primary mt-3">
                        {{ number_format($yearRevenue, 2, ',', ' ') }} €
                    </p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">
                        À encaisser
                    </p>

                    <p class="text-h2 text-warning mt-3">
                        {{ number_format($yearRemaining, 2, ',', ' ') }} €
                    </p>
                </div>

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">
                    <p class="text-secondary">
                        Factures en retard
                    </p>

                    <p class="text-h2 text-error mt-3">
                        {{ $overdueInvoices }}
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">
                        Encaissé du mois
                    </p>

                    <p class="text-h2 text-success mt-3">
                        {{ number_format($monthPaid, 2, ',', ' ') }} €
                    </p>

                    <p class="text-secondary text-sm mt-3">
                        Paiements reçus ce mois-ci
                    </p>

                </div>


                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">
                        Encaissé cette année
                    </p>

                    <p class="text-h2 text-success mt-3">
                        {{ number_format($yearPaid, 2, ',', ' ') }} €
                    </p>

                    <p class="text-secondary text-sm mt-3">
                        Total des paiements reçus
                    </p>

                </div>

            </div>

            {{-- Provisions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">
                        Provision URSSAF
                    </p>

                    <p class="text-h2 text-warning mt-3">
                        {{ number_format($monthUrssaf, 2, ',', ' ') }} €
                    </p>

                    @if ($acreActive)
                        <p class="text-success text-sm mt-3">
                            ACRE active jusqu'au {{ $acreEndDate->format('d/m/Y') }}
                        </p>
                    @else
                        <p class="text-error text-sm mt-3">
                            ACRE expirée
                        </p>
                    @endif

                </div>


                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">
                        Provision impôts
                    </p>

                    <p class="text-h2 text-warning mt-3">
                        {{ number_format($monthTaxes, 2, ',', ' ') }} €
                    </p>

                    <p class="text-secondary text-sm mt-3">
                        Estimation sur les encaissements du mois
                    </p>

                </div>


                <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                    <p class="text-secondary">
                        Disponible estimé
                    </p>

                    <p class="text-h2 text-success mt-3">
                        {{ number_format($monthAvailable, 2, ',', ' ') }} €
                    </p>

                    <p class="text-secondary text-sm mt-3">
                        Après provisions URSSAF et impôts
                    </p>

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
                    <span class="text-secondary">
                        Factures en retard
                    </span>

                    <strong class="text-error">
                        {{ $overdueInvoices }}
                    </strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">
                        Devis en attente
                    </span>

                    <strong class="text-warning">
                        {{ $draftQuotes }}
                    </strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">
                        Factures brouillon
                    </span>

                    <strong class="text-secondary">
                        {{ $draftInvoices }}
                    </strong>
                </div>

                <div class="flex justify-between">
                    <span class="text-secondary">
                        Factures partiellement payées
                    </span>

                    <strong class="text-brand">
                        {{ $partiallyPaidInvoices }}
                    </strong>
                </div>

            </div>

        </div>


        {{-- FACTURES --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-8">


            <h3 class="text-h3 text-primary mb-5">
                Dernières factures
            </h3>


            <table class="w-full">

                <thead>

                    <tr class="border-b border-primary/5">

                        <th class="text-left text-secondary px-4 py-3">
                            Numéro
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Client
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Montant
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Statut
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($latestInvoices as $invoice)
                        <tr class="border-b border-primary/5">

                            <td class="px-4 py-4 text-primary">
                                {{ $invoice->number }}
                            </td>


                            <td class="px-4 py-4 text-primary">
                                {{ $invoice->customer->company_name ?? $invoice->customer->contact_name }}
                            </td>


                            <td class="px-4 py-4 text-primary">
                                {{ number_format($invoice->total, 2, ',', ' ') }} €
                            </td>


                            <td class="px-4 py-4 text-primary">
                                {{ $invoice->status }}
                            </td>


                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>



        {{-- DEVIS --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6 mb-8">


            <h3 class="text-h3 text-primary mb-5">
                Derniers devis
            </h3>


            <table class="w-full">

                <thead>

                    <tr class="border-b border-primary/5">

                        <th class="text-left text-secondary px-4 py-3">
                            Numéro
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Client
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Montant
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($latestQuotes as $quote)
                        <tr class="border-b border-primary/5">

                            <td class="px-4 py-4 text-primary">
                                {{ $quote->number }}
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ $quote->customer->company_name ?? $quote->customer->contact_name }}
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ number_format($quote->total, 2, ',', ' ') }} €
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>


        </div>

        {{-- Factures Partiellement Payées --}}
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6">


            <h3 class="text-h3 text-primary mb-5">
                Factures à encaisser
            </h3>


            <table class="w-full">

                <thead>

                    <tr class="border-b border-primary/5">

                        <th class="text-left text-secondary px-4 py-3">
                            Numéro
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Client
                        </th>

                        <th class="text-left text-secondary px-4 py-3">
                            Montant
                        </th>
                        <th class="text-left text-secondary px-4 py-3">
                            Déjà payée
                        </th>
                        <th class="text-left text-secondary px-4 py-3">
                            Reste
                        </th>
                    </tr>

                </thead>

                <tbody>
                    @forelse ($latestInvoicesToCollect as $invoice)
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
                                {{ number_format($invoice->total, 2, ',', ' ') }} €
                            </td>

                            <td class="px-4 py-4 text-primary">
                                {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
                            </td>
                            <td class="px-4 py-4 text-primary">
                                {{ number_format($invoice->total - $invoice->paid_amount, 2, ',', ' ') }} €
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-secondary">
                                Aucune facture à encaisser
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>


        </div>


    </div>
@endsection
