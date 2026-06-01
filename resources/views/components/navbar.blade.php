<nav class="fixed top-0 w-full h-[56px] md:h-[72px]">

    <div class="flex items-center justify-between w-full px-4">

        <!-- LOGO -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/logo_navbar.svg') }}" class="h-[36px] md:h-[68px]" alt="Northframe Logo">
        </a>

        <!-- MENU (desktop only inline) -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="#" class="text-primary text-select">Services</a>
            <a href="#" class="text-primary">Portfolio</a>
            <a href="#" class="text-primary">Process</a>
            <a href="#" class="text-primary">Contact</a>
        </div>

        <!-- CTA + BURGER -->
        <div class="flex items-center space-x-3 p-2 md:p-0">

            <!-- CTA desktop -->
            <a href="#" class="hidden md:block text-brand outline-solid rounded-[10px] outline-brand text-label px-3 py-2 h-[38px] cursor-pointer hover:text-hover hover:outline-hover">
                Démarrer un projet
            </a>

            <!-- BURGER mobile -->
            <button id="burger" class="md:hidden p-2 text-secondary outline-solid rounded-[10px]">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2"
                        d="M5 7h14M5 12h14M5 17h14" />
                </svg>
            </button>

        </div>

    </div>

    <!-- MENU MOBILE -->
    <div id="menu" class="opacity-0 pointer-events-none translate-y-2 transition-all duration-300 md:hidden w-full px-4 pt-4">

        <div class="flex flex-col space-y-4">

            <a href="#" class="text-primary">Services</a>
            <a href="#" class="text-primary">Portfolio</a>
            <a href="#" class="text-primary">Process</a>
            <a href="#" class="text-primary">Contact</a>

            <a href="#" class="w-full text-brand outline-solid rounded-[10px] outline-brand text-sm px-3 py-2 h-[38px] mt-4">
                Démarrer un projet
            </a>

        </div>

    </div>

</nav>