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

                <x-admin.portfolio-form :project="$project" :action="route('update-portfolio', $project)" method="PUT" />
    </section>
@endsection
