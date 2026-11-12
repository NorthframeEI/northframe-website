@extends('admin.layouts.index')

@section('title', 'NF Admin - Nouvelle facture')
@section('admin.content')

    @php
        $input =
            'block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-hover outline-none transition';
    @endphp

    <div class="max-w-[900px] mx-auto px-6 py-8">

        <h1 class="text-h1 text-primary mb-8">Nouvelle facture</h1>

        <form method="POST" action="{{ route('invoices-store') }}" class="space-y-10">
            @csrf

            {{-- CLIENT --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6 space-y-4">
                <h2 class="text-h3 text-primary">Client</h2>

                <div>
                    <label for="customer_id" class="sr-only">Client existant</label>
                    <select id="customer_id" name="customer_id" class="{{ $input }}">
                        <option value="">Nouveau client</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @selected((string) old('customer_id') === (string) $customer->id)>
                                {{ $customer->company_name ?? $customer->contact_name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-secondary text-sm mt-2">
                        Choisis un client existant, ou laisse « Nouveau client » et remplis les champs ci-dessous.
                    </p>
                    @error('customer_id')
                        <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                @foreach ([
            'company_name' => 'Raison sociale',
            'siret' => 'SIRET (14 chiffres)',
            'contact_name' => 'Nom du contact',
            'email' => 'E-mail',
            'phone' => 'Téléphone',
            'address' => 'Adresse',
            'postal_code' => 'Code postal',
            'city' => 'Ville',
            'country' => 'Pays',
        ] as $field => $label)
                    <div>
                        <label for="{{ $field }}" class="sr-only">{{ $label }}</label>
                        <input type="{{ $field === 'email' ? 'email' : 'text' }}" id="{{ $field }}"
                            name="{{ $field }}" placeholder="{{ $label }}"
                            value="{{ old($field, $field === 'country' ? 'France' : '') }}" class="{{ $input }}">
                        @error($field)
                            <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            {{-- FACTURE --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6 space-y-4">
                <h2 class="text-h3 text-primary">Facture</h2>

                <div>
                    <label for="subject" class="sr-only">Sujet de la facture</label>
                    <input type="text" id="subject" name="subject" placeholder="Sujet de la facture"
                        value="{{ old('subject') }}" class="{{ $input }}">
                    @error('subject')
                        <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="sr-only">Type de projet</label>
                    <select id="type" name="type" required class="{{ $input }}">
                        <option value="" disabled @selected(old('type') === null)>Type de projet</option>
                        @foreach (\App\Enums\DocumentType::cases() as $type)
                            <option value="{{ $type->value }}" @selected(old('type') === $type->value)>
                                {{ $type->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- PRESTATION --}}
            <div class="bg-surface rounded-[12px] border border-primary/5 p-6 space-y-4">
                <h2 class="text-h3 text-primary">Prestation</h2>

                <div>
                    <label for="designation" class="sr-only">Désignation</label>
                    <input type="text" id="designation" name="designation"
                        placeholder="Désignation (ex. Développement de A à Z)" value="{{ old('designation') }}"
                        class="{{ $input }}">
                    @error('designation')
                        <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="sr-only">Description</label>
                    <textarea id="description" name="description" rows="3" placeholder="Description (facultatif)"
                        class="block w-full rounded-[10px] bg-dark px-3 py-3 text-secondary/70 border border-transparent focus:border-hover outline-none transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="quantity" class="sr-only">Quantité</label>
                        <input type="number" step="0.01" min="0.01" id="quantity" name="quantity"
                            placeholder="Quantité" value="{{ old('quantity', 1) }}" class="{{ $input }}">
                        @error('quantity')
                            <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_price" class="sr-only">Prix unitaire en euros</label>
                        <input type="number" step="0.01" min="0" id="unit_price" name="unit_price"
                            placeholder="Prix unitaire (€)" value="{{ old('unit_price') }}" class="{{ $input }}">
                        @error('unit_price')
                            <p class="mt-2 text-error" role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-[10px]">
                <button type="submit"
                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-ful cursor-pointer">
                    Créer la facture
                </button>
            </div>
        </form>

    </div>
@endsection
