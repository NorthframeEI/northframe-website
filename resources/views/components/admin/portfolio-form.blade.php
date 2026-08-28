@props([
    'project' => null,
    'action',
    'method' => 'POST',
])

<form method="POST" action="{{ $action }}" enctype="multipart/form-data"
    class="w-full max-w-[900px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

    @csrf

    @if ($method !== 'POST')
        @method($method)
    @endif

    {{-- INFORMATIONS DE LA RÉALISATION --}}

    <div class="mb-6">

        <h3 class="text-h3 text-primary mb-4">
            Informations de la réalisation
        </h3>

        <div class="flex flex-col gap-4">

            <input type="text" name="title" placeholder="Titre de la réalisation"
                value="{{ old('title', $project?->title) }}"
                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

            <textarea name="description" placeholder="Description de la réalisation" rows="5"
                class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition resize-none">{{ old('description', $project?->description) }}</textarea>

            <input type="url" name="url" placeholder="https://exemple.fr"
                value="{{ old('url', $project?->url) }}"
                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

        </div>

    </div>


    {{-- IMAGE --}}

    <div class="mb-6">

        <h3 class="text-h3 text-primary mb-4">
            Image
        </h3>

        <div class="flex flex-col gap-4">

            @if ($project?->image)

                <div class="flex flex-col gap-2">

                    <span class="text-secondary text-small">
                        Image actuelle
                    </span>

                    <img src="{{ asset($project->image) }}"
                        alt="{{ $project->title }}"
                        class="w-full max-w-[400px] rounded-[10px]">

                </div>

            @endif

            <input type="file" name="image" accept="image/*"
                class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

        </div>

    </div>


    {{-- TAGS --}}

    <div class="mb-6">

        <h3 class="text-h3 text-primary mb-4">
            Technologies
        </h3>

        <div id="tags-container" class="flex flex-col gap-4">

            @if ($project?->tags?->count())

                @foreach ($project->tags as $tag)

                    <div class="flex gap-4 tag-input">

                        <input type="text" name="tags[]" placeholder="Ex : Laravel"
                            value="{{ old('tags.' . $loop->index, $tag->name) }}"
                            class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        <button type="button"
                            class="remove-tag text-secondary hover:text-primary px-3 cursor-pointer">
                            Supprimer
                        </button>

                    </div>

                @endforeach

            @else

                <div class="flex gap-4 tag-input">

                    <input type="text" name="tags[]" placeholder="Ex : Laravel"
                        value="{{ old('tags.0') }}"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <button type="button"
                        class="remove-tag text-secondary hover:text-primary px-3 cursor-pointer">
                        Supprimer
                    </button>

                </div>

            @endif

        </div>

        <button type="button" id="add-tag"
            class="mt-4 text-secondary hover:text-primary cursor-pointer">
            + Ajouter une technologie
        </button>

    </div>


    {{-- OPTIONS --}}

    <div class="mb-6">

        <h3 class="text-h3 text-primary mb-4">
            Options
        </h3>

        <div class="flex flex-col gap-4">

            <label class="flex items-center gap-3 text-secondary cursor-pointer">

                <input type="checkbox" name="is_visible" value="1"
                    {{ old('is_visible', $project?->is_visible ?? true) ? 'checked' : '' }}
                    class="w-5 h-5 accent-brand">

                Afficher la réalisation sur le site

            </label>

            <label class="flex items-center gap-3 text-secondary cursor-pointer">

                <input type="checkbox" name="authorization_pending" value="1"
                    {{ old('authorization_pending', $project?->authorization_pending ?? false) ? 'checked' : '' }}
                    class="w-5 h-5 accent-brand">

                Afficher « En attente d'autorisation »

            </label>

        </div>

    </div>


    {{-- SUBMIT --}}

    <div class="flex flex-col gap-[10px] items-center">

        <button type="submit"
            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">

            {{ $project ? 'Modifier la réalisation' : 'Ajouter la réalisation' }}

        </button>

    </div>

</form>


<script>
    const tagsContainer = document.getElementById('tags-container');
    const addTagButton = document.getElementById('add-tag');

    function addRemoveTagEvent(button) {
        button.addEventListener('click', () => {

            const tags = document.querySelectorAll('.tag-input');

            if (tags.length > 1) {
                button.closest('.tag-input').remove();
            }

        });
    }

    document.querySelectorAll('.remove-tag').forEach(button => {
        addRemoveTagEvent(button);
    });

    addTagButton.addEventListener('click', () => {

        const tag = document.createElement('div');

        tag.className = 'flex gap-4 tag-input';

        tag.innerHTML = `
            <input type="text" name="tags[]" placeholder="Ex : Laravel"
                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

            <button type="button"
                class="remove-tag text-secondary hover:text-primary px-3 cursor-pointer">
                Supprimer
            </button>
        `;

        tagsContainer.appendChild(tag);

        addRemoveTagEvent(tag.querySelector('.remove-tag'));
    });
</script>
