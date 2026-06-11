<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Sora:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-northframe">
    <!-- GRID DEBUG (toggle facilement) 
    <div class="pointer-events-none fixed inset-0 z-50 opacity-30">
        <div class="mx-auto h-full max-w-7xl">
            <div class="grid grid-cols-12 gap-6 h-full">
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
                <div class="col-span-1 border-l border-white"></div>
            </div>
        </div>
    </div>-->
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
