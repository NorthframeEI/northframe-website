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
                    Facture
                </h1>

                <div style="font-size:18px;font-weight:bold;margin-top:8px;">
                    {{ $invoice->number }}
                </div>

                <div style="margin-top:20px;line-height:1.8;">

                    <strong>Date d'émission :</strong>
                    {{ $invoice->issued_at->format('d/m/Y') }}
                    <br>

                    <strong>Date d'échéance :</strong>
                    {{ $invoice->due_date->format('d/m/Y') }}

                </div>

            </td>

        </tr>

        <tr>

            <td>
                <div style="line-height:1.7;">
                    <strong style="font-size:20px;color:#0B1220;">NorthFrame</strong><br>

                    112Q Rue de Cambrai<br>
                    62000 Arras<br>

                    contact@northframe.fr<br>

                    SIRET : 104 701 727 00018
                </div>
            </td>

            <td style="padding-top:40px;text-align:right;">

                <div
                    style="display:inline-block;border:1px solid #DDD;padding:15px 20px;text-align:left;min-width:240px;">

                    <strong style="color:#0B1220;">FACTURÉ À</strong>

                    <br><br>

                    <strong>{{ $invoice->customer->company_name }}</strong><br>

                    {{ $invoice->customer->contact_name }}<br>

                    {{ $invoice->customer->address }}<br>

                    {{ $invoice->customer->postal_code }}
                    {{ $invoice->customer->city }}<br>

                    {{ $invoice->customer->email }}

                </div>

            </td>

        </tr>

    </table>

    <hr style="margin:35px 0;border:none;border-top:2px solid #0B1220;">


    @php
        $oneTimeItems = $invoice->items->where('type', 'one_time');
    @endphp

    {{-- PRESTATIONS --}}

    <h3 style="color:#0B1220;margin-bottom:10px;">
        Prestations
    </h3>

    <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;border:1px solid #DDD;">

        <thead>

            <tr style="background:#0B1220;color:#FFF;">

                <th align="left">
                    Description
                </th>

                <th width="80">
                    Qté
                </th>

                <th width="110">
                    PU
                </th>

                <th width="120">
                    Total
                </th>

            </tr>

        </thead>


        <tbody>

            @foreach ($invoice->items as $item)
                <tr>

                    <td style="border:1px solid #DDD;font-size:13px;">

                        {{ $item->designation }}

                        @if ($item->description)
                            <br>
                            <small style="color:#666;">
                                {{ $item->description }}
                            </small>
                        @endif

                    </td>


                    <td align="center" style="border:1px solid #DDD;">
                        {{ $item->quantity }}
                    </td>


                    <td align="right" style="border:1px solid #DDD;">
                        {{ number_format($item->unit_price, 2, ',', ' ') }} €
                    </td>


                    <td align="right" style="border:1px solid #DDD;">
                        {{ number_format($item->total, 2, ',', ' ') }} €
                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    {{-- RESUME BAS DE PAGE --}}

    <table width="100%" style="border-collapse:collapse;margin-top:25px;">

        <tr>

            {{-- CONDITIONS A GAUCHE --}}
            <td width="55%" valign="top" style="font-size:11px;line-height:1.6;">

                <strong style="color:#0B1220;">
                    Conditions
                </strong>

                <br>

                • Paiement à effectuer avant le {{ $invoice->due_date->format('d/m/Y') }}.

                <br>

                • Merci de rappeler le numéro de facture lors de votre règlement.

                <br>

                • En cas de virement bancaire, utiliser la référence de la facture.

            </td>


            {{-- TOTAL --}}
            <td width="45%" valign="top" align="right">


                <table style="border-collapse:collapse;min-width:280px;">

                    <tr>

                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Total projet</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">

                            <strong>
                                {{ number_format($invoice->total, 2, ',', ' ') }} €
                            </strong>

                        </td>

                    </tr>
                    <tr>

                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Déjà payé</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">

                            <strong>
                                {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
                            </strong>

                        </td>

                    </tr>
                    <tr>

                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Reste à payer</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">

                            <strong>
                                {{ number_format($invoice->total - $invoice->paid_amount, 2, ',', ' ') }} €
                            </strong>

                        </td>

                    </tr>

                </table>


            </td>

        </tr>

    </table>

    <div
        style="
    position:fixed;
    bottom:0;
    left:0;
    right:0;
    height:120px;
    border-top:1px solid #DDD;
    padding-top:10px;
    font-size:10px;
    color:#666;
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
                    {{ $invoice->number }}

                </td>


                {{-- Mentions légales --}}
                <td width="55%" valign="top" style="line-height:1.5;">

                    <strong style="color:#0B1220;">
                        Mentions légales
                    </strong>

                    <br>

                    {{ $invoice->vat_notice }}

                    <br>
                    Paiement exigible avant le {{ $invoice->due_date->format('d/m/Y') }}.
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
