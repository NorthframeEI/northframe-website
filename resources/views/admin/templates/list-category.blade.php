@extends('admin.layouts.index')
@section('title', 'NF Admin - Liste des categories de templates')
@section('admin.content')
    <section>

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <div>
                    <p class="text-body-bold text-brand">
                        CATÉGORIES DE TEMPLATES
                    </p>

                    <h1 class="text-h1 text-primary">
                        Gestion des catégories de templates
                    </h1>
                </div>

                <a href="{{route('create-category')}}"
                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[12px] py-[16px] rounded-[12px]">
                    Ajouter une catégorie
                </a>

            </div>

            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Nom de la catégorie
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Slug
                            </th>

                            <th class="text-right text-label text-secondary px-6 py-5">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($categories as $category)
                            <tr class="border-b border-primary/5 hover:bg-dark transition">

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $category->name }}
                                        </span>


                                    </div>

                                </td>
                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $category->slug }}
                                        </span>

                                    </div>

                                </td>


                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a href="{{route('edit-category', $category->id)}}" class="text-brand text-small hover:underline">
                                            Modifier
                                        </a>

                                        <form action="{{route('delete-category', $category->id)}}" method="POST"
                                            onclick="return confirm('Supprimer cette catégorie ?')">

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
