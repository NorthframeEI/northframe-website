@extends('layouts.app')

@extends('layouts.app')

@section('title')Développeur web freelance à Arras | Sites vitrines & landing pages – Northframe @endsection

@section('meta_description')Développeur web freelance Laravel à Arras : sites vitrines, landing pages et refontes optimisés SEO. Sur place (50 km) ou en remote partout en France. @endsection

@section('og_title')Développeur web freelance à Arras | Northframe @endsection

@section('og_description')Sites vitrines, landing pages et refontes optimisés SEO. Arras, Hauts-de-France et full remote. @endsection

@section('content')
    <!--Hero Section -->
    <section id="hero" aria-labelledby="hero-title" class="relative overflow-hidden pt-10 lg:pt-16">
        <div class="max-w-[1242px] mx-auto px-6">

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_500px] gap-10 lg:gap-[60px] items-center">

                <!-- LEFT -->
                <div>
                    <p class="text-primary text-h3-hero">
                        Développeur web freelance Laravel à Arras
                    </p>
                    <h1 id="hero-title" class="text-primary text-h1-hero">
                        Création de site internet à Arras : des sites modernes qui transforment vos visiteurs en clients
                    </h1>
                    <p class="text-primary md:text-h2-hero">
                        J'accompagne artisans, PME, indépendants et associations d'Arras, du Pas-de-Calais et de toute la
                        France :
                        sites vitrines, landing pages et refontes rapides, clairs et pensés pour convertir.
                    </p>
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
                        <img src="{{ asset('logos/logo_hero.svg') }}"
                            alt="Logo Northframe, développeur web freelance à Arras" width="200" height="200"
                            class="relative z-10 w-full">

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
    <section id="services" aria-labelledby="services-title" class="p-[10px] scroll-mt-20">
        <h2 id="services-title" class="text-h2 text-primary text-center">
            Mes services de création de site web à Arras
        </h2>
        {{-- PRESTATIONS PRINCIPALES --}}
        <section class="w-full pt-3">
            <div class="flex flex-wrap justify-center gap-[10px]">

                {{-- LANDING PAGE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        5 à 7 jours
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/rocket.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <div class="text-card-title text-primary text-center">
                            Création de landing page
                        </div>

                        <p class="text-label text-secondary text-center">
                            Une page unique, claire et percutante pour présenter votre offre, générer des demandes de devis
                            et convertir vos visiteurs en clients.
                        </p>
                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Design orienté conversion (appels à l'action, preuves, formulaire)</li>
                            <li>Structure optimisée pour vendre</li>
                            <li>Développement Laravel rapide et léger</li>
                            <li>Responsive mobile, tablette et desktop</li>
                            <li>Mise en ligne incluse</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                800 €
                            </p>

                            <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">
                                <a href="{{ route('contact', ['projet' => 'landing']) }}"
                                    aria-label="Choisir l'offre création de landing page à 800 €"
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
                </div>

                {{-- SITE VITRINE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        10 à 15 jours
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/globe.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <h3 class="text-card-title text-primary text-center">Création de site vitrine professionnel</h3>
                        <p class="text-label text-secondary text-center">
                            Donnez une image crédible et moderne à votre activité avec un site vitrine rapide, clair et
                            référencé, pensé pour transformer vos visiteurs en clients.
                        </p>
                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Design sur mesure</li>
                            <li>Site responsive (mobile, tablette, desktop)</li>
                            <li>Développement optimisé pour la vitesse de chargement</li>
                            <li>SEO de base : balises, structure, performances</li>
                            <li>Mise en ligne incluse</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                1 500 €
                            </p>

                            <div class="flex gap-[10px] px-[10px] py-[10px]">
                                <a href="{{ route('contact', ['projet' => 'vitrine']) }}"
                                    aria-label="Choisir l'offre création de site vitrine professionnel à 1500 €"
                                    class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button cursor-pointer rounded-[10px] gap-[10px] px-[12px] h-[48px] transition-all duration-200">
                                    Choisir cette offre
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- REFONTE DE SITE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        10 à 20 jours
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/refresh-ccw.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <div class="text-card-title text-primary text-center">
                            Refonte de site web
                        </div>

                        <p class="text-label text-secondary text-center">
                            Modernisation de votre site existant : design, expérience utilisateur et performances améliorés,
                            tout en préservant votre référencement grâce aux redirections 301.
                        </p>

                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Audit de l'existant</li>
                            <li>Refonte graphique</li>
                            <li>Reprise des contenus</li>
                            <li>SEO et redirections selon les besoins</li>
                            <li>Mise en ligne incluse</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                Sur devis
                            </p>

                            <div class="flex gap-[10px] px-[10px] py-[10px]">
                                <a href="{{ route('contact', ['projet' => 'refonte']) }}"
                                    aria-label="Choisir l'offre refonte de site web sur devis"
                                    class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button cursor-pointer rounded-[10px] gap-[10px] px-[12px] h-[48px] transition-all duration-200">
                                    Choisir cette offre
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        {{-- SÉPARATION ENTRE LES DEUX GROUPES --}}
        <section class="w-full mt-16 pt-8 border-t border-primary/10">

            <div class="text-center mb-8">
                <h3 class="text-card-title text-primary">
                    Services complémentaires
                </h3>

                <p class="text-label text-secondary mt-2">
                    Des solutions pour accompagner vos projets et maintenir vos sites web.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-[10px]">

                {{-- FREELANCE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        Selon planning
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/users-round.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <h3 class="text-card-title text-primary text-center">Développeur Laravel / PHP freelance</h3>
                        <p class="text-label text-secondary text-center">
                            Besoin d'un développeur Laravel pour renforcer votre équipe sur une mission ponctuelle ou de
                            plusieurs semaines ? J'interviens en remote ou sur site autour d'Arras (rayon de 50 km) pour
                            accélérer vos développements et fiabiliser vos livraisons.
                        </p>

                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Développement Laravel & PHP</li>
                            <li>JavaScript et interfaces modernes</li>
                            <li>Intégration responsive Tailwind CSS</li>
                            <li>Développement de fonctionnalités</li>
                            <li>Maintenance et corrections techniques</li>
                            <li>Collaboration avec vos équipes existantes</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                À partir de 200 €/jour à distance </br> ou </br> ou sur site (Arras, 50 km) : sur devis
                            </p>


                            <div class="flex gap-[10px] px-[10px] py-[10px]">
                                <a href="{{ route('contact', ['projet' => 'freelance']) }}"
                                    class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button cursor-pointer rounded-[10px] gap-[10px] px-[12px] h-[48px] transition-all duration-200">
                                    Me contacter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MAINTENANCE MENSUELLE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        Suivi régulier
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/cog.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <div class="text-card-title text-primary text-center">
                            Maintenance de site web mensuelle
                        </div>

                        <p class="text-label text-secondary text-center">
                            Assurez la stabilité et la sécurité de votre site avec un suivi régulier, des mises à jour
                            techniques et des corrections en cas de besoin.
                        </p>

                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Mises à jour régulières du site</li>
                            <li>Corrections techniques</li>
                            <li>Sécurité et surveillance</li>
                            <li>Support en cas de problème</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                29 €/mois
                            </p>

                            <div class="h-[68px] flex items-center justify-center">
                                <span class="text-label text-secondary">
                                    Option recommandée
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MAINTENANCE PONCTUELLE --}}
                <div
                    class="relative w-full max-w-sm rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px] border border-primary/5 flex flex-col">

                    <div
                        class="absolute top-4 -right-4 z-20 bg-brand/70 backdrop-blur-sm text-primary text-small px-5 py-2 rounded-full shadow-lg whitespace-nowrap">
                        Sans abonnement
                    </div>

                    <img class="mx-auto w-[28px] h-[28px]" src="{{ asset('icon/wrench.svg') }}" alt=""
                        aria-hidden="true">

                    <div class="px-6 py-4 flex flex-col flex-1 gap-[10px]">
                        <div class="text-card-title text-primary text-center">
                            Maintenance de site web ponctuelle
                        </div>

                        <p class="text-label text-secondary text-center">
                            Besoin d'une modification ou d'une correction sur votre site ? Je peux intervenir
                            ponctuellement,
                            sans engagement ni abonnement mensuel.
                        </p>

                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Modification de texte ou d'image</li>
                            <li>Correction d'un bug simple</li>
                            <li>Petite modification de mise en page</li>
                            <li>Intervention jusqu'à 1 heure</li>
                            <li>Devis pour les demandes plus importantes</li>
                        </ul>

                        <div class="mt-auto">
                            <p class="text-card-price text-primary text-center">
                                100 € / intervention
                            </p>

                            <p class="text-label text-secondary text-center mt-2">
                                Intervention simple, jusqu'à 1 heure de travail.
                            </p>

                            <div class="flex gap-[10px] px-[10px] py-[10px]">
                                <a href="{{ route('contact', ['projet' => 'maintenance_ponctuelle']) }}"
                                    class="flex items-center justify-center w-fit mx-auto bg-brand hover:bg-hover text-primary text-button cursor-pointer rounded-[10px] gap-[10px] px-[12px] h-[48px] transition-all duration-200">
                                    Demander une intervention
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </section>

    <!--Portfolio Section -->
    <section id="portfolio" aria-labelledby="portfolio-title" class="p-[10px] scroll-mt-20">
        <h2 id="portfolio-title" class="text-h2 text-primary text-center">
            Mes réalisations : sites vitrines et landing pages
        </h2>
        <p class="text-h3 text-secondary text-center">
            Des projets web conçus avec Laravel et Tailwind CSS pour allier performance, clarté et expérience utilisateur.
        </p>
        <div class="flex flex-wrap justify-center gap-[10px] pt-3">
            @foreach ($projects as $project)
                <x-card-portfolio :project="$project" />
            @endforeach
        </div>
    </section>
    <!--Process Section -->
    <section id="process" aria-labelledby="process-title" class="scroll-mt-[90px] pb-[120px]">
        <h2 id="process-title" class="text-h2 text-primary text-center">
            Ma méthode pour créer votre site web
        </h2>
        <p class="text-h3 text-secondary text-center">
            De la première discussion à la mise en ligne, un processus clair en 4 étapes, à distance ou en rendez-vous près
            d'Arras.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-2 gap-[10px] justify-center mx-auto w-fit pt-3">
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small" aria-hidden="true">[01]</p>
                    <h3 class="text-card-title text-primary ">Analyse du besoin</h3>
                </div>
                <p class="text-button text-muted">
                    Nous échangeons sur votre projet afin de comprendre vos besoins, vos objectifs et les
                    fonctionnalités attendues.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/message-circle.svg') }}" alt=""
                    aria-hidden="true">

            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small" aria-hidden="true">[02]</p>
                    <h3 class="text-card-title text-primary ">Conception</h3>
                </div>
                <p class="text-button text-muted">
                    Je crée la structure et le design de votre site en mettant l’accent sur l’expérience utilisateur et la
                    clarté.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/panels-top-left.svg') }}" alt=""
                    aria-hidden="true">
            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small" aria-hidden="true">[03]</p>
                    <h3 class="text-card-title text-primary ">Développement</h3>
                </div>
                <p class="text-button text-muted">
                    Intégration et développement du site avec des technologies modernes, rapides et adaptées à votre projet.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/square-code.svg') }}" alt=""
                    aria-hidden="true">
            </div>
            <div
                class="w-[240px] h-[240px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-brand/70 text-small" aria-hidden="true">[04]</p>
                    <h3 class="text-card-title text-primary ">Mise en ligne</h3>
                </div>
                <p class="text-button text-muted">
                    Mise en ligne du site et vérifications finales pour garantir un fonctionnement optimal.
                </p>
                <div class="flex-1"></div>
                <img class="w-[24px] h-[24px] self-start" src="{{ asset('icon/circle-check.svg') }}" alt=""
                    aria-hidden="true">
            </div>

        </div>
    </section>

    <!--FAQ Section-->
    <section id="questions-frequentes" aria-labelledby="faq-title" class="p-[10px] scroll-mt-20">
        <h2 id="faq-title" class="text-h2 text-primary text-center">
            Questions fréquentes sur la création de site internet
        </h2>

        <p class="text-h3 text-secondary text-center">
            Vous avez une question sur la création de votre site internet ou le déroulement d'un projet ?
            Retrouvez ici les réponses aux questions les plus fréquentes.
        </p>

        <div id="accordion-card" data-accordion="collapse" class="max-w-4xl mx-auto px-[10px] py-[10px]">

            <!-- 1 -->
            <h3 id="accordion-card-heading-1">
                <button type="button" id="faq-btn-1"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-1" aria-expanded="false"
                    aria-controls="accordion-card-body-1">

                    <span class="text-label text-primary">
                        Combien de temps faut-il pour créer un site internet ou une landing page ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-1" role="region" aria-labelledby="faq-btn-1"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg"
                aria-labelledby="accordion-card-heading-1">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Une landing page est généralement livrée sous <strong>5 à 7 jours ouvrés</strong>.
                        Un site vitrine nécessite en moyenne <strong>10 à 15 jours ouvrés</strong> selon les fonctionnalités
                        et les contenus à intégrer.
                    </p>
                </div>
            </div>

            <!-- 2 -->
            <h2 id="accordion-card-heading-2" class="mt-4">
                <button type="button" id="faq-btn-2"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-2" aria-expanded="false"
                    aria-controls="accordion-card-body-2">

                    <span class="text-label text-primary">
                        Mon site sera-t-il compatible mobile (responsive) ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-2" role="region" aria-labelledby="faq-btn-2"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Tous mes sites sont développés en responsive et testés sur ordinateur, tablette et smartphone,
                        ce qui compte aussi pour votre référencement sur Google.
                    </p>
                </div>
            </div>

            <!-- 3 -->
            <h2 id="accordion-card-heading-3" class="mt-4">
                <button type="button" id="faq-btn-3"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-3" aria-expanded="false"
                    aria-controls="accordion-card-body-3">

                    <span class="text-label text-primary">
                        Puis-je demander des modifications pendant le développement ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-3" role="region" aria-labelledby="faq-btn-3"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Des ajustements sont prévus durant le développement afin que le résultat corresponde à vos
                        attentes avant la mise en ligne.
                    </p>
                </div>
            </div>

            <!-- 4 -->
            <h2 id="accordion-card-heading-4" class="mt-4">
                <button type="button" id="faq-btn-4"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-4" aria-expanded="false"
                    aria-controls="accordion-card-body-4">

                    <span class="text-label text-primary">
                        L’hébergement et le nom de domaine sont-ils inclus dans le prix ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-4" role="region" aria-labelledby="faq-btn-4"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Non, mais je peux vous accompagner dans le choix d'un hébergement fiable et d'un nom de domaine
                        adapté à votre activité.
                    </p>
                </div>
            </div>

            <!-- 5 -->
            <h2 id="accordion-card-heading-5" class="mt-4">
                <button type="button" id="faq-btn-5"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-5" aria-expanded="false"
                    aria-controls="accordion-card-body-5">

                    <span class="text-label text-primary">
                        Comment se déroule la création de mon site web ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-5" role="region" aria-labelledby="faq-btn-5"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Après un premier échange, nous définissons ensemble vos besoins. Je réalise ensuite le
                        développement, vous présente une version de validation puis procède à la mise en ligne une fois le
                        projet validé.
                    </p>
                </div>
            </div>

            <!-- 6 -->
            <h2 id="accordion-card-heading-6" class="mt-4">
                <button type="button" id="faq-btn-6"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-6" aria-expanded="false"
                    aria-controls="accordion-card-body-6">

                    <span class="text-label text-primary">
                        Proposez-vous une maintenance de site web après la mise en ligne ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-6" role="region" aria-labelledby="faq-btn-6"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Ma maintenance mensuelle à 29 €/mois comprend les mises à jour, la sécurité, les corrections
                        techniques et le suivi du bon fonctionnement. Je propose aussi des interventions ponctuelles à 100 €
                        sans abonnement.
                    </p>
                </div>
            </div>

            <!-- 7 -->
            <h2 id="accordion-card-heading-7" class="mt-4">
                <button type="button" id="faq-btn-7"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-7" aria-expanded="false"
                    aria-controls="accordion-card-body-7">

                    <span class="text-label text-primary">
                        Travaillez-vous uniquement avec des entreprises d’Arras ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-7" role="region" aria-labelledby="faq-btn-7"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Non. Basé à Arras, je me déplace dans un rayon de 50 km (Arras, Lens, Douai, Béthune, Cambrai…) et
                        je travaille en full remote avec des clients partout en France. Visio, téléphone ou rendez-vous sur
                        place selon vos besoins.
                    </p>
                </div>
            </div>

            <!-- 8 -->
            <h2 id="accordion-card-heading-8" class="mt-4">
                <button type="button" id="faq-btn-8"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-8" aria-expanded="false"
                    aria-controls="accordion-card-body-8">

                    <span class="text-label text-primary">
                        Quel est le prix d’un site vitrine ou d’une landing page ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h2>

            <div id="accordion-card-body-8" role="region" aria-labelledby="faq-btn-8"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Une landing page démarre à 800 € et un site vitrine professionnel à 1 500 €. Une refonte de site est
                        établie sur devis, après un audit de l’existant. Mise en ligne incluse dans chaque offre.
                    </p>
                </div>
            </div>
        </div>

    </section>
    <!--CTA Final Section-->
    <section id="ctaFinal" aria-labelledby="cta-title" class="p-[10px] scroll-mt-20">
        <h2 id="cta-title" class="text-h2 text-primary text-center">
            Un projet de site web à Arras ou ailleurs ?
        </h2>
        <p class="text-h3 text-secondary text-center">
            Répondez à quelques questions et je vous recontacte rapidement pour discuter de votre projet et vous proposer un
            devis gratuit.
        </p>
        <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">

            <a href="{{ route('contact') }}"
                class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                Démarrer un projet
            </a>



        </div>
    </section>
@endsection
