<div style="max-width:800px;margin:auto;font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#333;">

    @php
        $path = public_path('logos/logo_facture.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp

    {{-- HEADER --}}
    <table width="100%" style="border-collapse:collapse;">
        <div
            style="
    position:absolute;
    top:80px;
    left:320px;
    border:3px solid #16a34a;
    color:#16a34a;
    padding:10px 25px;
    font-size:26px;
    font-weight:bold;
    transform:rotate(-12deg);
    letter-spacing:3px;
">
            ACQUITTÉE
        </div>
        <tr>

            <td style="width:50%;vertical-align:top;">
                <img src="{{ $base64 }}" style="width:120px;margin-bottom:15px;">


            </td>

            <td style="width:50%;text-align:right;vertical-align:top;">

                <h1 style="margin:0;font-size:38px;color:#0B1220;">
                    Facture acquittée
                </h1>

                <div style="font-size:18px;font-weight:bold;margin-top:8px;">
                    {{ $invoice->number }}
                </div>

                <div style="margin-top:20px;line-height:1.8;">

                    <strong>Date d'émission :</strong>
                    {{ $invoice->issued_at->format('d/m/Y') }}
                    <br>

                    <strong>Date de règlement :</strong>
                    @if ($invoice->payments->isNotEmpty())
                        {{ $invoice->payments->last()->paid_at->format('d/m/Y') }}
                    @endif

                </div>

            </td>

        </tr>

        <tr>

            <td>
                <div style="line-height:1.7;">
                    <strong style="font-size:20px;color:#0B1220;">NorthFrame</strong><br>

                    112 Rue de Cambrai<br>
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
    <div
        style="
    margin-top:20px;
    padding:10px;
    border:1px solid #16a34a;
    background:#f0fdf4;
    color:#166534;
">

        <strong>
            Facture acquittée
        </strong>

        <br>

        Cette facture a été réglée intégralement.

        <br>
        Montant réglé :
        {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
        <br>
        Date du dernier règlement :
        @if ($invoice->payments->isNotEmpty())
            {{ $invoice->payments->last()->paid_at->format('d/m/Y') }}
        @endif

    </div>
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

    <table width="100%" style="border-collapse:collapse;margin-top:25px;page-break-inside:avoid;">

        <tr>

            {{-- CONDITIONS A GAUCHE --}}
            <td width="55%" valign="top" style="font-size:11px;line-height:1.6;">

                <strong style="color:#0B1220;">
                    Informations
                </strong>

                <br>

                • Document établi après règlement complet de la facture.

                <br>

                • Merci pour votre confiance.

            </td>


            {{-- TOTAL --}}
            <td width="45%" valign="top" align="right">


                <table style="border-collapse:collapse;min-width:280px;page-break-inside:avoid;">

                    <tr>
                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Total facture</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">
                            <strong>
                                {{ number_format($invoice->total, 2, ',', ' ') }} €
                            </strong>
                        </td>
                    </tr>


                    <tr>
                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Montant réglé</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">
                            <strong>
                                {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
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
    height:100px;
    padding-top:10px;
    border-top:1px solid #DDD;
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

                    Référence de facture :
                    {{ $invoice->number }}

                </td>


                {{-- Mentions légales --}}
                <td width="55%" valign="top" style="line-height:1.5;">

                    <strong style="color:#0B1220;">
                        Mentions légales
                    </strong>

                    <br>

                    {{ $invoice->vat_notice }}

                    <br><br>

                    Cette facture a été réglée intégralement par le client.

                    <br>

                    Le présent document constitue une facture acquittée attestant du règlement complet
                    des sommes dues.

                    <br>

                    Aucun montant ne reste exigible au titre de cette facture.

                </td>

            </tr>

        </table>

    </div>
