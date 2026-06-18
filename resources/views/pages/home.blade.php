@extends('layouts.app')

@section('title', 'Northframe - Création de sites web et landing pages')
@section('meta_description',
    'Développeur web freelance spécialisé dans la création de sites vitrines, landing pages et
    interfaces web modernes, rapides et pensées pour convertir.')

@section('content')
    <!--Hero Section -->
    <section id="hero" class="relative overflow-hidden pt-10 lg:pt-16">
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
                            class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Voir mes projets
                        </a>

                        <a href="{{ route('contact') }}"
                            class="border-2 border-secondary hover:border-hover text-primary hover:text-hover text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Démarrer un projet
                        </a>

                    </div>
                </div>


                <!-- RIGHT (desktop only) -->
                <div class="hidden md:flex relative justify-center items-center overflow-visible">
                    <div class="relative w-[200px]">

                        <!-- Glow derrière -->
                        <div class="absolute inset-[-40px] -z-10 rounded-full bg-blue-600/20 blur-[60px]"></div>

                        <!-- Traits verticaux -->
                        <div class="absolute -top-32 left-[68%] h-40 w-px bg-brand/8"></div>
                        <div class="absolute -top-10 left-[70%] h-40 w-px bg-brand/8"></div>
                        <div class="absolute -top-32 left-[91%] h-40 w-px bg-brand/8"></div>

                        <img src="{{ asset('logos/logo_hero.svg') }}" alt="" aria-hidden="true"
                            class="absolute inset-0 w-full  opacity-30  -translate-x-[4px] -translate-y-[3.5px] drop-shadow-[0_0_8px_rgba(59,130,246,0.4)]">

                        <!-- Logo -->
                        <img src="{{ asset('logos/logo_hero.svg') }}" alt="Northframe Brand" class="relative z-10 w-full">

                        <!-- Reflet -->
                        <img src="{{ asset('logos/logo_hero.svg') }}" alt="" aria-hidden="true"
                            class="absolute left-0 top-[101%] rotate-[-2deg] w-full scale-y-[-1] opacity-50 blur-[1px]
            [mask-image:linear-gradient(to_top,rgba(0,0,0,0.5),transparent_70%)]">

                    </div>
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
                class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                

                <div
                    class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                    5 à 7 jours
                </div>
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
                        À partir de 400€
                    </p>
                    <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">
                        <a href="{{ route('contact', ['projet' => 'landing']) }}"
                            class="flex items-center justify-center bg-brand hover:bg-hover text-primary text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Choisir cette offre
                        </a>
                        <a href="{{ route('template') }}"
                            class="flex items-center justify-center border border-secondary hover:border-hover text-primary hover:text-hover text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                            Voir les templates
                        </a>
                    </div>

                </div>
            </div>
            <div
                class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                

                <div class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                    10 à 15 jours
                </div>
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
                            Développement optimisé pour les performances
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
                        <a href="{{ route('contact', ['projet' => 'vitrine']) }}"
                            class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200">Choisir
                            cette offre</a>
                    </div>
                </div>
            </div>

            <div
                class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                

                <div class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                    Support 24h
                </div>
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
            <div
                class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5">
                

                <div class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                    Selon planning
                </div>
                <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/users-round.svg') }}" alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Renfort technique / Freelance</div>
                    <p class="text-label text-secondary text-center">
                        Besoin d’un développeur pour renforcer votre équipe sur une mission ponctuelle ou sur plusieurs
                        semaines ?
                        J’interviens directement sur vos projets pour accélérer vos développements et fiabiliser vos
                        livraisons.
                    </p>

                    <ul class="list-disc pl-5 text-h3-footer text-secondary">
                        <li>Développement Laravel & PHP</li>
                        <li>JavaScript & interfaces modernes</li>
                        <li>Intégration responsive Tailwind CSS</li>
                        <li>Développement de fonctionnalités</li>
                        <li>Maintenance et corrections techniques</li>
                        <li>Collaboration avec vos équipes existantes</li>
                    </ul>
                    <p class="text-card-price text-primary text-center">
                        À partir de 200€/jour
                    </p>
                    <div class="flex gap-[10px] px-[10px] py-[10px]">
                        <a href="{{ route('contact', ['projet' => 'freelance']) }}"
                            class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button  cursor-pointer rounded-[10px] gap-[10px]  px-[12px] h-[48px] transition-all duration-200">Choisir
                            cette offre</a>
                    </div>
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
            <a href="#"
                class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px]
          hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02]
          border border-primary/5 hover:border-hover pointer-events-none">

                <!-- Badge overlay -->
                <div class="absolute top-4 left-4 z-10 bg-black/80 text-primary text-small px-3 py-2 rounded-full">
                    🔒 En attente d'autorisation
                </div>

                <img class="w-full aspect-video bg-white opacity-90"
                    src="{{ asset('screen_portfolio/ufr_artois_logo.png') }}" alt="Site vitrine">

                <div class="px-6 py-4 flex flex-col gap-[10px]">

                    <div class="text-card-title text-primary text-center">
                        UFR Artois — Outil de demande de télétravail
                    </div>

                    <div class="flex flex-wrap justify-center gap-[8px]">

                        <p class="text-label text-secondary text-center">
                            Conception et développement d’un outil de gestion interne pour dématérialiser le processus de
                            demande de télétravail et fluidifier les validations RH.
                        </p>

                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary">
                            #Laravel
                        </span>

                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary">
                            #Tailwind CSS
                        </span>

                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary">
                            #Javascript
                        </span>

                        <span
                            class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary">
                            #MySQL
                        </span>

                    </div>
                </div>

            </a>
            <a href="https://www.heliopales.com" target="_blank"
                class="w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02] border border-primary/5 hover:border-hover">
                <img class="w-full aspect-video" src="{{ asset('screen_portfolio/heliopales.png') }}"
                    alt="Site vitrine">
                <div class="px-6 py-4 flex flex-col gap-[10px]">
                    <div class="text-card-title text-primary text-center ">Héliopales - Site vitrine</div>
                    <div class="flex flex-wrap justify-center gap-[8px]">
                        <p class="text-label text-secondary text-center">
                            Site vitrine conçu au cours de mon alternance pour présenter l’activité de l’entreprise
                            Héliopales
                            avec une interface claire,
                            responsive et optimisée pour la navigation.
                        </p>
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


                </div>
            </a>
        </div>
    </section>
    <!--Process Section -->
    <section id="process" class="scroll-mt-[90px] pb-[120px]">
        <h2 class="text-h2 text-primary text-center">
            Une méthode claire et structurée
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            De la première discussion à la mise en ligne, chaque étape est claire et structurée.
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-2 gap-[10px] justify-center mx-auto w-fit pt-3">
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small">[01]</p>
                    <div class="text-card-title text-primary ">Analyse du besoin</div>
                </div>
                <p class="text-button text-muted">
                    Nous échangeons sur votre projet afin de comprendre vos besoins, vos objectifs et les
                    fonctionnalités attendues.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/message-circle.svg') }}"
                    alt="Analyse du besoin">

            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small">[02]</p>
                    <div class="text-card-title text-primary ">Conception</div>
                </div>
                <p class="text-button text-muted">
                    Je crée la structure et le design de votre site en mettant l’accent sur l’expérience utilisateur et la
                    clarté.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/panels-top-left.svg') }}"
                    alt="Conception">
            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small">[03]</p>
                    <div class="text-card-title text-primary ">Développement</div>
                </div>
                <p class="text-button text-muted">
                    Intégration et développement du site avec des technologies modernes, rapides et adaptées à votre projet.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/square-code.svg') }}" alt="Développement">
            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small">[04]</p>
                    <div class="text-card-title text-primary ">Mise en ligne</div>
                </div>
                <p class="text-button text-muted">
                    Mise en ligne du site et vérifications finales pour garantir un fonctionnement optimal.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/circle-check.svg') }}"
                    alt="Mise en ligne">
            </div>

        </div>
    </section>

    <!--CTA Final Section-->
    <section id="ctaFinal" class="p-[10px] scroll-mt-20">
        <h2 class="text-h2 text-primary text-center">
            Vous avez un projet ?
        </h2>
        <h3 class="text-h3 text-secondary text-center">
            Répondez à quelques questions et je vous recontacte rapidement pour discuter de votre besoin.
        </h3>
        <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">

            <a href="{{ route('contact') }}"
                class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                Démarrer un projet
            </a>



        </div>
    </section>
@endsection
