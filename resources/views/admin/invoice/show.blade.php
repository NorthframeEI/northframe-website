@extends('admin.layouts.index')

@section('title', 'NF Admin - Facture ' . $invoice->number)

@section('admin.content')

    <section>

        <div class="max-w-[1100px] mx-auto px-6">


            <div class="flex justify-between items-center mb-10">

                <div>

                    <p class="text-body-bold text-brand">
                        FACTURE
                    </p>

                    <h1 class="text-h1 text-primary">
                        {{ $invoice->number }}
                    </h1>

                </div>


                <a href="{{ route('list-invoices') }}"
                    class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]">

                    Retour

                </a>


            </div>



            {{-- ACTIONS --}}

            <div class="w-full flex flex-wrap gap-3 justify-center mb-8">


                <a href="#"
                    class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]">

                    Prévisualiser

                </a>


                <form method="POST" action="#">

                    @csrf

                    <button type="submit"
                        class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                        Générer le PDF

                    </button>

                </form>


                @if ($invoice->status === 'draft')
                    <form method="POST" action="#">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Envoyer la facture

                        </button>

                    </form>
                @endif


                @if ($invoice->status !== 'paid')
                    <form method="POST" action="#">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-success hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Ajouter un paiement

                        </button>

                    </form>
                @endif


            </div>




            {{-- INFORMATIONS FACTURE --}}

            <div class="bg-surface border border-primary/5 rounded-[12px] p-8 mb-8">


                <div class="grid grid-cols-2 gap-10">


                    <div>

                        <h2 class="text-primary text-body-bold mb-4">
                            Informations client
                        </h2>


                        <p class="text-primary">
                            <strong>
                                {{ $invoice->customer->company_name }}
                            </strong>
                        </p>


                        <p class="text-secondary">
                            {{ $invoice->customer->contact_name }}
                        </p>


                        <p class="text-secondary">
                            {{ $invoice->customer->address }}
                        </p>


                        <p class="text-secondary">

                            {{ $invoice->customer->postal_code }}
                            {{ $invoice->customer->city }}

                        </p>


                        <p class="text-secondary">

                            {{ $invoice->customer->email }}

                        </p>


                    </div>



                    <div class="text-right">


                        <h2 class="text-primary text-body-bold mb-4">
                            Facture
                        </h2>


                        <p class="text-primary">

                            N°
                            <strong>
                                {{ $invoice->number }}
                            </strong>

                        </p>


                        <p class="text-secondary">

                            Émise le :

                            @if ($invoice->issued_at)
                                {{ $invoice->issued_at->format('d/m/Y') }}
                            @else
                                -
                            @endif

                        </p>


                        <p class="text-secondary">

                            Échéance :

                            @if ($invoice->due_date)
                                {{ $invoice->due_date->format('d/m/Y') }}
                            @else
                                -
                            @endif

                        </p>



                        @php

                            $statusStyles = [
                                'draft' => 'bg-secondary/20 text-secondary',
                                'sent' => 'bg-brand/20 text-brand',
                                'partially_paid' => 'bg-warning/20 text-warning',
                                'paid' => 'bg-success/20 text-success',
                                'overdue' => 'bg-error/20 text-error',
                                'cancelled' => 'bg-error/20 text-error',
                            ];

                            $statusLabels = [
                                'draft' => 'Brouillon',
                                'sent' => 'Envoyée',
                                'partially_paid' => 'Partiellement payée',
                                'paid' => 'Payée',
                                'overdue' => 'En retard',
                                'cancelled' => 'Annulée',
                            ];

                        @endphp


                        <span
                            class="inline-flex mt-4 px-3 py-1 rounded-full text-xs font-medium {{ $statusStyles[$invoice->status] }}">

                            {{ $statusLabels[$invoice->status] }}

                        </span>


                    </div>


                </div>


            </div>





            {{-- LIGNES FACTURE --}}

            <div class="bg-surface border border-primary/5 rounded-[12px] overflow-hidden mb-8">


                <table class="w-full">


                    <thead>

                        <tr class="border-b border-primary/5">

                            <th class="text-left text-label text-secondary px-6 py-5">
                                Description
                            </th>


                            <th class="text-left text-label text-secondary px-6 py-5">
                                Quantité
                            </th>


                            <th class="text-left text-label text-secondary px-6 py-5">
                                Prix unitaire
                            </th>


                            <th class="text-right text-label text-secondary px-6 py-5">
                                Total
                            </th>


                        </tr>

                    </thead>


                    <tbody>


                        @foreach ($invoice->items as $item)
                            <tr class="border-b border-primary/5">


                                <td class="px-6 py-5">

                                    <p class="text-primary text-body-bold">

                                        {{ $item->designation }}

                                    </p>


                                    @if ($item->description)
                                        <p class="text-secondary text-small">

                                            {{ $item->description }}

                                        </p>
                                    @endif

                                </td>



                                <td class="px-6 py-5 text-primary">

                                    {{ $item->quantity }}

                                </td>



                                <td class="px-6 py-5 text-primary">

                                    {{ number_format($item->unit_price, 2, ',', ' ') }} €

                                </td>



                                <td class="px-6 py-5 text-right text-primary text-body-bold">

                                    {{ number_format($item->total, 2, ',', ' ') }} €

                                </td>


                            </tr>
                        @endforeach


                    </tbody>


                </table>


            </div>





            {{-- TOTAL --}}

            <div class="flex justify-end mb-8">


                <table class="border-collapse min-w-[300px]">


                    <tr>

                        <td class="px-5 py-4 bg-brand text-primary border border-brand">

                            <strong>
                                Total
                            </strong>

                        </td>


                        <td class="px-5 py-4 text-right text-primary border border-primary/10 text-lg">

                            <strong>

                                {{ number_format($invoice->total, 2, ',', ' ') }} €

                            </strong>

                        </td>


                    </tr>


                </table>


            </div>




            {{-- NOTES --}}

            @if ($invoice->notes)
                <div class="bg-surface border border-primary/5 rounded-[12px] p-6">


                    <h2 class="text-primary text-body-bold mb-3">
                        Notes
                    </h2>


                    <p class="text-secondary">
                        {{ $invoice->notes }}
                    </p>


                </div>
            @endif



        </div>


    </section>


@endsection
