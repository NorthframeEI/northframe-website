@extends('layouts.app')

@section('title', 'Templates de sites web et landing pages - Northframe')

@section('meta_description',
    'Découvrez des templates de sites web modernes, landing pages et pages événementielles
    conçus pour convertir et être personnalisés rapidement.')
@section('content')
    <section id="hero">
        <div class="max-w-[1242px] mx-auto px-6 py-20">

            <div class="max-w-[700px] flex flex-col gap-6">

                <h1 class="text-h1 text-primary">
                    Des templates de sites modernes, prêts à l’emploi
                </h1>

                <p class="text-regular text-secondary">
                    Découvrez une sélection de templates de sites web, landing pages et pages événementielles conçus pour
                    convertir, entièrement personnalisables et prêts à être déployés.
                </p>

                <ul class="flex flex-wrap gap-4 text-navbar text-muted">
                    <li>✓ Responsive</li>
                    <li>✓ Optimisé conversion</li>
                    <li>✓ Prêt à utiliser</li>
                </ul>

                <a href="#templates"
                    class="flex items-center justify-center w-fit bg-brand hover:bg-hover text-primary text-button rounded-[10px] px-[12px] h-[48px] transition-all duration-200">
                    Explorer les templates
                </a>

            </div>

        </div>
    </section>
    <section id="templates">
        <div class="flex flex-wrap justify-center gap-[24px] px-[10px] py-[10px]">
            @if(isset($templates) && count($templates) === 0)
                <p class="text-regular text-secondary">Aucun template disponible pour le moment. Revenez plus tard !</p>
            @endif
            @foreach ($templates as $template)
                <a href="{{ route('detail-template', ['slug' => $template->slug]) }}"
                    class="w-full max-w-md rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
                    <img class="w-full aspect-video object-cover" src="{{ asset('storage/' . $template->thumbnail_url) }}"
                        alt="Template {{ $template->title }} - Aperçu du template">
                    <div class="px-6 py-4 flex flex-col gap-[10px]">
                        <div class="text-card-title text-primary text-center ">{{ $template->title }}</div>
                        <p class="text-caption text-secondary text-center">
                            {{ $template->short_description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="hidden">
        <h2 class="text-h2 text-primary">Section à venir</h2>
        <h2>Pourquoi utiliser un template ?</h2>
        <p class="text-regular text-secondary">Contenu en cours de création, restez à l’écoute pour plus d’informations !</p>
    </section>
@endsection
