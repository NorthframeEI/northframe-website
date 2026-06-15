@extends('layouts.app')

@section('title', $template->title . ' - Template landing page - Northframe')

@section('meta_description', $template->short_description)

@section('og_title', $template->title . ' - Template Northframe')
@section('og_description', $template->short_description)
@section('og_image', asset('storage/' . $template->thumbnail_url))
@section('canonical', route('detail-template', ['slug' => $template->slug]))
@section('content')
    <div
        class="sticky top-[80px] z-10 bg-surface/80 backdrop-blur border border-primary/15 px-2 py-2 w-fit rounded-[10px] mt-6 ml-1">
        <a href="{{ route('template') }}" class="inline-flex items-center gap-2 text-secondary hover:text-primary transition">

            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M15 18l-6-6 6-6" />
            </svg>

            Retour
        </a>
    </div>
    <section id="hero">

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_500px] gap-10 lg:gap-[60px] items-center">

                <!-- LEFT -->
                <div>
                    <h3 class="text-primary text-h3-hero">
                        {{ $template->category }}
                    </h3>
                    <h1 class="text-primary text-h1-hero">
                        {{ $template->title }}
                    </h1>
                    <p class="text-primary md:text-h2-hero">
                        {{ $template->long_description }}
                    </p>
                    <div class="flex gap-[10px] px-[10px] py-[10px]">

                        <a href="{{ route('contact', ['projet' => 'landing', 'template' => $template->slug]) }}"
                            class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Choisir ce template
                        </a>

                        <a href="{{ asset('storage/' . $template->html_path) }}" target="_blank"
                            class="border-2 border-secondary hover:border-hover text-primary hover:text-hover text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Voir la démo
                        </a>

                    </div>
                </div>

                <!-- RIGHT (desktop only) -->

                <div class="w-full md:w-[500px]">
                    <img class="w-full h-auto aspect-video object-cover rounded-[12px]"
                        src="{{ asset('storage/' . $template->hero_image_url) }}"
                        alt="{{ $template->title }} - aperçu du template">
                </div>

            </div>

        </div>
    </section>

    <section id="apercuDesign" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Aperçu complet du design
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            Découvrez les différentes sections du template
        </h3>
        <div class="flex flex-wrap justify-center gap-[24px] px-[10px] py-[10px]">
            @foreach ($template->sections as $section)
                <div
                    class="w-full md:w-[calc(33.333%-16px)] rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">

                    @if ($section->image_url)
                        <div
                            class="w-full h-[260px] bg-dark rounded-[12px] flex items-center justify-center overflow-hidden">
                            <img class="w-full h-full object-contain" src="{{ asset('storage/' . $section->image_url) }}"
                                alt="{{ $template->title }} - section {{ $section->title }}">
                        </div>
                    @endif

                    <div class="px-6 py-4 flex flex-col gap-[10px]">
                        <div class="text-card-title text-primary text-center">
                            {{ $section->title }}
                        </div>

                        <p class="text-caption text-secondary text-center">
                            {{ $section->description }}
                        </p>
                    </div>

                </div>
            @endforeach

        </div>
    </section>
    <section id="pourquoi" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Pourquoi ce template ?
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            Un template pensé pour aller vite et générer des résultats.
        </h3>
        <div class="flex flex-wrap justify-center gap-[24px] px-[10px] py-[10px]">
            @foreach ($template->benefits as $benefit)
                <div
                    class="w-full md:w-[calc(33.333%-16px)] rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/badge-check.svg') }}" alt=""
                        aria-hidden="true">
                    <div class="px-6 py-4 flex flex-col gap-[10px]">
                        <div class="text-card-title text-primary text-center ">{{ $benefit->title }}</div>
                        <p class="text-caption text-secondary text-center">
                            {{ $benefit->description }}
                        </p>

                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <section id="personnalisation" class="p-[10px] scroll-mt-20">

        <h2 class="text-h2 text-primary text-center">
            Personnalisation du template
        </h2>

        <h3 class="text-h3 text-secondary text-center">
            Après sélection du template, nous adaptons les couleurs et le contenu à ton identité de marque lors de l’échange
            de validation.
        </h3>

        <div class="flex justify-center mt-4">

            <ul class="list-disc list-inside text-medium-20 text-secondary space-y-1">
                <li>Couleurs personnalisées</li>
                <li>Ajustement du contenu</li>
                <li>Adaptation légère des sections</li>
            </ul>

        </div>

    </section>
@endsection
