<a @if (!$project->authorization_pending) href="{{ $project->url }}" @endif
    class="relative rounded-[12px] bg-surface overflow-hidden shadow-lg px-[16px] py-[24px]
          hover:shadow-hover hover:-translate-y-2 transition-all duration-300 ease-out hover:scale-[1.02]
          border border-primary/5 hover:border-hover {{ $project->authorization_pending ? 'pointer-events-none' : '' }}"
    target="_blank">

    <!-- Badge overlay -->
    @if ($project->authorization_pending)
        <div class="absolute top-4 left-4 z-10 bg-black/80 text-primary text-small px-3 py-2 rounded-full">
            🔒 En attente d'autorisation
        </div>
    @endif
    <img class="w-full aspect-video bg-white opacity-90" src="{{ asset($project->image) }}" alt="Site vitrine">

    <div class="px-6 py-4 flex flex-col gap-[10px]">

        <div class="text-card-title text-primary text-center">
            {{ $project->title }}
        </div>

        <div class="flex flex-wrap justify-center gap-[8px]">

            <p class="text-label text-secondary text-center">
                {{ $project->description }}
            </p>

            @foreach ($project->tags as $tag)
                <span
                    class="inline-block outline-solid outline-brand rounded-full px-3 py-1 text-sm font-semibold text-secondary">
                    #{{ $tag->name }}
                </span>
            @endforeach

        </div>
    </div>

</a>
