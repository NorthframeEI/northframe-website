@extends('admin.layouts.index')

@section('title', 'NF Admin - Liste des réalisations')
@section('admin.content')
    <section>

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <div>
                    <p class="text-body-bold text-brand">
                        PORTFOLIO
                    </p>

                    <h1 class="text-h1 text-primary">
                        Gestion des réalisations
                    </h1>
                </div>

                <a href="{{ route('create-portfolio') }}"
                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[12px] py-[16px] rounded-[12px]">
                    Ajouter une réalisation
                </a>

            </div>

            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Réalisation
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Technologies
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Lien
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Visibilité
                            </th>

                            <th class="text-center text-label text-secondary px-6 py-5">
                                Autorisation
                            </th>

                            <th class="text-right text-label text-secondary px-6 py-5">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($projects as $project)

                            <tr class="border-b border-primary/5 hover:bg-dark transition">

                                {{-- RÉALISATION --}}

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $project->title }}
                                        </span>

                                        <span class="text-secondary text-small line-clamp-1 max-w-[350px]">
                                            {{ $project->description }}
                                        </span>

                                    </div>

                                </td>


                                {{-- TECHNOLOGIES --}}

                                <td class="px-6 py-5">

                                    <div class="flex flex-wrap gap-2">

                                        @forelse($project->tags as $tag)
                                            <span
                                                class="inline-flex px-3 py-1 rounded-full bg-brand/10 text-brand text-caption">
                                                #{{ $tag->name }}
                                            </span>

                                        @empty

                                            <span class="text-secondary text-small">
                                                -
                                            </span>
                                        @endforelse

                                    </div>

                                </td>


                                {{-- LIEN --}}

                                <td class="px-6 py-5 text-center">

                                    @if ($project->url)
                                        <a href="{{ $project->url }}" target="_blank"
                                            class="text-brand text-small hover:underline">
                                            Voir le site
                                        </a>
                                    @else
                                        <span class="text-secondary text-small">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- VISIBILITÉ --}}

                                <td class="px-6 py-5 text-center">

                                    @if ($project->is_visible)
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-success/20 text-success text-caption">
                                            Visible
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-error/20 text-error text-caption">
                                            Masquée
                                        </span>
                                    @endif

                                </td>


                                {{-- AUTORISATION --}}

                                <td class="px-6 py-5 text-center">

                                    @if ($project->authorization_pending)
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-warning/20 text-warning text-caption">
                                            En attente
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-3 py-1 rounded-full bg-success/20 text-success text-caption">
                                            Autorisée
                                        </span>
                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a href="#"
                                            class="text-brand text-small hover:underline">
                                            Modifier
                                        </a>

                                        <form action="#" method="POST"
                                            onclick="return confirm('Supprimer cette réalisation ?')">

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

                                    Aucune réalisation enregistrée.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>
@endsection
