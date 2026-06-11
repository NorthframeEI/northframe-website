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

        <div class="flex flex-col items-center px-3 py-3 gap-4">

            <!-- MESSAGES (alignés avec la card) -->
            <div class="w-full max-w-[700px]">

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


            <form action="{{ route('contact.post') }}" method="POST" autocomplete="on" novalidate
                class="overflow-visible w-full max-w-[700px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
                @csrf
                <div class="flex flex-col gap-[24px] overflow-visible">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px] overflow-visible">

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre nom <span class="text-red-500">*</span>
                            </label>
                            <input name="nom" autocomplete="name" type="text" value="{{ old('nom') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez votre nom complet" required>

                            @error('nom')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre email <span class="text-red-500">*</span>
                            </label>
                            <input name="email" type="email" value="{{ old('email') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez votre email" autocomplete="email" required>

                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px] overflow-visible">

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Votre entreprise <span class="text-red-500">*</span>
                            </label>
                            <input name="entreprise" type="text" value="{{ old('entreprise') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition"
                                placeholder="Entrez le nom de votre entreprise" autocomplete="organization" required>

                            @error('entreprise')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">
                                Type de projet <span class="text-red-500">*</span>
                            </label>

                            <select id="typeProjet" name="type_projet"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                <option value="">Sélectionnez le type de projet ...</option>

                                <option value="vitrine" {{ old('type_projet', request('projet')) === 'vitrine' ? 'selected' : '' }}>
                                    Site vitrine
                                </option>

                                <option value="landing" {{ old('type_projet', request('projet')) === 'landing' ? 'selected' : '' }}>
                                    Landing page
                                </option>
                            </select>

                            @error('type_projet')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
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

                            <option value="template1" {{ old('template', request('template')) === 'template1' ? 'selected' : '' }}>
                                Template 1
                            </option>

                            <option value="template2" {{ old('template', request('template')) === 'template2' ? 'selected' : '' }}>
                                Template 2
                            </option>
                        </select>
                    </div>
                    <!-- Message -->
                    <div class="flex flex-col gap-[6px]">
                        <label class="text-label text-secondary">
                            Votre message <span class="text-red-500">*</span>
                        </label>

                        <textarea name="contenuMessage" rows="10" placeholder="Décrivez votre projet ..."
                            class="w-full p-3 text-label text-secondary bg-dark rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"
                            required>{{ old('contenuMessage') }}</textarea>

                        @error('contenuMessage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-[10px] items-center">

                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[12px] py-[20px] rounded-[12px] w-fit cursor-pointer">
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
