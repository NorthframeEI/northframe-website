@extends('admin.layouts.index')

@section('title', 'NF Admin - Facture ' . $invoice->number)

@section('admin.content')
    <div
        class="sticky top-[80px] z-10 bg-surface/80 backdrop-blur border border-primary/15 px-2 py-2 w-fit rounded-[10px] mt-6 ml-1">
        <a href="{{ route('list-invoices') }}"
            class="inline-flex items-center gap-2 text-secondary hover:text-primary transition">

            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M15 18l-6-6 6-6" />
            </svg>

            Retour
        </a>
    </div>
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

            </div>



            {{-- ACTIONS --}}

            <div class="w-full flex flex-wrap gap-3 justify-center mb-8">

                @if ($invoice->status !== 'paid')
                    <a href="{{ route('invoices-preview', $invoice) }}" target="_blank"
                        class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]">

                        Prévisualiser

                    </a>
                @else
                    <a href="{{ route('invoices-paid-preview', $invoice) }}" target="_blank"
                        class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px]">

                        Prévisualiser

                    </a>
                @endif
                @php
                    $pdfExists = Storage::disk('private')->exists('invoices/' . $invoice->number . '.pdf');
                @endphp
                @if ($invoice->status === 'draft')
                    <form method="POST" action="{{ route('invoices-generate-pdf', $invoice) }}">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Générer PDF facture

                        </button>

                    </form>

                    @if ($pdfExists)
                        <form method="POST" action="{{ route('invoices-sent', $invoice) }}">

                            @csrf

                            <button type="submit"
                                class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                                Envoyer la facture

                            </button>

                        </form>
                    @endif
                @endif
                @php
                    $pdfPaidExists = Storage::disk('private')->exists(
                        'invoices/' . $invoice->number . '-acquittee.pdf',
                    );
                @endphp
                @if ($invoice->status === 'paid')
                    <form method="POST" action="{{ route('invoices-generate-paid-pdf', $invoice) }}">

                        @csrf

                        <button type="submit"
                            class="text-primary bg-surface border border-primary/10 hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                            Générer PDF facture acquittée

                        </button>

                    </form>

                    @if ($pdfPaidExists)
                        <form method="POST" action="{{ route('invoices-paid-sent', $invoice) }}">

                            @csrf

                            <button type="submit"
                                class="text-primary bg-brand hover:bg-hover px-[20px] py-[10px] rounded-[12px] cursor-pointer">

                                Envoyer la facture acquittée

                            </button>

                        </form>
                    @endif
                @endif



            </div>


            {{-- ALERTS --}}
            <div class="w-full max-w-[900px] mx-auto mb-6">

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

                <table class="border-collapse min-w-[350px]">

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


                    <tr>
                        <td class="px-5 py-4 bg-dark text-secondary border border-primary/10">
                            <strong>
                                Déjà payé
                            </strong>
                        </td>

                        <td class="px-5 py-4 text-right text-secondary border border-primary/10 text-lg">
                            <strong>
                                {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
                            </strong>
                        </td>
                    </tr>


                    <tr>
                        <td class="px-5 py-4 bg-dark text-secondary border border-primary/10">
                            <strong>
                                Reste à payer
                            </strong>
                        </td>

                        <td class="px-5 py-4 text-right text-secondary border border-primary/10 text-lg">
                            <strong>
                                {{ number_format($invoice->total - $invoice->paid_amount, 2, ',', ' ') }} €
                            </strong>
                        </td>
                    </tr>

                </table>

            </div>
            @php
                $paymentMethods = [
                    'bank_transfer' => 'Virement bancaire',
                    'card' => 'Carte bancaire',
                    'cash' => 'Espèces',
                    'check' => 'Chèque',
                    'other' => 'Autre',
                ];
            @endphp
            @if ($invoice->status === 'sent' || $invoice->status === 'partially_paid')
                {{-- FORM AJOUT PAIEMENT --}}
                <div
                    class="w-full mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">

                    <h3 class="text-h3 text-primary mb-4">
                        Ajouter un paiement
                    </h3>

                    <form method="POST" action="{{ route('invoice-payments-store', $invoice) }}"
                        class="flex flex-col gap-4">

                        @csrf

                        {{-- Montant --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Montant <span style="text-color:red">*</span>
                            </label>

                            <input type="number" name="amount" value="{{ old('amount') }}" placeholder="Ex : 1200"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>


                        {{-- Date --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Date de paiement <span style="text-color:red">*</span>
                            </label>

                            <input type="date" name="paid_at" value="{{ old('paid_at') }}"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">
                        </div>


                        {{-- Méthode --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Méthode de paiement <span style="text-color:red">*</span>
                            </label>

                            <select name="method" id="method"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                                @foreach ($paymentMethods as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach

                            </select>
                        </div>


                        {{-- Réference --}}
                        <div class="flex flex-col gap-2">

                            <label class="text-secondary">
                                Référence du paiement
                            </label>

                            <input type="text" name="reference" value="{{ old('reference') }}"
                                placeholder="Ex : P-2023-001"
                                class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary/70 border border-transparent focus:border-brand outline-none transition">

                        </div>

                        <button type="submit"
                            class="text-primary text-button-inter bg-brand hover:bg-hover px-[20px] py-[20px] rounded-[12px] w-fit cursor-pointer">
                            Ajouter ligne
                        </button>

                    </form>
                </div>
            @endif

            {{-- LIGNES PAIEMENTs --}}
            @if ($invoice->payments->count() > 0)
                <div
                    class="w-full mx-auto mb-6 rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
                    <h3 class="text-h3 text-primary mb-4">
                        Historique des paiements
                    </h3>
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-primary/5">
                                <th class="text-left text-label text-secondary px-6 py-5">
                                    Montant payé
                                </th>
                                <th class="text-left text-label text-secondary px-6 py-5">
                                    Payé le
                                </th>
                                <th class="text-left text-label text-secondary px-6 py-5">
                                    Méthode de paiement
                                </th>
                                <th class="text-right text-label text-secondary px-6 py-5">
                                    Référence
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->payments as $payment)
                                <tr class="border-b border-primary/5">
                                    <td class="px-6 py-5">
                                        <p class="text-primary text-body-bold">
                                            {{ number_format($payment->amount, 2, ',', ' ') }} €
                                        </p>
                                    </td>
                                    <td class="px-6 py-5 text-primary">
                                        {{ $payment->paid_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-5 text-primary">
                                        {{ $paymentMethods[$payment->method] ?? $payment->method }}
                                    </td>
                                    <td class="px-6 py-5 text-right text-primary text-body-bold">
                                        {{ $payment->reference }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-surface border border-primary/5 rounded-[12px] p-6 mb-8">
                    <h3 class="text-h3 text-primary mb-4">
                        Historique des paiements
                    </h3>
                    <p class="text-secondary">
                        Aucun paiement enregistré pour cette facture.
                    </p>
                </div>
            @endif
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
