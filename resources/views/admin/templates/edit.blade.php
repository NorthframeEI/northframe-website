@extends('admin.layouts.index')

@section('title', 'NF Admin - Modifier un template')

@section('admin.content')
    <section>
        <div class="max-w-[1242px] mx-auto px-6">

            <div class="mb-10">
                <p class="text-body-bold text-brand">
                    TEMPLATES
                </p>

                <h1 class="text-h1 text-primary">
                    Modifier {{ $template->title }}
                </h1>
            </div>

            <div class="bg-surface border border-primary/5 rounded-[12px] p-6">
                <form action="{{ route('update-template', $template) }}" method="POST" enctype="multipart/form-data"
                    class="w-full rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-[32px]">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Titre</label>
                                <input name="title" value="{{ old('title', $template->title) }}"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                            </div>

                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Slug</label>
                                <input name="slug" value="{{ old('slug', $template->slug) }}"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-[16px]">
                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Catégorie</label>
                                <input name="category" value="{{ old('category', $template->category) }}"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Image card</label>
                                @if ($template->thumbnail_url)
                                    <img src="{{ asset('storage/' . $template->thumbnail_url) }}"
                                        class="w-full h-[160px] object-cover rounded-[10px] mb-3"
                                        alt="{{ $template->title }}">
                                @endif

                                <input name="thumbnail_url" type="file" accept="image/*"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition curdor-pointer">
                            </div>

                            <div class="flex flex-col gap-[6px]">
                                <label class="text-label text-secondary">Image hero</label>
                                @if ($template->hero_image_url)
                                    <img src="{{ asset('storage/' . $template->hero_image_url) }}"
                                        class="w-full h-[160px] object-cover rounded-[10px] mb-3"
                                        alt="{{ $template->title }}">
                                @endif
                                <input name="hero_image_url" type="file" accept="image/*"
                                    class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">
                            </div>
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">Description courte</label>
                            <input name="short_description"
                                value="{{ old('short_description', $template->short_description) }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                        </div>

                        <div class="flex flex-col gap-[6px]">
                            <label class="text-label text-secondary">Description longue</label>
                            <textarea name="long_description" rows="5"
                                class="w-full p-3 text-label text-secondary bg-dark rounded-[10px] focus:border-brand focus:border outline-none transition resize-none">{{ old('long_description', $template->long_description) }}</textarea>
                        </div>

                        <div class="flex flex-col gap-[16px]">
                            <div class="flex items-center justify-between gap-4">
                                <h2 class="text-h3 text-primary">Pourquoi ce template ?</h2>

                                <button type="button" onclick="addBenefit()"
                                    class="text-primary text-button-inter bg-brand hover:bg-hover px-4 py-3 rounded-[12px] cursor-pointer">
                                    + Ajouter
                                </button>
                            </div>

                            <div id="benefitsWrapper" class="flex flex-col gap-[16px]">
                                @foreach ($template->benefits as $index => $benefit)
                                    <div
                                        class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">
                                        <div class="flex justify-between items-center">
                                            <p class="text-body-bold text-primary">Avantage</p>
                                            <button type="button" onclick="removeBlock(this)"
                                                class="text-error text-label">Supprimer</button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-1 gap-[16px]">

                                            <input name="benefits[{{ $index }}][title]"
                                                value="{{ $benefit->title }}" placeholder="Titre"
                                                class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                        </div>

                                        <textarea name="benefits[{{ $index }}][description]" rows="3" placeholder="Description"
                                            class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none">{{ $benefit->description }}</textarea>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex flex-col gap-[16px]">
                            <div class="flex items-center justify-between gap-4">
                                <h2 class="text-h3 text-primary">Sections du template</h2>

                                <button type="button" onclick="addSection()"
                                    class="text-primary text-button-inter bg-brand hover:bg-hover px-4 py-3 rounded-[12px] cursor-pointer">
                                    + Ajouter
                                </button>
                            </div>

                            <div id="sectionsWrapper" class="flex flex-col gap-[16px]">
                                @foreach ($template->sections as $index => $section)
                                    <div
                                        class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">

                                        <input type="hidden" name="sections[{{ $index }}][existing_image]"
                                            value="{{ $section->image_url }}">

                                        <div class="flex justify-between items-center">
                                            <p class="text-body-bold text-primary">
                                                Section
                                            </p>

                                            <button type="button" onclick="removeBlock(this)"
                                                class="text-error text-label">
                                                Supprimer
                                            </button>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">

                                            <div class="flex flex-col gap-[6px]">
                                                <label class="text-label text-secondary">
                                                    Titre section
                                                </label>

                                                <input name="sections[{{ $index }}][title]"
                                                    value="{{ $section->title }}" placeholder="Titre section"
                                                    class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                            </div>

                                            <div class="flex flex-col gap-[6px]">
                                                <label class="text-label text-secondary">
                                                    Image section
                                                </label>

                                                @if ($section->image_url)
                                                    <img src="{{ asset('storage/' . $section->image_url) }}"
                                                        class="w-full h-[160px] object-cover rounded-[10px]"
                                                        alt="{{ $section->title }}">
                                                @endif

                                                <input name="sections[{{ $index }}][image_url]" type="file"
                                                    accept="image/*"
                                                    class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">
                                            </div>

                                        </div>

                                        <div class="flex flex-col gap-[6px]">
                                            <label class="text-label text-secondary">
                                                Description
                                            </label>

                                            <textarea name="sections[{{ $index }}][description]" rows="3" placeholder="Description"
                                                class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none">{{ $section->description }}</textarea>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- Files template --}}
                        <div class="flex flex-col gap-[16px]">

                            <h2 class="text-h3 text-primary">
                                Fichiers source du template
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-[16px]">

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">
                                        Fichier HTML
                                    </label>

                                    <input type="file" name="html_file" accept=".html,text/html"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">

                                    @error('html_file')
                                        <p class="text-error text-small">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">
                                        Fichier CSS
                                    </label>

                                    <input type="file" name="css_file" accept=".css,text/css"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">

                                    @error('css_file')
                                        <p class="text-error text-small">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">
                                        Fichier JS
                                    </label>

                                    <input type="file" name="js_file" accept=".js,text/javascript"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">

                                    @error('js_file')
                                        <p class="text-error text-small">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>

                        </div>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-3 text-label text-secondary">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured', $template->is_featured) ? 'checked' : '' }}>
                                Mettre en avant
                            </label>

                            <label class="flex items-center gap-3 text-label text-secondary">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $template->is_active) ? 'checked' : '' }}>
                                Template actif
                            </label>
                        </div>

                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                            Enregistrer les modifications
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </section>
    <script>
        let benefitIndex = {{ $template->benefits->count() }};
        let sectionIndex = {{ $template->sections->count() }};

        function removeBlock(button) {
            button.closest('.dynamic-block').remove();
        }

        function addBenefit() {
            document.getElementById('benefitsWrapper').insertAdjacentHTML('beforeend', `
            <div class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">
                <div class="flex justify-between items-center">
                    <p class="text-body-bold text-primary">Avantage</p>
                    <button type="button" onclick="removeBlock(this)" class="text-error text-label">Supprimer</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-1 gap-[16px]">
                   
                    <input name="benefits[${benefitIndex}][title]" placeholder="Titre"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                </div>

                <textarea name="benefits[${benefitIndex}][description]" rows="3" placeholder="Description"
                    class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"></textarea>
            </div>
        `);

            benefitIndex++;
        }

        function addSection() {
            document.getElementById('sectionsWrapper').insertAdjacentHTML('beforeend', `
            <div class="dynamic-block rounded-[12px] bg-dark p-4 border border-primary/5 flex flex-col gap-[16px]">
                <div class="flex justify-between items-center">
                    <p class="text-body-bold text-primary">Section</p>
                    <button type="button" onclick="removeBlock(this)" class="text-error text-label">Supprimer</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                    <input name="sections[${sectionIndex}][title]" placeholder="Titre section"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                    <input name="sections[${sectionIndex}][image_url]" type="file" accept="image/*"
                        class="block w-full h-[48px] rounded-[10px] bg-surface px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition cursor-pointer">
                </div>

                <textarea name="sections[${sectionIndex}][description]" rows="3" placeholder="Description"
                    class="w-full p-3 text-label text-secondary bg-surface rounded-[10px] focus:border-brand focus:border outline-none transition resize-none"></textarea>
            </div>
        `);

            sectionIndex++;
        }
    </script>
@endsection
