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
                    DEVIS
                </h1>

                <div style="font-size:18px;font-weight:bold;margin-top:8px;">
                    {{ $quote->number }}
                </div>

                <div style="margin-top:20px;line-height:1.8;">

                    <strong>Date d'émission :</strong>
                    {{ $quote->issued_at->format('d/m/Y') }}
                    <br>

                    <strong>Valable jusqu'au :</strong>
                    {{ $quote->valid_until->format('d/m/Y') }}

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

                    @if ($quote->customer->company_name)
                        <strong>{{ $quote->customer->company_name }}</strong><br>
                    @endif

                    @if ($quote->customer->contact_name)
                        {{ $quote->customer->contact_name }}<br>
                    @endif

                    @if ($quote->customer->address)
                        {{ $quote->customer->address }}<br>
                    @endif

                    @if ($quote->customer->postal_code || $quote->customer->city)
                        {{ $quote->customer->postal_code }}
                        {{ $quote->customer->city }}<br>
                    @endif

                    @if ($quote->customer->email)
                        {{ $quote->customer->email }}<br>
                    @endif

                    @if ($quote->customer->phone)
                        {{ $quote->customer->phone }}<br>
                    @endif

                    @if ($quote->customer->siret)
                        SIRET : {{ $quote->customer->siret }}
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

        {{ $quote->subject }} pour
        <strong>{{ $quote->customer->company_name }}</strong>.

        <br>

        Suite à votre demande, veuillez trouver ci-dessous notre proposition commerciale.

    </div>

    @php
        $oneTimeItems = $quote->items->where('type', 'one_time');
        $recurringItems = $quote->items->where('type', 'recurring');
    @endphp

    {{-- PRESTATIONS --}}
    @if ($oneTimeItems->count())

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

                @foreach ($oneTimeItems as $item)
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

    @endif

    @if ($recurringItems->count())
        <div style="page-break-before:always;"></div>
        <h3 style="color:#0B1220;margin-top:30px;margin-bottom:10px;">
            Abonnements
        </h3>


        <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse;border:1px solid #DDD;">


            <thead>

                <tr style="background:#0B1220;color:#FFF;">

                    <th align="left">
                        Description
                    </th>

                    <th width="120">
                        Tarif
                    </th>

                    <th width="120">
                        Période
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach ($recurringItems as $item)
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


                        <td align="right" style="border:1px solid #DDD;">

                            {{ number_format($item->unit_price, 2, ',', ' ') }} €

                        </td>


                        <td align="center" style="border:1px solid #DDD;">

                            @if ($item->billing_period === 'monthly')
                                Mensuel
                            @elseif($item->billing_period === 'yearly')
                                Annuel
                            @endif

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    @endif

    {{-- RESUME BAS DE PAGE --}}

    <table width="100%" style="border-collapse:collapse;margin-top:25px;">

        <tr>

            {{-- CONDITIONS A GAUCHE --}}
            <td width="55%" valign="top" style="font-size:11px;line-height:1.6;">

                <strong style="color:#0B1220;">
                    Conditions
                </strong>

                <br>

                • Ce devis est valable jusqu'au {{ $quote->valid_until->format('d/m/Y') }}.

                <br>

                • Le démarrage du projet intervient après acceptation du devis.

                <br>

                • Les délais de réalisation sont donnés à titre indicatif.

                <br>

                • Les abonnements récurrents seront facturés selon la période indiquée.

            </td>


            {{-- TOTAL + ABONNEMENTS A DROITE --}}
            <td width="45%" valign="top" align="right">


                <table style="border-collapse:collapse;min-width:280px;">

                    <tr>

                        <td style="padding:12px;background:#0B1220;color:white;border:1px solid #0B1220;">
                            <strong>Total projet</strong>
                        </td>

                        <td align="right" style="padding:12px;border:1px solid #0B1220;font-size:18px;">

                            <strong>
                                {{ number_format($quote->total, 2, ',', ' ') }} €
                            </strong>

                        </td>

                    </tr>

                </table>


                @if ($recurringItems->count())

                    <table style="border-collapse:collapse;min-width:280px;margin-top:15px;">

                        <tr>

                            <td colspan="2" style="padding:10px;background:#F5F5F5;border:1px solid #DDD;">

                                <strong>
                                    Abonnements récurrents
                                </strong>

                            </td>

                        </tr>


                        @foreach ($recurringItems as $item)
                            <tr>

                                <td style="padding:8px;border:1px solid #DDD;font-size:12px;">

                                    {{ $item->designation }}

                                </td>


                                <td align="right"
                                    style="padding:8px;border:1px solid #DDD;font-size:12px;white-space:nowrap;">

                                    {{ number_format($item->unit_price, 2, ',', ' ') }} €

                                    @if ($item->billing_period === 'monthly')
                                        /mois
                                    @elseif($item->billing_period === 'yearly')
                                        /an
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </table>

                @endif


            </td>

        </tr>

    </table>

    <div style="clear:both;"></div>
    <div style="height:130px;"></div>
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

        <div style="border-top:1px solid #DDD;margin-bottom:10px;"></div>


        <br><br>

        <strong style="color:#0B1220;">
            Mentions légales
        </strong>

        <br>

        TVA non applicable, article 293 B du Code général des impôts.

        <br>

        En cas de retard de paiement, des pénalités pourront être appliquées conformément aux dispositions légales en
        vigueur.

        <br>

        Une indemnité forfaitaire de 40 € pour frais de recouvrement sera exigible conformément aux articles L441-10 et
        D441-5 du Code de commerce.

    </div>
