<div class="fixed top-0 left-0 z-40 flex h-screen">
    {{-- Sidebar icônes --}}
    <aside class="w-16 bg-surface border-e border-default z-20">
        <div class="flex h-full flex-col items-center py-4 gap-2">
            <a href="{{ route('dashboard') }}" data-menu="dashboard"
                class="menu-btn flex h-10 w-10 items-center justify-center rounded-base hover:bg-brand/40 cursor-pointer">
                <img src="{{ asset('icon/admin/dashboard.svg') }}" class="w-5 h-5" alt="">
            </a>
            <hr class="my-4 w-10 border-default border-secondary opacity-80">
            <button data-menu="templates"
                class="menu-btn h-10 w-10 flex items-center justify-center rounded-base hover:bg-brand/40 cursor-pointer">
                <img src="{{ asset('icon/admin/templates.svg') }}" class="w-5 h-5" alt="">
            </button>

            <button data-menu="services"
                class="menu-btn h-10 w-10 flex items-center justify-center rounded-base hover:bg-brand/40 cursor-pointer">
                <img src="{{ asset('icon/admin/contenu.svg') }}" class="w-5 h-5" alt="">
            </button>

            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button
                    class="flex h-10 w-10 items-center justify-center rounded-base hover:bg-brand/40 cursor-pointer">
                    <img src="{{ asset('icon/admin/log-out.svg') }}" class="w-5 h-5" alt="">
                </button>
            </form>
        </div>
    </aside>

    {{-- Sidebar libellés --}}
    <aside id="second-sidebar" class="w-64 bg-surface border-e border-default hidden z-10">
        <div class="h-full px-3 py-4 text-primary">

            <div data-panel="templates" class="menu-panel hidden">
                <h2 class="mb-6 px-2 text-lg font-semibold">Templates</h2>

                <nav class="space-y-6">
                    <div>
                        <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-fg-muted">
                            Templates
                        </p>

                        <a href="{{ route('list-templates') }}"
                            class="block rounded-base px-3 py-2 text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                            Liste des templates
                        </a>

                        <a href="{{ route('create-template') }}"
                            class="block rounded-base px-3 py-2 text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                            Ajouter un template
                        </a>
                    </div>

                    <div>
                        <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-fg-muted">
                            Catégories
                        </p>

                        <a href="#"
                            class="block rounded-base px-3 py-2 text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                            Liste des catégories
                        </a>

                        <a href="#"
                            class="block rounded-base px-3 py-2 text-body hover:bg-neutral-tertiary hover:text-fg-brand">
                            Ajouter une catégorie
                        </a>
                    </div>
                </nav>
            </div>

            <div data-panel="services" class="menu-panel hidden">
                <h2 class="mb-6 px-2 text-lg font-semibold">Services</h2>

                <a href="#" class="block rounded-base px-3 py-2 text-body hover:bg-brand/40 hover:text-muted">
                    Liste services
                </a>

                <a href="#" class="block rounded-base px-3 py-2 text-body hover:bg-brand/40 hover:text-muted">
                    Ajouter service
                </a>
            </div>

        </div>
    </aside>
</div>
