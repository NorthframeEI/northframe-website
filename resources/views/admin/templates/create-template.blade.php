@extends('admin.layouts.index')
@section('title', 'NF Admin - Créer un template')
@section('admin.content')
    <section id="createTemplate">
        <div class="max-w-[1242px] mx-auto px-6 py-12">

            <div class="grid grid-cols-1 gap-6 justify-center mb-10">
                <h1 class="text-h1 text-primary text-center">
                    Créer un template
                </h1>
                <p class="text-navbar text-secondary text-center">
                    Ajoute les informations du template, ses avantages, ses sections et sa galerie.
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

                <form action="{{ route('store-template') }}" method="POST"
                    class="w-full max-w-[900px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
                    @csrf

                    <div class="flex flex-col gap-[32px]">

                        {{-- Infos principales --}}
                        <div class="flex flex-col gap-[16px]">
                            <h2 class="text-h3 text-primary">Informations générales</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Titre <span
                                            class="text-red-500">*</span></label>
                                    <input name="title" value="{{ old('title') }}" required
                                    placeholder="SaaS Landing Pro"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Slug <span
                                            class="text-red-500">*</span></label>
                                    <input name="slug" value="{{ old('slug') }}" required
                                        placeholder="saas-landing-pro"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Catégorie</label>
                                    <input name="category" value="{{ old('category') }}" placeholder="Landing page"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">URL démo</label>
                                    <input name="demo_url" value="{{ old('demo_url') }}" placeholder="https://..."
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Image card</label>
                                    <input name="thumbnail_url" value="{{ old('thumbnail_url') }}"
                                        placeholder="/images/templates/card.jpg"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Image hero</label>
                                    <input name="hero_image_url" value="{{ old('hero_image_url') }}"
                                        placeholder="/images/templates/hero.jpg"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>
                            </div>

                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Description courte <span
                                        class="text-red-500">*</span></label>
                                <input name="short_description" value="{{ old('short_description') }}" required
                                placeholder="Un template moderne pour les SaaS"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                            </div>

                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Description longue</label>
                                <textarea name="long_description" rows="5"
                                placeholder="Ce template est conçu pour les entreprises SaaS qui souhaitent présenter leurs produits de manière élégante et professionnelle. Avec une section héros accrocheuse, des avantages clairs et une galerie d'images, c'est le choix parfait pour attirer et convertir les visiteurs."
                                    class="w-full p-3 text-label text-secondary bg-dark rounded-[10px] focus:border-brand focus:border outline-none transition resize-none">{{ old('long_description') }}</textarea>
                            </div>
                        </div>

                        {{-- Benefits --}}
                        <div class="flex flex-col gap-[16px]">
                            <div class="flex items-center justify-between gap-4">
                                <h2 class="text-h3 text-primary">Pourquoi ce template ?</h2>
                                <button type="button" onclick="addBenefit()"
                                    class="text-primary text-button-inter bg-brand hover:bg-hover px-4 py-3 rounded-[12px] cursor-pointer">
                                    + Ajouter
                                </button>
                            </div>

                            <div id="benefitsWrapper" class="flex flex-col gap-[16px]"></div>
                        </div>

                        {{-- Sections --}}
                        <div class="flex flex-col gap-[16px]">
                            <div class="flex items-center justify-between gap-4">
                                <h2 class="text-h3 text-primary">Sections du template</h2>
                                <button type="button" onclick="addSection()"
                                    class="text-primary text-button-inter bg-brand hover:bg-hover px-4 py-3 rounded-[12px] cursor-pointer">
                                    + Ajouter
                                </button>
                            </div>

                            <div id="sectionsWrapper" class="flex flex-col gap-[16px]"></div>
                        </div>

                        {{-- Options --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                            <label class="flex items-center gap-3 text-label text-secondary">
                                <input type="checkbox" name="is_featured" value="1" class="rounded border-transparent">
                                Mettre en avant
                            </label>

                            <label class="flex items-center gap-3 text-label text-secondary">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="rounded border-transparent">
                                Template actif
                            </label>
                        </div>

                        <div class="flex flex-col gap-[10px] items-center">
                            <button type="submit"
                                class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                                Créer le template
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        let benefitIndex = 0;
        let sectionIndex = 0;

        function removeBlock(button) {
            button.closest('.dynamic-block').remove();
        }

        function addBenefit() {
            const wrapper = document.getElementById('benefitsWrapper');

            wrapper.insertAdjacentHTML('beforeend', `
            <div class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">
                <div class="flex justify-between items-center">
                    <p class="text-body-bold text-primary">Avantage</p>
                    <button type="button" onclick="removeBlock(this)" class="text-error text-label">Supprimer</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-[16px]">
                    <input name="benefits[${benefitIndex}][title]" placeholder="Titre"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                </div>

                <textarea name="benefits[${benefitIndex}][description]" rows="3" placeholder="Description"
                    class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"></textarea>
            </div>
        `);

            benefitIndex++;
        }

        function addSection() {
            const wrapper = document.getElementById('sectionsWrapper');

            wrapper.insertAdjacentHTML('beforeend', `
            <div class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">
                <div class="flex justify-between items-center">
                    <p class="text-body-bold text-primary">Section</p>
                    <button type="button" onclick="removeBlock(this)" class="text-error text-label">Supprimer</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                    <input name="sections[${sectionIndex}][title]" placeholder="Titre section"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <input name="sections[${sectionIndex}][image_url]" placeholder="/images/templates/section.jpg"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                </div>

                <textarea name="sections[${sectionIndex}][description]" rows="3" placeholder="Description"
                    class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"></textarea>
            </div>
        `);

            sectionIndex++;
        }

        

        addBenefit();
        addSection();
    </script>
@endsection
