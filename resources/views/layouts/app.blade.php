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
    <meta name="robots" content="{{ $robots }}">

    <link rel="canonical" href="{{ $canonical }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sora:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- CSS / JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Schema.org --}}
    {{-- Schema.org --}}
    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'Antoine Padé',
    'url' => $siteUrl,
    'jobTitle' => 'Développeur web freelance',
    'worksFor' => [
        '@type' => 'Organization',
        'name' => 'Northframe',
    ],
    'sameAs' => [
        'https://www.linkedin.com/in/antoine-pad%C3%A9-565540174/',
        'https://github.com/apade17',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

    <script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ProfessionalService',
    'name' => 'Northframe',
    'url' => $siteUrl,
    'description' => 'Création de sites vitrines, landing pages et développement web sur mesure.',
    'areaServed' => 'France',
    'founder' => [
        '@type' => 'Person',
        'name' => 'Antoine Padé',
    ],
    'serviceType' => [
        'Site vitrine',
        'Landing page',
        'Développement web',
        'Maintenance web',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

</head>

<body class="min-h-screen flex flex-col bg-northframe">

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- CONTENU PAGE --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('components.footer')

</body>

</html>
