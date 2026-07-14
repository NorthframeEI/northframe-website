@extends('admin.layouts.index')

@section('title', 'NF Admin - Dashboard')
@section('admin.content')
    <div class="max-w-[1400px] mx-auto px-6 py-8">


        <h1 class="text-h1 text-primary mb-8">
            Dashboard
        </h1>


        {{-- KPI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">


            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    Chiffre d'affaires
                </p>

                <p class="text-h2 text-primary mt-3">
                    {{ number_format($totalRevenue, 2, ',', ' ') }} €
                </p>

            </div>



            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    Total encaissé
                </p>

                <p class="text-h2 text-success mt-3">
                    {{ number_format($totalPaid, 2, ',', ' ') }} €
                </p>

            </div>



            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    Reste à encaisser
                </p>

                <p class="text-h2 text-warning mt-3">
                    {{ number_format($totalRemaining, 2, ',', ' ') }} €
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

        <h2 class="text-h2 text-primary mb-6">
            Mes charges
        </h2>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">


            {{-- URSSAF --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    URSSAF estimée
                </p>

                <p class="text-h2 text-primary mt-3">
                    {{ number_format($urssafAmount, 2, ',', ' ') }} €
                </p>


                @if ($acreActive)
                    <p class="text-success mt-3 text-sm">
                        ACRE active jusqu'au
                        {{ $acreEndDate->format('d/m/Y') }}
                    </p>
                @else
                    <p class="text-warning mt-3 text-sm">
                        Fin de l'ACRE dépassée
                    </p>
                @endif

            </div>



            {{-- IMPOTS --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    Impôts estimés
                </p>

                <p class="text-h2 text-primary mt-3">
                    {{ number_format($taxAmount, 2, ',', ' ') }} €
                </p>


                <p class="text-secondary mt-3 text-sm">
                    Paiement à la déclaration
                </p>

            </div>



            {{-- RESTE --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <p class="text-secondary">
                    Disponible estimé
                </p>


                <p class="text-h2 text-success mt-3">
                    {{ number_format($availableAmount, 2, ',', ' ') }} €
                </p>


                <p class="text-secondary mt-3 text-sm">
                    Après charges estimées
                </p>

            </div>


        </div>



        {{-- ALERTES --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">


            <div class="bg-surface rounded-[12px] border border-primary/5 p-6">

                <h3 class="text-h3 text-primary mb-4">
                    À surveiller
                </h3>


                <div class="flex justify-between text-secondary mb-3">

                    <span>
                        Factures en retard
                    </span>

                    <strong class="text-error">
                        {{ $overdueInvoices }}
                    </strong>

                </div>


                <div class="flex justify-between text-secondary">

                    <span>
                        Devis en attente
                    </span>

                    <strong class="text-warning">
                        {{ $pendingQuotes }}
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
        <div class="bg-surface rounded-[12px] border border-primary/5 p-6">


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


    </div>
@endsection
