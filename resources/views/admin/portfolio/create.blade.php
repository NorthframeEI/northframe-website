@extends('admin.layouts.index')

@section('title', 'NF Admin - Ajout d\'une réalisation')
@section('admin.content')
    <section id="createPortfolio">
        <div class="max-w-[1242px] mx-auto px-6 py-12">

            <div class="grid grid-cols-1 gap-6 justify-center mb-10">
                <h1 class="text-h1 text-primary text-center">
                    Ajouter une réalisations
                </h1>
                <p class="text-navbar text-secondary text-center">
                    Ajoute les informations de la réalisation.
                </p>
            </div>

            <div class="flex flex-col items-center px-3 py-3 gap-4">

                <div class="w-full max-w-[900px]">
                    @if (session('success'))
                        <div class="p-4 bg-success/30 border border-success text-success rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="p-4 bg-error/30 border border-error text-error rounded-lg">
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{route('store-portfolio')}}" enctype="multipart/form-data"
                    class="w-full max-w-[900px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                    @csrf

                    {{-- INFORMATIONS DE LA RÉALISATION --}}

                    <div class="mb-6">

                        <h3 class="text-h3 text-primary mb-4">Informations de la réalisation</h3>

                        <div class="flex flex-col gap-4">

                            <input type="text" name="title" placeholder="Titre de la réalisation"
                                value="{{ old('title') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                            <textarea name="description" placeholder="Description de la réalisation" rows="5"
                                class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition resize-none">{{ old('description') }}</textarea>

                            <input type="url" name="url" placeholder="https://exemple.fr"
                                value="{{ old('url') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>

                    </div>


                    {{-- IMAGE --}}

                    <div class="mb-6">

                        <h3 class="text-h3 text-primary mb-4">Image</h3>

                        <div class="flex flex-col gap-4">

                            <input type="file" name="image" accept="image/*"
                                class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>

                    </div>


                    {{-- TAGS --}}

                    <div class="mb-6">

                        <h3 class="text-h3 text-primary mb-4">Technologies</h3>

                        <div id="tags-container" class="flex flex-col gap-4">

                            <div class="flex gap-4 tag-input">

                                <input type="text" name="tags[]" placeholder="Ex : Laravel"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                <button type="button"
                                    class="remove-tag text-secondary hover:text-primary px-3 cursor-pointer">
                                    Supprimer
                                </button>

                            </div>

                        </div>

                        <button type="button" id="add-tag" class="mt-4 text-secondary hover:text-primary cursor-pointer">
                            + Ajouter une technologie
                        </button>

                    </div>


                    {{-- OPTIONS --}}

                    <div class="mb-6">

                        <h3 class="text-h3 text-primary mb-4">Options</h3>

                        <div class="flex flex-col gap-4">

                            <label class="flex items-center gap-3 text-secondary cursor-pointer">

                                <input type="checkbox" name="is_visible" value="1"
                                    {{ old('is_visible', true) ? 'checked' : '' }} class="w-5 h-5 accent-brand">

                                Afficher la réalisation sur le site

                            </label>

                            <label class="flex items-center gap-3 text-secondary cursor-pointer">

                                <input type="checkbox" name="authorization_pending" value="1"
                                    {{ old('authorization_pending') ? 'checked' : '' }} class="w-5 h-5 accent-brand">

                                Afficher « En attente d'autorisation »

                            </label>

                        </div>

                    </div>


                    {{-- SUBMIT --}}

                    <div class="flex flex-col gap-[10px] items-center">

                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                            Ajouter la réalisation
                        </button>

                    </div>

                </form>


                <script>
                    const tagsContainer = document.getElementById('tags-container');
                    const addTagButton = document.getElementById('add-tag');

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

                        tag.querySelector('.remove-tag').addEventListener('click', () => {
                            tag.remove();
                        });
                    });

                    document.querySelector('.remove-tag').addEventListener('click', (event) => {
                        const tags = document.querySelectorAll('.tag-input');

                        if (tags.length > 1) {
                            event.target.closest('.tag-input').remove();
                        }
                    });
                </script>
    </section>
@endsection
