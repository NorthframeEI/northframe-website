@extends('admin.layouts.index')
@section('title', 'NF Admin - Créer une catégorie')
@section('admin.content')
    <section id="createCategory">
        <div class="max-w-[1242px] mx-auto px-6 py-12">

            <div class="grid grid-cols-1 gap-6 justify-center mb-10">
                <h1 class="text-h1 text-primary text-center">
                    Créer une catégorie
                </h1>
                <p class="text-navbar text-secondary text-center">
                    Ajoute les informations de la catégorie.
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

                <form action="{{ route('store-category') }}" method="POST"
                    class="w-full max-w-[900px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
                    @csrf

                    <div class="flex flex-col gap-[32px]">

                        
                        <div class="flex flex-col gap-[16px]">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px]">
                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Nom <span class="text-red-500">*</span></label>
                                    <input name="name" value="{{ old('name') }}" required placeholder="SaaS"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>

                                <div class="flex flex-col gap-[6px]">
                                    <label class="text-label text-secondary">Slug <span
                                            class="text-red-500">*</span></label>
                                    <input name="slug" value="{{ old('slug') }}" required placeholder="saas"
                                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                                </div>
                            </div>
                            <div class="flex flex-col gap-[10px] items-center">
                                <button type="submit"
                                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                                    Créer la catégorie
                                </button>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </section>

@endsection
