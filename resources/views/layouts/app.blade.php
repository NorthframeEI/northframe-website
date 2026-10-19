<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $pageTitle = View::yieldContent('title', 'Northframe - Création de sites web et landing pages');

        $metaDescription = View::yieldContent(
            'meta_description',
            'Northframe conçoit des sites vitrines et landing pages modernes, performants et pensés pour convertir.',
        );

        $canonical = View::yieldContent('canonical', url()->current());

        $ogTitle = View::yieldContent('og_title', $pageTitle);

        $ogDescription = View::yieldContent('og_description', $metaDescription);

        $ogImage = View::yieldContent('og_image', asset('images/og-default.png'));

        $robots = View::yieldContent('robots', 'index, follow');
        $siteUrl = config('app.url');
    @endphp

    {{-- SEO --}}
    <title>{{ $pageTitle }}</title>

    <meta name="description" content="{{ $metaDescription }}">
    @stack('head')
    <meta name="robots" content="{{ $robots }}">

    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Northframe">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <meta name="theme-color" content="#0B1220">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sora:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- CSS / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Schema.org --}}
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Person',
                    '@id' => $siteUrl . '/#person',
                    'name' => 'Antoine Padé',
                    'url' => $siteUrl,
                    'jobTitle' => 'Développeur web freelance Laravel / PHP',
                    'worksFor' => ['@id' => $siteUrl . '/#business'],
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Arras',
                        'addressRegion' => 'Hauts-de-France',
                        'addressCountry' => 'FR',
                    ],
                    'knowsAbout' => ['Laravel', 'PHP', 'Tailwind CSS', 'SEO', 'Création de site web'],
                    'sameAs' => [
                        'https://www.linkedin.com/in/antoine-pad%C3%A9-565540174/',
                        'https://github.com/apade17',
                    ],
                ],
                [
                    '@type' => 'ProfessionalService',
                    '@id' => $siteUrl . '/#business',
                    'name' => 'Northframe',
                    'url' => $siteUrl,
                    'logo' => asset('logos/logo_hero.svg'),
                    'image' => $ogImage,
                    'description' =>
                        'Développeur web freelance à Arras : création de sites vitrines, landing pages, refonte de site, développement Laravel sur mesure et maintenance.',
                    'founder' => ['@id' => $siteUrl . '/#person'],
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Arras',
                        'addressRegion' => 'Hauts-de-France',
                        'addressCountry' => 'FR',
                    ],
                    'areaServed' => [
                        ['@type' => 'City', 'name' => 'Arras'],
                        ['@type' => 'AdministrativeArea', 'name' => 'Pas-de-Calais'],
                        ['@type' => 'Country', 'name' => 'France'],
                    ],
                    'serviceType' => [
                        'Création de site vitrine',
                        'Création de landing page',
                        'Refonte de site web',
                        'Développement Laravel',
                        'Maintenance de site web',
                    ],
                    'availableLanguage' => 'fr',
                    'telephone' => '+33612535093',
                    'email' => 'contact@northframe.fr',
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

</head>

<body class="min-h-screen flex flex-col bg-northframe">
    <a href="#contenu"
        class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:px-4 focus:py-3 focus:rounded-[10px] focus:bg-brand focus:text-primary">
        Aller au contenu principal
    </a>
    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- CONTENU PAGE --}}
    <main id="contenu" tabindex="-1" class="flex-1 focus:outline-none">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

</body>

</html>
