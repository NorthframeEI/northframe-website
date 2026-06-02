@extends('layouts.app')

@section('content')

    <!--Hero Section -->
    <section id="hero">
        <div class="max-w-[1242px] mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_500px] gap-10 lg:gap-[60px] items-center">

                <!-- LEFT -->
                <div>
                    <h3 class="text-primary text-h3-hero">
                        Développeur web freelance
                    </h3>
                    <h1 class="text-primary text-h1-hero">
                        Des sites web modernes qui transforment vos visiteurs en clients
                    </h1>
                    <h2 class="text-primary md:text-h2-hero">
                        J’aide les marques et les entreprises à se démarquer grâce à des interfaces web rapides, claires et
                        efficaces.
                    </h2>
                    <div class="flex gap-[10px] px-[10px] py-[10px]">

                        <a href="#portfolio"
                            class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200">
                            Voir mes projets
                        </a>

                        <a href="#"
                            class="border-2 border-secondary hover:border-hover text-primary hover:text-hover text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px transition-all duration-200">
                            Démarrer un projet
                        </a>

                    </div>
                </div>

                <!-- RIGHT (desktop only) -->

                <div class="hidden md:block relative w-[500px] flex justify-center">
                    <img src="{{ asset('logos/logo_hero.svg') }}" class="block z-10">
                </div>

            </div>

        </div>
    </section>


    <!--Services Section -->
    <section id="services" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Mes services
        </h2>
        <div class="flex flex-wrap justify-center gap-[10px]  pt-3">
            <div
                class="w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/globe.svg') }}" alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Site vitrine professionnel</div>
                    <p class="text-label text-secondary text-center">
                        Donnez une image crédible et moderne de votre activité avec un site rapide, clair et pensé pour
                        convertir vos visiteurs en clients.
                    </p>
                    <ul class="list-disc pl-5 text-h3-footer text-secondary whitespace-nowrap">
                        <li>
                            Design sur mesure
                        </li>
                        <li>
                            Site responsive (mobile, tablette, desktop)
                        </li>
                        <li>
                            Développement rapide et performant
                        </li>
                        <li>
                            SEO de base optimisé
                        </li>
                        <li>
                            Mise en ligne incluse
                        </li>
                    </ul>
                    <p class="text-card-price text-primary text-center">
                        À partir de 1100€
                    </p>
                    <div class="flex gap-[10px] px-[10px] py-[10px]">
                        <a href="#"
                            class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200">Choisir
                            cette offre</a>
                    </div>
                </div>
            </div>
            <div
                class="w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/rocket.svg') }}" alt="Landing page">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Landing page</div>
                    <p class="text-label text-secondary text-center">
                        Une page stratégique pensée pour convertir vos visiteurs en clients grâce à un message clair et
                        impactant.
                    </p>
                    <ul class="list-disc pl-5 text-h3-footer text-secondary whitespace-nowrap">
                        <li>
                            Design orienté conversion
                        </li>
                        <li>
                            Structure optimisée pour vendre
                        </li>
                        <li>
                            Intégration rapide et légère
                        </li>
                        <li>
                            Responsive mobile
                        </li>
                        <li>
                            Mise en ligne incluse
                        </li>
                    </ul>
                    <p class="text-card-price text-primary text-center">
                        À partir de 700€
                    </p>
                    <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">
                        <a href="#"
                            class="flex items-center justify-center bg-brand hover:bg-hover text-primary text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Choisir cette offre
                        </a>
                        <a href="#"
                            class="flex items-center justify-center border border-secondary hover:border-hover text-primary hover:text-hover text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Voir les templates
                        </a>
                    </div>

                </div>
            </div>
            <div
                class="w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/cog.svg') }}" alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Maintenance</div>
                    <p class="text-label text-secondary text-center">
                        Assurez la stabilité et la sécurité de votre site avec un suivi régulier, des mises à jour
                        techniques et des corrections en cas de besoin.
                    </p>
                    <ul class="list-disc pl-5 text-h3-footer text-secondary whitespace-nowrap">
                        <li>
                            Mises à jour régulières du site
                        </li>
                        <li>
                            Corrections techniques
                        </li>
                        <li>
                            Sécurité et surveillance
                        </li>
                        <li>
                            Support en cas de problème
                        </li>
                        <li class="hidden">
                            Sauvegardes (optionnel si tu veux l’ajouter plus tard)
                        </li>
                    </ul>

                    <p class="text-card-price text-primary text-center">
                        29€/mois
                    </p>
                </div>
            </div>
        </div>

    </section>

    <!--Portfolio Section -->
    <section id="portfolio" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Mes réalisations
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            Des sites web conçus pour allier performance, clarté et expérience utilisateur.
        </h3>
        <div class="flex flex-wrap justify-center gap-[10px]  pt-3">

            <a href="https://www.heliopales.com" target="_blank"
                class="w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
                <img class="w-full aspect-video object-cover" src="{{ asset('screen_portfolio/heliopales.png') }}"
                    alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Héliopales - Site vitrine</div>
                    <div class="flex flex-wrap justify-center gap-[8px]">
                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary mr-2 mb-2">#PHP</span>
                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary mr-2 mb-2">#Bulma
                            CSS</span>
                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary mr-2 mb-2">#Javascript</span>
                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary mr-2 mb-2">#MySql</span>
                    </div>
                    <p class="text-label text-secondary text-center">
                        Site vitrine conçu au cours de mon alternance pour présenter l’activité de l’entreprise Héliopales
                        avec une interface claire,
                        responsive et optimisée pour la navigation.
                    </p>

                </div>
            </a>
        </div>
    </section>
    <!--Process Section -->
    <section id="process" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Une méthode claire et structurée
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            De la première discussion à la mise en ligne, chaque étape est claire et structurée.
        </h3>
        <div class="flex flex-wrap justify-center gap-[10px] pt-3">

            
        </div>
    </section>
@endsection
