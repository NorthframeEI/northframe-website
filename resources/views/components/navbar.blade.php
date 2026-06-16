<nav class="sticky z-50 top-0 w-full h-[56px] md:h-[72px]" id="navbar">

    <div class="flex items-center justify-between w-full px-4">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="relative flex items-center group">
            <img src="{{ asset('logos/logo_navbar.svg') }}"
                class="h-[36px] md:h-[68px] transition-opacity duration-1000 group-hover:opacity-0" alt="Northframe Logo">

            <img src="{{ asset('logos/logo_navbar_hover.svg') }}"
                class="absolute h-[36px] md:h-[68px] opacity-0 transition-opacity duration-1000 group-hover:opacity-100"
                alt="Northframe Logo">
        </a>

        <!-- MENU (desktop only inline) -->
        <div class="hidden md:flex items-center space-x-8 relative">

            <span id="nav-pill"></span>
            <a href="{{ route('home') }}#services" class="nav-item">Services</a>
            <a href="{{ route('home') }}#portfolio" class="nav-item">Portfolio</a>
            <a href="{{ route('home') }}#process" class="nav-item">Process</a>
            <a href="{{ route('home') }}#ctaFinal" class="nav-item">Contact</a>
            <a href="{{ route('template') }}" class="nav-item">Templates</a>
        </div>

        <!-- CTA + BURGER -->
        <div class="flex items-center space-x-3 p-2 md:p-0">

            <!-- CTA desktop -->
            <a href="{{ route('contact') }}"
                class="hidden md:block text-brand outline-solid rounded-[10px] outline-brand text-label px-3 py-2 h-[38px] cursor-pointer hover:text-hover hover:outline-hover">
                Démarrer un projet
            </a>

            <!-- BURGER mobile -->
            <button id="burger" class="md:hidden p-2 text-secondary outline-solid rounded-[10px]">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </button>

        </div>

    </div>

    <!-- MENU MOBILE -->
    <div id="menu"
        class="opacity-0 pointer-events-none translate-y-2 transition-all duration-300 md:hidden w-full px-4 pt-4 bg-surface">

        <div class="flex flex-col space-y-4 pb-3">

            <a href="{{ route('home') }}#services" class="text-primary">Services</a>
            <a href="{{ route('home') }}#portfolio" class="text-primary">Portfolio</a>
            <a href="{{ route('home') }}#process" class="text-primary">Process</a>
            <a href="{{ route('home') }}#ctaFinal" class="text-primary">Contact</a>
            <a href="{{ route('template') }}" class="nav-item">Templates</a>

            <a href="{{ route('contact') }}"
                class="self-center text-brand outline-solid rounded-[10px] outline-brand text-sm px-3 py-2 h-[38px] mt-4">
                Démarrer un projet
            </a>

        </div>

    </div>

</nav>
