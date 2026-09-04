@extends('admin.layouts.index')
@section('title', 'NF Admin - facture d\'acompte ' . $depositInvoice->number)

@section('admin.content')

    {{-- RETOUR --}}
    <div
        class="sticky top-[80px] z-10 bg-surface/80 backdrop-blur border border-primary/15 px-2 py-2 w-fit rounded-[10px] mt-6 ml-1">

        <a href="{{ route('list-deposit-invoices') }}"
            class="inline-flex items-center gap-2 text-secondary hover:text-primary transition">

            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M15 18l-6-6 6-6" />
            </svg>

            Retour
        </a>
    </div>


    <section id="showDepositInvoice">

        <div class="max-w-[1242px] mx-auto px-6 py-12">

            {{-- HEADER --}}
            <div class="grid grid-cols-1 gap-3 mb-10">

                <h1 class="text-h1 text-primary text-center">
                    Facture d'acompte {{ $depositInvoice->number }}
                </h1>

                <p class="text-navbar text-secondary text-center">
                    Gestion de la facture d'acompte
                </p>

            </div>


            {{-- ACTIONS --}}
            <div class="w-full max-w-[900px] mx-auto mb-6 flex flex-wrap gap-3 justify-center">

                @php
                    $pdfExists = Storage::disk('private')->exists(
                        'deposit_invoices/' . $depositInvoice->number . '.pdf'
                    );
                @endphp


                {{-- PREVIEW PDF --}}
                <a href="{{ route('deposit-invoices-preview', $depositInvoice) }}"
                    class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]"
                    target="_blank">

                    Prévisualiser

                </a>


                {{-- GENERATE PDF --}}
                @if (!$pdfExists)

                    <form method="POST"
                        action="{{ route('deposit-invoices-generate-pdf', $depositInvoice) }}">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Générer le PDF

                        </button>

                    </form>

                @endif


                {{-- SEND --}}
                @if ($pdfExists && $depositInvoice->status === 'draft')

                    <form method="POST"
                        action="{{ route('deposit-invoices-send', $depositInvoice) }}">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Envoyer la facture

                        </button>

                    </form>

                @endif

            </div>


            {{-- ALERTS --}}
            <div class="w-full max-w-[900px] mx-auto mb-6">

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


            {{-- INFORMATIONS FACTURE D'ACOMPTE --}}
            <div
                class="w-full max-w-[900px] mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- Client --}}
                    <div>

                        <p class="text-secondary">
                            <strong>Client :</strong>
                            {{ $depositInvoice->quote->customer->company_name }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>Email :</strong>
                            {{ $depositInvoice->quote->customer->email }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>SIRET :</strong>
                            {{ $depositInvoice->quote->customer->siret }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>Devis :</strong>
                            {{ $depositInvoice->quote->number }}
                        </p>

                    </div>


                    {{-- Dates + statut --}}
                    <div class="md:text-right">

                        <p class="text-secondary">
                            <strong>Date d'émission :</strong>

                            {{ $depositInvoice->issued_at?->format('d/m/Y') ?? '-' }}

                        </p>


                        <p class="text-secondary mt-2">

                            <strong>Date d'envoi :</strong>

                            {{ $depositInvoice->sent_at?->format('d/m/Y') ?? '-' }}

                        </p>


                        <p class="text-secondary mt-2">

                            <strong>Statut :</strong>

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

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm border {{ $statusClasses[$depositInvoice->status] ?? 'bg-surface border-primary/10 text-secondary' }}">

                                {{ $statusLabels[$depositInvoice->status] ?? ucfirst($depositInvoice->status) }}

                            </span>

                        </p>

                    </div>

                </div>


                {{-- MONTANT --}}
                <div class="mt-6 pt-6 border-t border-primary/5">

                    <p class="text-secondary mb-2">
                        <strong>Acompte :</strong> 50 % du montant du devis
                    </p>

                    <h2 class="text-h2 text-primary">

                        Montant :
                        {{ number_format($depositInvoice->amount, 2, ',', ' ') }} €

                    </h2>

                </div>

            </div>


            {{-- LIEN VERS LA FACTURE --}}
            @if ($depositInvoice->invoice)

                <div
                    class="w-full max-w-[900px] mx-auto rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>

                            <p class="text-secondary">
                                <strong>Facture associée</strong>
                            </p>

                            <p class="text-primary mt-2">
                                {{ $depositInvoice->invoice->number }}
                            </p>

                        </div>

                        <a href="{{ route('invoices-show', $depositInvoice->invoice) }}"
                            class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] text-center">

                            Voir la facture

                        </a>

                    </div>

                </div>

            @endif

        </div>

    </section>

@endsection
