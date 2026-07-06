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

                            <input type="date" name="valid_until"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

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
