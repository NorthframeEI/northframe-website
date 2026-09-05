<div style="max-width:800px;margin:auto;font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#333;">

    @php

        $path = public_path('logos/logo_facture.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);

        $data = file_get_contents($path);

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    @endphp


    {{-- HEADER --}}

    <table width="100%" style="border-collapse:collapse;">

        <tr>

            <td style="width:50%;vertical-align:top;">

                <img src="{{ $base64 }}" style="width:120px;margin-bottom:15px;">

            </td>


            <td style="width:50%;text-align:right;vertical-align:top;">

                <h1 style="margin:0;font-size:38px;color:#0B1220;">

                    FACTURE D'ACOMPTE

                </h1>

                <div style="font-size:18px;font-weight:bold;margin-top:8px;">

                    {{ $depositInvoice->number }}

                </div>

                <div style="margin-top:20px;line-height:1.8;">

                    <strong>Date d'émission :</strong>

                    {{ $depositInvoice->issued_at->format('d/m/Y') }}

                    <br>

                    <strong>Devis associé :</strong>

                    {{ $depositInvoice->quote->number }}

                </div>

            </td>

        </tr>


        <tr>

            <td>

                <div style="line-height:1.7;">

                    <strong style="font-size:20px;color:#0B1220;">Northframe</strong><br>

                    Antoine Padé - EI <br>

                    112Q Rue de Cambrai<br>

                    62000 Arras<br>

                    contact@northframe.fr<br>

                    SIRET : 10470172700018

                </div>

            </td>


            <td style="padding-top:40px;text-align:right;">

                <div
                    style="display:inline-block;border:1px solid #DDD;padding:15px 20px;text-align:left;min-width:240px;">

                    <strong style="color:#0B1220;">FACTURÉ À</strong>

                    <br><br>

                    @if ($depositInvoice->quote->customer->company_name)
                        <strong>{{ $depositInvoice->quote->customer->company_name }}</strong><br>
                    @endif

                    @if ($depositInvoice->quote->customer->contact_name)
                        {{ $depositInvoice->quote->customer->contact_name }}<br>
                    @endif

                    @if ($depositInvoice->quote->customer->address)
                        {{ $depositInvoice->quote->customer->address }}<br>
                    @endif

                    @if ($depositInvoice->quote->customer->postal_code || $depositInvoice->quote->customer->city)
                        {{ $depositInvoice->quote->customer->postal_code }}
                        {{ $depositInvoice->quote->customer->city }}<br>
                    @endif

                    @if ($depositInvoice->quote->customer->email)
                        {{ $depositInvoice->quote->customer->email }}<br>
                    @endif

                    @if ($depositInvoice->quote->customer->phone)
                        {{ $depositInvoice->quote->customer->phone }}<br>
                    @endif

                    @if ($depositInvoice->quote->customer->siret)
                        SIRET : {{ $depositInvoice->quote->customer->siret }}
                    @endif

                </div>

            </td>

        </tr>

    </table>


    <hr style="margin:35px 0;border:none;border-top:2px solid #0B1220;">


    {{-- OBJET --}}

    <div style="margin-bottom:25px;line-height:1.7;">

        <strong style="color:#0B1220;">Objet</strong>

        <br>

        Facture d'acompte de 50 % concernant le devis

        <strong>{{ $depositInvoice->quote->number }}</strong>.

        <br>

        {{ $depositInvoice->quote->subject }}

    </div>


    {{-- DÉTAIL DE L'ACOMPTE --}}

    <h3 style="color:#0B1220;margin-bottom:10px;">

        Acompte

    </h3>


    <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;border:1px solid #DDD;">

        <thead>

            <tr style="background:#0B1220;color:#FFF;">

                <th align="left">

                    Description

                </th>

                <th width="120">

                    Montant

                </th>

            </tr>

        </thead>


        <tbody>

            <tr>

                <td style="border:1px solid #DDD;font-size:13px;">

                    Acompte de 50 % sur le montant total du devis

                    {{ $depositInvoice->quote->number }}.

                    @if ($depositInvoice->quote->subject)
                        <br>

                        <small style="color:#666;">

                            {{ $depositInvoice->quote->subject }}

                        </small>
                    @endif

                </td>

                <td align="right" style="border:1px solid #DDD;white-space:nowrap;">

                    {{ number_format($depositInvoice->amount, 2, ',', ' ') }} €

                </td>

            </tr>

        </tbody>

    </table>


    {{-- RÉSUMÉ --}}

    <table width="100%" style="border-collapse:collapse;margin-top:25px;">

        <tr>

            <td width="55%" valign="top" style="font-size:11px;line-height:1.6;">

                <strong style="color:#0B1220;">

                    Conditions de paiement

                </strong>

                <br>

                • Cette facture correspond à l'acompte de 50 % prévu lors de l'acceptation du devis.

                <br>

                • Le démarrage du projet intervient après réception du paiement de l'acompte.

                <br>

                • Le solde sera facturé à la livraison du projet.

            </td>


            <td width="45%" valign="top" align="right">

                <table style="border-collapse:collapse;min-width:280px;">

                    <tr>

                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">

                            <strong>Total à payer</strong>

                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">

                            <strong>

                                {{ number_format($depositInvoice->amount, 2, ',', ' ') }} €

                            </strong>

                        </td>

                    </tr>

                </table>

            </td>

        </tr>

    </table>


    <div style="clear:both;"></div>

    <div style="height:130px;"></div>


    {{-- FOOTER --}}

    <div
        style="
            position:fixed;
            bottom:0;
            left:0;
            right:0;
            height:120px;
            font-size:10px;
            color:#666;
            line-height:1.5;
        ">

        <table width="100%" style="border-collapse:collapse;">

            <tr>

                {{-- Coordonnées bancaires --}}
                <td width="45%" valign="top" style="padding-right:20px;line-height:1.5;">

                    <strong style="color:#0B1220;">
                        Coordonnées bancaires
                    </strong>

                    <br>

                    Titulaire :
                    {{ config('app.bank_owner') }}

                    <br>

                    Banque :
                    {{ config('app.bank_name') }}

                    <br>

                    IBAN :
                    {{ config('app.bank_iban') }}

                    <br>

                    BIC :
                    {{ config('app.bank_bic') }}

                    <br>

                    Référence de paiement :
                    {{ $depositInvoice->number }}

                </td>


                {{-- Mentions légales --}}
                <td width="55%" valign="top" style="line-height:1.5;">

                    <strong style="color:#0B1220;">
                        Mentions légales
                    </strong>

                    <br>

                    {{ $depositInvoice->invoice->vat_notice }}
                    <br>

                    En cas de retard de paiement, des pénalités pourront être appliquées conformément aux dispositions
                    légales en vigueur.

                    <br>

                    Une indemnité forfaitaire de 40 € pour frais de recouvrement sera exigible conformément aux articles
                    L441-10 et D441-5 du Code de commerce.
                </td>

            </tr>

        </table>

    </div>
