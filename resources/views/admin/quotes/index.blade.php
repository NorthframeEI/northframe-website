@extends('admin.layouts.index')
@section('title', 'NF Admin - Liste des categories des devis')
@section('admin.content')
    <section>

        <div class="max-w-[1242px] mx-auto px-6">

            <div class="flex justify-between items-center mb-10">

                <div>
                    <p class="text-body-bold text-brand">
                        LISTE DES DEVIS
                    </p>

                    <h1 class="text-h1 text-primary">
                        Gestion des devis
                    </h1>
                </div>

                <a href="{{ route('create-quote') }}"
                    class="text-primary text-button-inter bg-brand hover:bg-hover px-[12px] py-[16px] rounded-[12px]">
                    Créer un devis
                </a>

            </div>
            <div class="w-full mb-6">
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
            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Devis N°
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Client
                            </th>
                            <th class="text-left text-label text-secondary px-6 py-5">
                                Date d'émission
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Total
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Voir le devis
                            </th>

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Etat
                            </th>

                            <th class="text-right text-label text-secondary px-6 py-5">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($quotes as $quote)
                            <tr class="border-b border-primary/5 hover:bg-dark transition">

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $quote->number }}
                                        </span>


                                    </div>

                                </td>
                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $quote->customer->company_name }}
                                        </span>

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $quote->issued_at->format('d/m/Y') }}
                                        </span>

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <span class="text-primary text-body-bold">
                                            {{ $quote->total }}
                                        </span>

                                    </div>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex flex-col">

                                        <a href="{{ route('show-quote', $quote->id) }}"
                                            class="text-brand text-small hover:underline">
                                            Voir le devis
                                        </a>

                                    </div>

                                </td>
                                <td class="px-6 py-5">

                                    @php
                                        $statusStyles = [
                                            'draft' => 'bg-secondary/20 text-secondary',
                                            'sent' => 'bg-brand/20 text-brand',
                                            'accepted' => 'bg-success/20 text-success',
                                            'rejected' => 'bg-error/20 text-error',
                                            'expired' => 'bg-warning/20 text-warning',
                                        ];
                                    @endphp

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$quote->status] ?? 'bg-secondary/20 text-secondary' }}">
                                        {{ ucfirst($quote->status) }}
                                    </span>

                                </td>

                                <td class="px-6 py-5">

                                    <div class="flex justify-end gap-3">

                                        <a href="{{ route('edit-quote', $quote->id) }}"
                                            class="text-brand text-small hover:underline">
                                            Modifier
                                        </a>

                                        <form action="{{ route('delete-quote', $quote->id) }}" method="POST"
                                            onclick="return confirm('Supprimer ce devis ?')">

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

                                    Aucun devis enregistré.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </section>
@endsection
