@extends('admin.layouts.index')

@section('title', 'NF Admin - Liste des factures')

@section('admin.content')

    <section>

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <div>
                    <p class="text-body-bold text-brand">
                        LISTE DES FACTURES
                    </p>

                    <h1 class="text-h1 text-primary">
                        Gestion des factures
                    </h1>
                </div>

            </div>


            <div class="w-full mb-6">

                @if (session('success'))
                    <div class="p-4 bg-success/30 border border-success text-success rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif


                @if ($errors->any())

                    <div class="p-4 bg-error/30 border border-error text-error rounded-lg">

                        <ul class="space-y-1">

                            @foreach ($errors->all() as $error)
                                <li>
                                    • {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                @endif

            </div>


            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden">


                <table class="w-full">

                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Facture N°
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Client
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Date d'émission
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Total
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Voir la facture
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Etat
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                PDF
                            </th>


                        </tr>

                    </thead>


                    <tbody>


                        @forelse($invoices as $invoice)
                            <tr class="border-b border-primary/5 hover:bg-dark transition">


                                <td class="px-6 py-5">

                                    <span class="text-primary text-body-bold">
                                        {{ $invoice->number }}
                                    </span>

                                </td>


                                <td class="px-6 py-5">

                                    <span class="text-primary text-body-bold">
                                        {{ $invoice->customer->company_name }}
                                    </span>

                                </td>


                                <td class="px-6 py-5">

                                    <span class="text-primary text-body-bold">

                                        @if ($invoice->issued_at)
                                            {{ $invoice->issued_at->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif

                                    </span>

                                </td>


                                <td class="px-6 py-5">

                                    <span class="text-primary text-body-bold">

                                        {{ number_format($invoice->total, 2, ',', ' ') }} €

                                    </span>

                                </td>


                                <td class="px-6 py-5">

                                    <a href="{{ route('invoices-show', $invoice) }}"
                                        class="text-brand text-small hover:underline">

                                        Voir la facture

                                    </a>

                                </td>


                                <td class="px-6 py-5">

                                    @php

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

                                    @endphp


                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$invoice->status] }}">

                                        {{ $statusLabels[$invoice->status] }}

                                    </span>


                                </td>


                                <td class="px-6 py-5">

                                    @php

                                        $pdfExists = Storage::disk('private')->exists(
                                            'invoices/' . $invoice->number . '.pdf',
                                        );

                                    @endphp


                                    @if ($pdfExists)
                                        <a href="{{ route('invoices-preview-pdf', $invoice) }}" target="_blank">

                                            <img src="{{ asset('icon/admin/eye.svg') }}" class="w-5 h-5" alt="Voir le PDF">

                                        </a>
                                    @else
                                        <img src="{{ asset('icon/admin/eye-closed.svg') }}" class="w-5 h-5 opacity-40"
                                            alt="PDF absent">
                                    @endif


                                </td>


                            </tr>


                        @empty


                            <tr>

                                <td colspan="8" class="py-10 text-center text-secondary">

                                    Aucune facture enregistrée.

                                </td>

                            </tr>
                        @endforelse


                    </tbody>


                </table>


            </div>


        </div>


    </section>

@endsection
