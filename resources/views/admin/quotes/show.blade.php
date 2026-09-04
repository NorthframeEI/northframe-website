@extends('admin.layouts.index')
@section('title', 'NF Admin - devis ' . $quote->number)

@section('admin.content')
    <div
        class="sticky top-[80px] z-10 bg-surface/80 backdrop-blur border border-primary/15 px-2 py-2 w-fit rounded-[10px] mt-6 ml-1">
        <a href="{{ route('list-quotes') }}"
            class="inline-flex items-center gap-2 text-secondary hover:text-primary transition">

            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M15 18l-6-6 6-6" />
            </svg>

            Retour
        </a>
    </div>
    <section id="showQuote">

        <div class="max-w-[1242px] mx-auto px-6 py-12">

            {{-- HEADER --}}
            <div class="grid grid-cols-1 gap-3 mb-10">
                <h1 class="text-h1 text-primary text-center">
                    Devis {{ $quote->number }}
                </h1>

                <p class="text-navbar text-secondary text-center">
                    Gestion du devis et de ses lignes
                </p>
            </div>
            <div class="w-full max-w-[900px] mx-auto mb-6 flex flex-wrap gap-3 justify-center">

                @php
                    $pdfExists = Storage::disk('private')->exists('quotes/' . $quote->number . '.pdf');
                @endphp


                {{-- PREVIEW PDF --}}
                <a href="{{ route('quotes-preview', $quote) }}"
                    class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]"
                    target="_blank">
                    Prévisualiser
                </a>


                {{-- DRAFT ACTIONS --}}
                @if ($quote->status === 'draft')

                    {{-- GENERATE PDF --}}
                    <form method="POST" action="{{ route('quotes-generate-pdf', $quote) }}">
                        @csrf

                        <button type="submit"
                            class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">
                            Générer le PDF
                        </button>
                    </form>


                    {{-- SEND QUOTE --}}
                    @if ($pdfExists)
                        <form method="POST" action="{{ route('quotes-sent', $quote) }}">
                            @csrf

                            <button type="submit"
                                class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">
                                Envoyer le devis
                            </button>
                        </form>
                    @endif
                @endif



                {{-- ACCEPTED --}}
                @if ($quote->status === 'accepted')
                    <form method="POST" action="{{ route('quotes-convert', $quote) }}">
                        @csrf

                        <button type="submit"
                            class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">
                            Transformer en facture
                        </button>
                    </form>
                @endif


            </div>

            {{-- SENT ACTIONS --}}
            @if ($quote->status === 'sent')
                <div class="w-full max-w-[900px] mx-auto mb-6 flex flex-wrap gap-3 justify-center">

                    {{-- ACCEPT --}}
                    <form method="POST" action="{{ route('quotes-accept', $quote) }}">
                        @csrf

                        <button type="submit"
                            class="text-primary bg-success hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">
                            Accepter le devis
                        </button>
                    </form>


                    {{-- REJECT --}}
                    <form method="POST" action="{{ route('quotes-reject', $quote) }}">
                        @csrf

                        <button type="submit"
                            class="text-primary bg-error hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">
                            Refuser le devis
                        </button>
                    </form>

                </div>
            @endif
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

            {{-- INFOS DEVIS --}}
            <div
                class="w-full max-w-[900px] mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Client --}}
                    <div>
                        <p class="text-secondary">
                            <strong>Client :</strong> {{ $quote->customer->company_name }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>Email :</strong> {{ $quote->customer->email }}
                        </p>
                        <p class="text-secondary mt-2">
                            <strong>SIRET :</strong> {{ $quote->customer->siret }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>Objet :</strong> {{ $quote->subject }}
                        </p>
                    </div>

                    {{-- Dates --}}
                    <div class="md:text-right">
                        <p class="text-secondary">
                            <strong>Date d'émission :</strong>
                            {{ $quote->issued_at->format('d/m/Y') }}
                        </p>

                        <p class="text-secondary mt-2">
                            <strong>Validité :</strong>
                            {{ $quote->valid_until->format('d/m/Y') }}
                        </p>
                    </div>

                </div>

                {{-- Total --}}
                <div class="mt-6 pt-6 border-t border-primary/5">
                    <h2 class="text-h2 text-primary">
                        Total : {{ number_format($quote->total, 2, ',', ' ') }} €
                    </h2>
                </div>

            </div>

            @if ($quote->status === 'draft')
                {{-- FORM AJOUT LIGNE --}}
                <div
                    class="w-full max-w-[900px] mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                    <h3 class="text-h3 text-primary mb-4">
                        Ajouter une ligne
                    </h3>

                    <form method="POST" action="{{ route('quotes-items-store', $quote) }}" class="flex flex-col gap-4">

                        @csrf

                        {{-- Désignation --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Désignation
                            </label>

                            <input type="text" name="designation" value="{{ old('designation') }}"
                                placeholder="Ex : Création site vitrine"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>


                        {{-- Description --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Description (optionnel)
                            </label>

                            <textarea name="description" rows="3" placeholder="Détails de la prestation..."
                                class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">{{ old('description') }}</textarea>

                        </div>


                        {{-- Quantité --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Quantité
                            </label>

                            <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>


                        {{-- Prix --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Prix unitaire (€)
                            </label>

                            <input type="number" name="unit_price" value="{{ old('unit_price') }}" step="0.01"
                                placeholder="Ex : 1200"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>


                        {{-- Type --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Type de prestation
                            </label>

                            <select name="type" id="type"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                <option value="one_time">
                                    Prestation ponctuelle
                                </option>

                                <option value="recurring">
                                    Abonnement
                                </option>

                            </select>

                        </div>


                        {{-- Période abonnement --}}
                        <div id="billing_period_container" class="hidden flex-col gap-2">

                            <label class="text-secondary">
                                Période de facturation
                            </label>

                            <select name="billing_period"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                <option value="monthly">
                                    Mensuel
                                </option>

                                <option value="yearly">
                                    Annuel
                                </option>

                            </select>

                        </div>
                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                            Ajouter ligne
                        </button>

                    </form>
                </div>
            @endif
            {{-- LIGNES --}}
            <div
                class="w-full max-w-[900px] mx-auto rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <h3 class="text-h3 text-primary mb-4">
                    Lignes du devis
                </h3>

                @foreach ($quote->items as $item)
                    <div class="flex justify-between items-center py-3 border-b border-primary/10">

                        <div>
                            <p class="text-secondary font-semibold">
                                {{ $item->designation }}
                            </p>
                            <p class="text-secondary/60 text-sm">
                                {{ $item->quantity }} × {{ $item->unit_price }} €
                            </p>
                        </div>
                        @if ($quote->status === 'draft')
                            <div class="flex items-center gap-4">
                                <p class="text-primary font-bold">
                                    {{ $item->total }} €
                                </p>

                                <form method="POST" action="{{ route('quote-items-delete', $item) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="text-error hover:underline">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach

            </div>

        </div>

    </section>
@endsection
