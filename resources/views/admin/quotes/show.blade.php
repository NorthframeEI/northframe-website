@extends('admin.layouts.index')
@section('title', 'NF Admin - devis ' . $quote->number)

@section('admin.content')
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

                {{-- PREVIEW --}}
                <a href="{{ route('quotes-preview', $quote) }}"
                    class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]" target="_blank">
                    Prévisualiser
                </a>

                {{-- GENERATE PDF --}}
                <a href="#"
                    class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px]">
                    Télécharger PDF
                </a>

                {{-- CONVERT TO INVOICE --}}
                <form method="POST" action="#">
                    @csrf

                    <button type="submit"
                        class="text-primary bg-success hover:bg-hover px-[20px] py-[10px] rounded-[12px]">
                        Transformer en facture
                    </button>
                </form>

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

            {{-- INFOS DEVIS --}}
            <div
                class="w-full max-w-[900px] mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <p class="text-secondary">
                    <strong>Client :</strong> {{ $quote->customer->company_name }}
                </p>

                <p class="text-secondary">
                    <strong>Email :</strong> {{ $quote->customer->email }}
                </p>

                <p class="text-secondary">
                    <strong>Date émission :</strong> {{ $quote->issued_at }}
                </p>

                <p class="text-secondary">
                    <strong>Validité :</strong> {{ $quote->valid_until }}
                </p>

                <div class="mt-4">
                    <h2 class="text-h2 text-primary">
                        Total : {{ $quote->total }} €
                    </h2>
                </div>

            </div>

            {{-- FORM AJOUT LIGNE --}}
            <div
                class="w-full max-w-[900px] mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <h3 class="text-h3 text-primary mb-4">
                    Ajouter une ligne
                </h3>

                <form method="POST" action="{{ route('quotes-items-store', $quote) }}" class="flex flex-col gap-4">

                    @csrf

                    <input type="text" name="designation" placeholder="Description"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <input type="number" name="quantity" value="1" min="1"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <input type="number" name="unit_price" step="0.01" placeholder="Prix unitaire"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <button type="submit"
                        class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                        Ajouter ligne
                    </button>

                </form>
            </div>

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

                    </div>
                @endforeach

            </div>

        </div>

    </section>
@endsection
