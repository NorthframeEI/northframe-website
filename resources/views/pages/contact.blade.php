@extends('layouts.app')

@section('content')
    <section id="introContact">
        <div class="max-w-[1242px] mx-auto px-6">

            <div class="grid grid-cols-1 gap-10 justify-center">

                <p class="text-body-bold text-brand text-center">CONTACT</p>
                <h1 class="text-h1 text-primary text-center">
                    Parlons de votre projet
                </h1>
                <p class="text-navbar text-primary text-center">
                    Répondez à quelques questions et je reviendrai vers vous rapidement pour discuter de votre besoin.
                </p>
            </div>

        </div>
    </section>

    <section id="formulaireContact">
        <div class="flex flex-wrap justify-center gap-[10px] px-3 py-3">
            <div
                class="w-[700px] rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">

                    <!-- Nom -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">Votre nom</label>
                        <input type="text"
                            class="h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 focus:border-brand outline-none transition"
                            placeholder="Entrez votre nom complet">
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">Votre email</label>
                        <input type="email"
                            class="h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 focus:border-brand outline-none transition"
                            placeholder="Entrez votre email">
                    </div>

                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                    <!-- Entreprise -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">Votre entreprise</label>
                        <input type="text"
                            class="h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 focus:border-brand outline-none transition"
                            placeholder="Entrez votre nom complet">
                    </div>

                    <!-- Type de projet -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">Type de projet</label>
                        <select
                            class="h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 focus:border-brand focus:border outline-none transition">
                            <option>Sélectionnez le type de projet ...</option>
                            <option>Site vitrine</option>
                            <option>Landing page</option>
                        </select>
                    </div>
                </div>
                <div class="md:col-span-2 flex flex-col gap-[6px]">
                    <label class="text-label text-secondary">Votre message</label>
                    <textarea name="message" id="message" rows="10" placeholder="Décrivez votre projet ..."
                        class="w-full p-3 text-label text-secondary bg-dark rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"></textarea>
                </div>
            </div>
        </div>
    </section>
@endsection
