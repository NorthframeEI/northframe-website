@extends('admin.layouts.index')
@section('title', 'NF Admin - Liste des templates')
@section('admin.content')
    <section>

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <div>
                    <p class="text-body-bold text-brand">
                        TEMPLATES
                    </p>

                    <h1 class="text-h1 text-primary">
                        Gestion des templates
                    </h1>
                </div>

                <a href="{{ route('create-template') }}"
                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[12px] py-[16px] rounded-[12px]">
                    Ajouter un template
                </a>

            </div>

            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Template
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Catégorie
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Sections
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Avantages
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Statut
                            </th>

                            <th class="text-right text-label text-secondary px-6 py-5">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($templates as $template)
                            <tr class="border-b border-primary/5 hover:bg-dark transition">

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $template->title }}
                                        </span>

                                        <span class="text-secondary text-small">
                                            {{ $template->slug }}
                                        </span>

                                    </div>

                                </td>

                                <td class="px-6 py-5 text-secondary text-body">
                                    {{ $template->category ?? '-' }}
                                </td>

                                <td class="px-6 py-5 text-center text-primary">
                                    {{ $template->sections->count() }}
                                </td>

                                <td class="px-6 py-5 text-center text-primary">
                                    {{ $template->benefits->count() }}

                                <td class="px-6 py-5 text-center">

                                    @if ($template->is_active)
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-success/20 text-success text-caption">
                                            Actif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-error/20 text-error text-caption">
                                            Inactif
                                        </span>
                                    @endif

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a href="{{ route('edit-template', $template) }}"
                                            class="text-brand text-small hover:underline">
                                            Modifier
                                        </a>

                                        <form action="{{ route('delete-template', $template) }}" method="POST"
                                            onclick="return confirm('Supprimer ce template ?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="text-error text-small cursor-pointer hover:underline">
                                                Supprimer
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="py-10 text-center text-secondary">

                                    Aucun template enregistré.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>
@endsection
