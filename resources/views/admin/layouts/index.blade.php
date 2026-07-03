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
