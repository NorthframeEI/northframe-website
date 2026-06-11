<aside
    class="bg-surface text-primary fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
            <li class="mt-6 mb-2">
                <span class="px-2 text-xs font-semibold uppercase tracking-wider text-fg-muted">
                    Templates
                </span>
            </li>

            <li>
                <a href="{{ route('list-templates') }}"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">

                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 5h16v14H4V5Z" />
                    </svg>

                    <span class="ms-3">
                        Liste
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('create-template') }}"
                    class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">

                    <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v14m-7-7h14" />
                    </svg>

                    <span class="ms-3">
                        Ajouter
                    </span>
                </a>
            </li>
            <li class="mt-6 mb-2">
                <span class="px-2 text-xs font-semibold uppercase tracking-wider text-fg-muted">
                    Services
                </span>
            </li>
            
        </ul>
    </div>
</aside>
