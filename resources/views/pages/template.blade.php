@extends('layouts.app')

@section('content')
    <section id="hero">
        <div class="max-w-[1242px] mx-auto px-6 py-20">

            <div class="max-w-[700px] flex flex-col gap-6">

                <h1 class="text-h1 text-primary">
                    Des templates de sites modernes, prêts à l’emploi
                </h1>

                <p class="text-regular text-secondary">
                    Gagnez du temps avec des designs professionnels conçus pour convertir,
                    entièrement personnalisables et adaptés à votre activité.
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-[24px] px-[10px] py-[10px]">
             <a href="{{route('detail-template')}}"
                class="w-full rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
               <img class="w-full aspect-video object-cover" src="{{ asset('screen_portfolio/heliopales.png') }}"
                    alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">SaaS Landing Pro</div>
                    <p class="text-caption text-secondary text-center">
                        Landing page moderne optimisée pour convertir tes visiteurs en clients.
                    </p>
                </div>
            </a>
            <a href="{{route('detail-template')}}" 
                class="w-full rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
                <img class="w-full aspect-video object-cover" src="{{ asset('screen_portfolio/heliopales.png') }}"
                    alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Agency Landing Clean</div>
                    <p class="text-caption text-secondary text-center">
                        Template épuré pour agences modernes, pensé pour la crédibilité et la conversion.
                    </p>
                </div>
            </a>
            <a href="{{route('detail-template')}}" 
                class="w-full rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
                <img class="w-full aspect-video object-cover" src="{{ asset('screen_portfolio/heliopales.png') }}"
                    alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Startup Launch Template</div>
                    <p class="text-caption text-secondary text-center">
                        Landing rapide et efficace pour lancer ton produit et valider ton idée.
                    </p>
                </div>
            </a>
        </div>
    </section>
@endsection
