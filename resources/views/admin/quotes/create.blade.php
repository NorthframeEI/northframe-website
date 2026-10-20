@extends('admin.layouts.index')
@section('title', 'NF Admin - créer un devis')
@section('admin.content')
    <section id="createCategory">
        <div class="max-w-[1242px] mx-auto px-6 py-12">

            <div class="grid grid-cols-1 gap-6 justify-center mb-10">
                <h1 class="text-h1 text-primary text-center">
                    Créer un devis
                </h1>
                <p class="text-navbar text-secondary text-center">
                    Ajoute les informations du devis.
                </p>
            </div>

            <div class="flex flex-col items-center px-3 py-3 gap-4">

                <div class="w-full max-w-[900px]">
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

                <form method="POST" action="{{ route('store-quote') }}"
                    class="w-full max-w-[900px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                    @csrf

                    {{-- CLIENT --}}
                    <div class="mb-6">
                        <h3 class="text-h3 text-primary mb-4">Informations client</h3>

                        <div class="flex flex-col gap-4">

                            <input type="text" name="company_name" placeholder="Nom de la société / client"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            <input type="text" name="contact_name" placeholder="Nom du contact"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            <input type="email" name="email" placeholder="Email"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            <input type="text" name="phone" placeholder="Téléphone"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>
                    </div>
                    {{-- SIRET --}}
                    <div class="mb-6">

                        <div class="flex flex-col gap-4">

                            <input type="text" name="siret" placeholder="Numéro SIRET"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">


                        </div>
                    </div>

                    {{-- ADRESSE --}}
                    <div class="mb-6">
                        <h3 class="text-h3 text-primary mb-4">Adresse</h3>

                        <div class="flex flex-col gap-4">

                            <input type="text" name="address" placeholder="Adresse"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            <div class="grid grid-cols-2 gap-4">

                                <input type="text" name="postal_code" placeholder="Code postal"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                <input type="text" name="city" placeholder="Ville"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            </div>

                            <input type="text" name="country" value="France"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>
                    </div>

                    {{-- INFOS DEVIS --}}
                    <div class="mb-6">
                        <h3 class="text-h3 text-primary mb-4">Informations devis</h3>

                        <div class="flex flex-col gap-4">
                            <input type="date" name="issued_at" value="{{ now()->toDateString() }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">


                        </div>
                    </div>
                    <div class="mb-6 flex flex-col gap-4">

                        <div>
                            <label for="subject" class="sr-only">Sujet du devis</label>
                            <input type="text" id="subject" name="subject" placeholder="Sujet du devis"
                                value="{{ old('subject', $quote->subject ?? '') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-hover outline-none transition">
                            @error('subject')
                                <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="hidden" name="requires_deposit" value="0">
                            <label for="requires_deposit"
                                class="flex items-center gap-[10px] text-body text-secondary cursor-pointer">
                                <input type="checkbox" id="requires_deposit" name="requires_deposit" value="1"
                                    aria-describedby="requires_deposit_help"
                                    class="w-[18px] h-[18px] accent-brand cursor-pointer"
                                    {{ old('requires_deposit', $quote->requires_deposit ?? true) ? 'checked' : '' }}>
                                Acompte de 50 % à la commande
                            </label>
                            <p id="requires_deposit_help" class="mt-1 pl-[28px] text-small text-muted">
                                Décoche pour une landing page ou un paiement intégral au démarrage.
                            </p>
                        </div>

                    </div>

                    {{-- SUBMIT --}}
                    <div class="flex flex-col gap-[10px] items-center">
                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                            Créer devis
                        </button>
                    </div>

                </form>
    </section>
@endsection
