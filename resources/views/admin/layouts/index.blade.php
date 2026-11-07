<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {{-- Fonts --}}
    <link rel="preload" href="{{ asset('fonts/sora-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/admin/admin-app.js'])
</head>

<body class="min-h-screen flex bg-northframe">

    {{-- NAVBAR --}}
    @include('admin.components.aside')

    {{-- CONTENU PAGE --}}
    <main class="flex-1 ml-16">
        @yield('admin.content')
    </main>


</body>

</html>
