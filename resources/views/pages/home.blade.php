@extends('layouts.app')

@section('title', 'Création de site internet à Arras | Northframe')
@section('meta_description',
    "Création de sites vitrines et landing pages à Arras. Développeur web freelance,
    j'accompagne les professionnels du Pas-de-Calais et partout en France dans leurs projets web.")

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
                        Création de sites internet à Arras et partout en France
                    </h1>
                    <p class="text-primary md:text-h2-hero">
                        J’accompagne les artisans, indépendants, TPE et associations dans la création de sites vitrines et
                        de landing pages modernes, rapides et optimisés pour le référencement naturel. Basé à Arras,
                        j’interviens dans le Pas-de-Calais et à distance partout en France.

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
        <div class="w-full pt-3">
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
                        <h3 class="text-card-title text-primary text-center">
                            Landing page
                        </h3>

                        <p class="text-label text-secondary text-center">
                            Une page web conçue pour présenter une offre, un service ou un produit et inciter vos visiteurs
                            à passer à l’action. Idéale pour développer votre visibilité et générer des demandes de contact.
                        </p>
                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Design orienté conversion (appels à l'action, preuves, formulaire)</li>
                            <li>Structure pensée pour inciter à l'action</li>
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
                        <h3 class="text-card-title text-primary text-center">Site vitrine</h3>
                        <p class="text-label text-secondary text-center">
                            Un site internet professionnel pour présenter votre activité, vos services et votre
                            savoir-faire. Une présence en ligne claire et moderne pour rassurer vos visiteurs et faciliter
                            la prise de contact.
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
                        <h3 class="text-card-title text-primary text-center">
                            Refonte de site web
                        </h3>

                        <p class="text-label text-secondary text-center">
                            Votre site ne correspond plus à votre activité ou mérite une nouvelle présentation ? Je
                            retravaille son design, sa structure et ses performances pour lui donner une image plus actuelle
                            et améliorer l'expérience de vos visiteurs.
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
        </div>


        {{-- SÉPARATION ENTRE LES DEUX GROUPES --}}
        <div class="w-full mt-16 pt-8 border-t border-primary/10">

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
                        <h4 class="text-card-title text-primary text-center">Développement Laravel / PHP</h4>
                        <p class="text-label text-secondary text-center">
                            Besoin d'une fonctionnalité spécifique, d'un outil métier ou d'un développement sur mesure ? Je
                            vous accompagne dans la réalisation de vos projets web en PHP et Laravel, à distance ou
                            directement sur site.
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
                            <div class="text-center mb-4">
                                <p class="text-card-price text-primary font-semibold">
                                    300 € / jour
                                </p>
                                <p class="text-sm text-secondary mt-1">
                                    Tarif journalier à distance
                                </p>
                                <p class="text-sm text-secondary mt-3">
                                    Intervention sur site possible sur devis,
                                    dans un rayon de 50 km autour d'Arras.
                                </p>
                            </div>

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
                        <h4 class="text-card-title text-primary text-center">
                            Maintenance mensuelle
                        </h4>

                        <p class="text-label text-secondary text-center">
                            Gardez votre site internet fonctionnel et à jour grâce à un suivi régulier. La maintenance
                            permet de surveiller son bon fonctionnement et de limiter les problèmes techniques.
                        </p>

                        <ul class="list-disc pl-5 text-h3-footer text-secondary">
                            <li>Vérification régulière du bon fonctionnement du site</li>
                            <li>Mises à jour techniques et de sécurité</li>
                            <li>Sauvegardes régulières du site</li>
                            <li>Assistance en cas de problème technique</li>
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
                        <h4 class="text-card-title text-primary text-center">
                            Intervention ponctuelle
                        </h4>

                        <p class="text-label text-secondary text-center">
                            Un problème technique, une modification ou une correction à effectuer sur votre site ? Je peux
                            intervenir ponctuellement pour vous aider à retrouver un site fonctionnel et adapté à vos
                            besoins.
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
        </div>

    </section>

    <!--Portfolio Section -->
    <section id="portfolio" aria-labelledby="portfolio-title" class="p-[10px] scroll-mt-20">
        <h2 id="portfolio-title" class="text-h2 text-primary text-center">
            Mes réalisations : sites vitrines et landing pages
        </h2>
        <p class="text-h3 text-secondary text-center">
            Découvrez quelques-uns de mes projets de création de sites internet
            et de développement web. Chaque réalisation est pensée pour répondre
            aux besoins spécifiques du client, avec une attention particulière
            portée au design, aux performances et à l'expérience utilisateur.
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
                class="w-[260px] h-[260px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-[#60A5FA] text-small" aria-hidden="true">[01]</p>
                    <h3 class="text-card-title text-primary ">Analyse du besoin</h3>
                </div>
                <p class="text-button text-muted">
                    Nous échangeons sur votre activité, vos besoins et vos objectifs afin de définir ensemble les
                    fonctionnalités et les contenus adaptés à votre projet.
                </p>
                <img class="w-[24px] h-[24px] self-start shrink-0 mt-3" src="{{ asset('icon/message-circle.svg') }}"
                    alt="" aria-hidden="true">

            </div>
            <div
                class="w-[260px] h-[260px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-[#60A5FA] text-small" aria-hidden="true">[02]</p>
                    <h3 class="text-card-title text-primary ">Conception</h3>
                </div>
                <p class="text-button text-muted">
                    Je prépare la structure et le design de votre site en accord avec votre identité, avec une attention
                    particulière portée à la navigation et à l'expérience utilisateur.
                </p>
                <img class="w-[24px] h-[24px] self-start shrink-0 mt-3" src="{{ asset('icon/panels-top-left.svg') }}"
                    alt="" aria-hidden="true">
            </div>
            <div
                class="w-[260px] h-[260px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-[#60A5FA] text-small" aria-hidden="true">[03]</p>
                    <h3 class="text-card-title text-primary ">Développement</h3>
                </div>
                <p class="text-button text-muted">
                    Je donne vie à votre projet en développant un site responsive, performant et optimisé pour le
                    référencement naturel, avec des technologies adaptées à vos besoins.
                </p>
                <img class="w-[24px] h-[24px] self-start shrink-0 mt-3" src="{{ asset('icon/square-code.svg') }}"
                    alt="" aria-hidden="true">
            </div>
            <div
                class="w-[260px] h-[260px] rounded-[12px] bg-surface shadow-lg p-[12px] border border-primary/5 flex flex-col justify-between">

                <div class="flex flex-col gap-[10px]">
                    <p class="text-[#60A5FA] text-small" aria-hidden="true">[04]</p>
                    <h3 class="text-card-title text-primary ">Mise en ligne</h3>
                </div>
                <p class="text-button text-muted">
                    Après les dernières vérifications, votre site est mis en ligne. Vous disposez d'un site fonctionnel,
                    prêt à accueillir vos visiteurs.
                </p>
                <img class="w-[24px] h-[24px] self-start shrink-0 mt-3" src="{{ asset('icon/circle-check.svg') }}"
                    alt="" aria-hidden="true">
            </div>

        </div>
    </section>

    <!--FAQ Section-->
    <section id="questions-frequentes" aria-labelledby="faq-title" class="p-[10px] scroll-mt-20">
        <h2 id="faq-title" class="text-h2 text-primary text-center">
            Questions fréquentes sur la création de site internet
        </h2>

        <p class="text-h3 text-secondary text-center">
            Vous souhaitez créer un site internet ou améliorer votre présence en ligne ?
            Retrouvez les réponses aux questions les plus fréquentes avant de vous lancer.
        </p>

        <div id="accordion-card" data-accordion="collapse" class="max-w-4xl mx-auto px-[10px] py-[10px]">

            <!-- 1 -->
            <h3 id="accordion-card-heading-1">
                <button type="button" id="faq-btn-1"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-1" aria-expanded="false"
                    aria-controls="accordion-card-body-1">

                    <span class="text-label text-primary">
                        Combien de temps faut-il pour créer un site internet ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-1" role="region" aria-labelledby="faq-btn-1"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Une landing page nécessite généralement 5 à 7 jours ouvrés.
                        Pour un site vitrine, comptez en moyenne 10 à 15 jours ouvrés.
                        Ces délais peuvent varier selon les fonctionnalités et les contenus du projet.
                    </p>
                </div>
            </div>

            <!-- 2 -->
            <h3 id="accordion-card-heading-2" class="mt-4">
                <button type="button" id="faq-btn-2"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-2" aria-expanded="false"
                    aria-controls="accordion-card-body-2">

                    <span class="text-label text-primary">
                        Mon site internet sera-t-il adapté aux mobiles et tablettes ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-2" role="region" aria-labelledby="faq-btn-2"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Tous les sites que je réalise sont conçus en responsive design.
                        Ils s'adaptent aux ordinateurs, tablettes et smartphones pour offrir
                        une navigation confortable sur tous les écrans.
                    </p>
                </div>
            </div>

            <!-- 3 -->
            <h3 id="accordion-card-heading-3" class="mt-4">
                <button type="button" id="faq-btn-3"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-3" aria-expanded="false"
                    aria-controls="accordion-card-body-3">

                    <span class="text-label text-primary">
                        Puis-je demander des modifications pendant la création de mon site ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-3" role="region" aria-labelledby="faq-btn-3"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Nous échangeons régulièrement pendant le développement afin de
                        vérifier que le site correspond à vos attentes. Des ajustements peuvent
                        être effectués avant la validation finale et la mise en ligne.
                    </p>
                </div>
            </div>

            <!-- 4 -->
            <h3 id="accordion-card-heading-4" class="mt-4">
                <button type="button" id="faq-btn-4"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-4" aria-expanded="false"
                    aria-controls="accordion-card-body-4">

                    <span class="text-label text-primary">
                        L'hébergement et le nom de domaine sont-ils compris dans le prix ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-4" role="region" aria-labelledby="faq-btn-4"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        L'hébergement et le nom de domaine ne sont pas inclus dans mes tarifs.
                        Je peux toutefois vous accompagner dans le choix d'un hébergement fiable
                        et d'un nom de domaine adapté à votre activité.
                    </p>
                </div>
            </div>

            <!-- 5 -->
            <h3 id="accordion-card-heading-5" class="mt-4">
                <button type="button" id="faq-btn-5"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-5" aria-expanded="false"
                    aria-controls="accordion-card-body-5">

                    <span class="text-label text-primary">
                        Comment se déroule la création de mon site internet ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-5" role="region" aria-labelledby="faq-btn-5"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Chaque projet commence par un échange pour comprendre vos besoins et vos objectifs.
                        Je passe ensuite à la conception, au développement et aux vérifications.
                        Une fois le site validé, je procède à sa mise en ligne.
                    </p>
                </div>
            </div>

            <!-- 6 -->
            <h3 id="accordion-card-heading-6" class="mt-4">
                <button type="button" id="faq-btn-6"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-6" aria-expanded="false"
                    aria-controls="accordion-card-body-6">

                    <span class="text-label text-primary">
                        Proposez-vous la maintenance d'un site internet après sa mise en ligne ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-6" role="region" aria-labelledby="faq-btn-6"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Oui. Je propose une maintenance mensuelle à 29 €/mois comprenant
                        la vérification du bon fonctionnement du site, les mises à jour
                        techniques et de sécurité, ainsi que les sauvegardes régulières.
                        Une assistance est également prévue en cas de problème technique.
                        Des interventions ponctuelles sont possibles au tarif de 100 €,
                        sans abonnement.
                    </p>
                </div>
            </div>

            <!-- 7 -->
            <h3 id="accordion-card-heading-7" class="mt-4">
                <button type="button" id="faq-btn-7"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-7" aria-expanded="false"
                    aria-controls="accordion-card-body-7">

                    <span class="text-label text-primary">
                        Dans quelles villes intervenez-vous pour la création de sites internet ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-7" role="region" aria-labelledby="faq-btn-7"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Basé à Arras, j'interviens dans un rayon de 50 km, notamment à Lens,
                        Douai, Béthune et Cambrai. Je travaille également à distance avec
                        des professionnels partout en France, grâce aux échanges par téléphone
                        et en visioconférence.
                    </p>
                </div>
            </div>

            <!-- 8 -->
            <h3 id="accordion-card-heading-8" class="mt-4">
                <button type="button" id="faq-btn-8"
                    class="flex items-center justify-between w-full p-5 rounded-[12px] bg-surface shadow-lg border border-primary/5 hover:border-hover transition-all duration-200 text-left"
                    data-accordion-target="#accordion-card-body-8" aria-expanded="false"
                    aria-controls="accordion-card-body-8">

                    <span class="text-label text-primary">
                        Quel est le prix d'une landing page ou d'un site vitrine ?
                    </span>

                    <svg data-accordion-icon aria-hidden="true" class="w-5 h-5 shrink-0 transition-transform text-primary"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m5 9 7 7 7-7" />
                    </svg>
                </button>
            </h3>

            <div id="accordion-card-body-8" role="region" aria-labelledby="faq-btn-8"
                class="hidden rounded-b-[12px] border border-t-0 border-primary/5 shadow-lg">
                <div class="p-5">
                    <p class="text-label text-secondary">
                        Une landing page est proposée au tarif fixe de 800 € et un site vitrine
                        au tarif fixe de 1 500 €. Pour une refonte de site internet, le tarif
                        est établi sur devis en fonction de vos besoins et de l'existant.
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
            Vous avez un projet de création de site vitrine, de landing page ou de refonte ?
            Parlons-en ! Décrivez-moi votre besoin et recevez un devis gratuit et adapté à votre projet.
        </p>

        <div class="flex gap-[10px] px-[10px] py-[10px] justify-center">
            <a href="{{ route('contact') }}"
                class="bg-brand hover:bg-hover text-primary text-button rounded-[10px] flex items-center justify-center px-[12px] h-[48px] transition-all duration-200 whitespace-nowrap">
                Démarrer un projet
            </a>
        </div>
    </section>
@endsection
