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
    <section id="formulaireContact" class="overflow-visible">
        <div class="flex justify-center px-3 py-3 overflow-visible">

            <form
                class="overflow-visible w-full max-w-[700px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                <div class="flex flex-col gap-[24px] overflow-visible">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px] overflow-visible">

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre nom <span class="text-red-500">*</span>
                            </label>
                            <input name="nom" type="text"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez votre nom complet" required>
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre email <span class="text-red-500">*</span>
                            </label>
                            <input name="email" type="email"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez votre email" required>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px] overflow-visible">

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre entreprise <span class="text-red-500">*</span>
                            </label>
                            <input name="entreprise" type="text"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez le nom de votre entreprise" required>
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Type de projet <span class="text-red-500">*</span>
                            </label>

                            <select id="typeProjet" name="type_projet"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                required>
                                <option value="">Sélectionnez le type de projet ...</option>

                                <option value="vitrine" {{ ($projet ?? '') === 'vitrine' ? 'selected' : '' }}>
                                    Site vitrine
                                </option>

                                <option value="landing" {{ ($projet ?? '') === 'landing' ? 'selected' : '' }}>
                                    Landing page
                                </option>
                            </select>
                        </div>

                    </div>

                    <div id="templateField"
                        class="flex flex-col gap-[6px] {{ ($projet ?? '') === 'landing' ? '' : 'hidden' }}">
                        <label class="text-label text-secondary">
                            Template sélectionné
                        </label>

                        <select name="template"
                            class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                            <option value="">Choisir un template (optionnel)</option>
                            <option value="template1" {{ ($template ?? '') === 'template1' ? 'selected' : '' }}>Template 1</option>
                            <option value="template2" {{ ($template ?? '') === 'template2' ? 'selected' : '' }}>Template 2</option>
                        </select>
                    </div>
                    <!-- Message -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">
                            Votre message <span class="text-red-500">*</span>
                        </label>

                        <textarea name="description_projet" rows="10" placeholder="Décrivez votre projet ..."
                            class="w-full p-3 text-label text-secondary bg-dark rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"
                            required></textarea>
                    </div>

                    <div class="flex flex-col gap-[10px] items-center">

                        <button type="submit"
                            class="text-primary text-button-inter bg-brand px-[12px] py-[20px] rounded-[12px] w-fit">
                            Envoyer ma demande
                        </button>

                        <p class="text-secondary text-button-inter">
                            Réponse sous 24 à 48h.
                        </p>

                    </div>

                    <!-- FOOT NOTE -->
                    <div class="flex justify-end">
                        <p class="text-secondary text-label">
                            <span class="text-red-500">*</span> Champs obligatoires
                        </p>
                    </div>

                </div>
            </form>

        </div>
    </section>
@endsection
