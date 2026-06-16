<footer class="w-full h-* bg-surface">
    <div class="max-w-6xl mx-auto px-6 items-center">

        <!--Footer Container-->
        <div class="grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-16 items-start">

            <!--Column logo-->
            <div class="flex flex-col gap-4 items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logos/logo_footer.svg') }}" alt="Northframe logo" class="h-[100px] w-[100px]">
                </div>
                <h3 class="text-h3-footer text-primary max-w-md text-center">Développeur web freelance spécialisé en
                    sites modernes et
                    performants.</h3>
                <p class="text-footer text-secondary">contact@northframe.fr</p>
                <div class="flex items-center gap-3">
                    <a href="https://www.linkedin.com/in/antoine-pad%C3%A9-565540174/"
                        class="hover:opacity-70 transition" target="_blank">
                        <img src="{{ asset('icon/linkedin.svg') }}" alt="">
                    </a>
                    <a href="https://www.github.com/apade17" class="hover:opacity-70 transition" target="_blank">
                        <img src="{{ asset('icon/github.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <!--Column Navigation-->
            <div class="flex flex-col gap-6 items-start">
                <div class="flex flex-col gap-2">
                    <p class="text-h3-footer text-primary">
                        Services
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-h3-footer text-primary">
                        <li>Site Vitrine</li>
                        <li>Landing Page</li>
                        <li>Maintenance</li>
                        <li>Renfort technique / Freelance</li>
                    </ul>
                </div>
                <div class="flex flex-col gap-2">
                    <p class="text-h3-footer text-primary">
                        Navigation
                    </p>
                    <ul class="list-disc pl-5 space-y-1 text-h3-footer text-primary">
                        <li><a href="{{ route('home') }}#services" class="hover:opacity-70 transition">
                                Services
                            </a></li>
                        <li><a href="{{ route('home') }}#portfolio" class="hover:opacity-70 transition">
                                Portfolio
                            </a></li>
                        <li><a href="{{ route('home') }}#process" class="hover:opacity-70 transition">
                                Process
                            </a></li>
                        <li><a href="{{ route('home') }}#ctaFinal" class="hover:opacity-70 transition">
                                Contact
                            </a></li>
                            <li><a href="{{ route('template') }}" class="hover:opacity-70 transition">
                                Templates
                            </a></li>
                    </ul>
                </div>
                <div class="flex items-center">

                    <!-- CTA desktop -->
                    <a href="{{ route('contact') }}"
                        class="block text-brand outline-solid rounded-[10px] outline-brand text-label px-3 py-2 h-[38px] cursor-pointer hover:text-hover hover:outline-hover">
                        Démarrer un projet
                    </a>

                </div>
            </div>
        </div>
        <div
            class="mt-10 border-t border-white/10 pt-6 pb-1 flex justify-center items-center gap-4 text-secondary text-footer">

            <a href="{{ route('mentions-legales') }}" class="hover:opacity-70 hover:text-hover transition">
                Mentions légales
            </a>

            <span>|</span>

            <a href="{{ route('politique-confidentialite') }}" class="hover:opacity-70 hover:text-hover transition">
                Politique de confidentialité
            </a>
            
            <span>|</span>

            <a href="{{ route('cgv') }}" class="hover:opacity-70 hover:text-hover transition">
                CGV
            </a>

            <span>|</span>

            <p class="m-0">
                © 2026 Northframe
            </p>

        </div>
    </div>

</footer>
