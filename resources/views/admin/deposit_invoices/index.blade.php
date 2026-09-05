@extends('admin.layouts.index')
@section('title', 'NF Admin - factures d\'acompte')

@section('admin.content')

    {{-- HEADER --}}
    <section id="listDepositInvoices">

        <div class="max-w-[1242px] mx-auto px-6 py-12">

            <div class="grid grid-cols-1 gap-3 mb-10">

                <h1 class="text-h1 text-primary text-center">
                    Factures d'acompte
                </h1>

                <p class="text-navbar text-secondary text-center">
                    Gestion des factures d'acompte
                </p>

            </div>


            {{-- ALERTS --}}
            <div class="w-full max-w-[1100px] mx-auto mb-6">

                @if (session('success'))
                    <div class="p-4 bg-success/30 border border-success text-success rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="p-4 bg-error/30 border border-error text-error rounded-lg">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>


            {{-- LISTE --}}
            <div
                class="w-full max-w-[1100px] mx-auto rounded-[12px] bg-surface shadow-lg border border-primary/5 overflow-hidden">

                @if ($depositInvoices->isEmpty())

                    <div class="px-6 py-12 text-center">

                        <p class="text-primary text-lg font-medium">
                            Aucune facture d'acompte
                        </p>

                        <p class="text-secondary mt-2">
                            Les factures d'acompte créées apparaîtront ici.
                        </p>

                    </div>
                @else
                    {{-- TABLEAU --}}
                    <div class="overflow-x-auto">

                        <table class="w-full text-left">

                            <thead class="border-b border-primary/5">

                                <tr class="text-secondary text-sm">

                                    <th class="px-6 py-4 font-medium">
                                        Numéro
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Client
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Devis
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Montant
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Statut
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        Émission
                                    </th>

                                    <th class="px-6 py-4 font-medium">
                                        PDF
                                    </th>

                                    <th class="px-6 py-4 font-medium text-right">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-primary/5">

                                @foreach ($depositInvoices as $depositInvoice)
                                    @php

                                        $statusLabels = [
                                            'draft' => 'Brouillon',
                                            'sent' => 'Envoyée',
                                            'paid' => 'Payée',
                                            'cancelled' => 'Annulée',
                                        ];

                                        $statusClasses = [
                                            'draft' => 'bg-surface border-primary/10 text-secondary',
                                            'sent' => 'bg-brand/10 text-primary',
                                            'paid' => 'bg-success/20 text-success',
                                            'cancelled' => 'bg-error/20 text-error',
                                        ];

                                    @endphp


                                    <tr class="hover:bg-hover transition">


                                        {{-- NUMÉRO --}}
                                        <td class="px-6 py-5">

                                            <a href="{{ route('deposit-invoices-show', $depositInvoice) }}"
                                                class="text-primary font-medium hover:underline">

                                                {{ $depositInvoice->number }}

                                            </a>

                                        </td>


                                        {{-- CLIENT --}}
                                        <td class="px-6 py-5">

                                            <div class="text-primary">

                                                {{ $depositInvoice->quote->customer->company_name }}

                                            </div>

                                            <div class="text-secondary text-sm mt-1">

                                                {{ $depositInvoice->quote->customer->email }}

                                            </div>

                                        </td>


                                        {{-- DEVIS --}}
                                        <td class="px-6 py-5">

                                            <a href="{{ route('show-quote', $depositInvoice->quote) }}"
                                                class="text-secondary hover:text-primary transition">

                                                {{ $depositInvoice->quote->number }}

                                            </a>

                                        </td>


                                        {{-- MONTANT --}}
                                        <td class="px-6 py-5">

                                            <span class="text-primary font-medium">

                                                {{ number_format($depositInvoice->amount, 2, ',', ' ') }} €

                                            </span>

                                        </td>


                                        {{-- STATUT --}}
                                        <td class="px-6 py-5">

                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm border {{ $statusClasses[$depositInvoice->status] ?? 'bg-surface border-primary/10 text-secondary' }}">

                                                {{ $statusLabels[$depositInvoice->status] ?? ucfirst($depositInvoice->status) }}

                                            </span>

                                        </td>
                                        <td class="px-6 py-5">
                                            @php
                                                $pdfExists = Storage::disk('private')->exists(
                                                    'deposit_invoices/' . $depositInvoice->number . '.pdf',
                                                );
                                            @endphp

                                            @if ($pdfExists)
                                                <a href="{{ route('deposit-invoices-pdf', $depositInvoice) }}" target="_blank">
                                                    <img src="{{ asset('icon/admin/eye.svg') }}" class="w-5 h-5"
                                                        alt="Voir le PDF">
                                                </a>
                                            @else
                                                <img src="{{ asset('icon/admin/eye-closed.svg') }}"
                                                    class="w-5 h-5 opacity-40" alt="PDF absent">
                                            @endif
                                        </td>

                                        {{-- DATE --}}
                                        <td class="px-6 py-5 text-secondary">

                                            {{ $depositInvoice->issued_at?->format('d/m/Y') ?? '-' }}

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-6 py-5 text-right">

                                            <a href="{{ route('deposit-invoices-show', $depositInvoice) }}"
                                                class="inline-flex items-center justify-center px-4 py-2 rounded-[10px]
                                                       text-primary bg-surface border border-primary/10
                                                       hover:bg-hover transition">

                                                Voir

                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </div>

        </div>

    </section>

@endsection
