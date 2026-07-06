<div style="max-width:800px;margin:auto;font-family:Arial;font-size:14px;color:#333;">

    {{-- HEADER TOP --}}
    <table width="100%" style="margin-bottom:25px;">
        <tr>

            {{-- LOGO + ENTREPRISE --}}
            <td style="width:50%; vertical-align:top;">

                @php
                    $path = public_path('logos/logo_facture.png');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp

                <img src="{{ $base64 }}" style="max-width:120px;margin-bottom:10px;">

                <div style="line-height:1.5;">
                    <strong>NorthFrame</strong><br>
                    12 rue Exemple<br>
                    62000 Arras<br>
                    contact@northframe.fr<br>
                    SIRET : 123 456 789 00012
                </div>

            </td>

            {{-- DEVIS INFO --}}
            <td style="width:50%; text-align:right; vertical-align:top;">

                <h1 style="margin:0; color:#0B1220;">
                    DEVIS {{ $quote->number }}
                </h1>

                <p style="margin:5px 0;">
                    <strong>Date :</strong>
                    {{ \Carbon\Carbon::parse($quote->issued_at)->locale('fr')->translatedFormat('d F Y') }}
                </p>

                <p style="margin:5px 0;">
                    <strong>Validité :</strong> {{ \Carbon\Carbon::parse($quote->valid_until)->locale('fr')->translatedFormat('d F Y') }}
                </p>

            </td>

        </tr>
    </table>

    {{-- CLIENT --}}
    <table width="100%" style="margin-bottom:30px;">
        <tr>

            <td style="width:50%;"></td>

            <td style="width:50%; text-align:right;">
                <div
                    style="display:inline-block; text-align:left; padding:10px; border:1px solid #eee; border-radius:5px;">

                    <strong>CLIENT</strong><br><br>

                    {{ $quote->customer->company_name }}<br>
                    {{ $quote->customer->contact_name }}<br>
                    {{ $quote->customer->address }}<br>
                    {{ $quote->customer->postal_code }} {{ $quote->customer->city }}<br>
                    {{ $quote->customer->email }}

                </div>
            </td>

        </tr>
    </table>

    {{-- TABLE --}}
    <table width="100%" border="1" cellpadding="8" cellspacing="0">

        <thead style="background:#f2f2f2;">
            <tr>
                <th>Description</th>
                <th>Quantité</th>
                <th>PU</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($quote->items as $item)
                <tr>
                    <td>{{ $item->designation }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }} €</td>
                    <td>{{ $item->total }} €</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{-- TOTAL --}}
    <div style="text-align:right;margin-top:20px;">
        <h2 style="color:#0B1220;">
            Total : {{ $quote->total }} €
        </h2>
    </div>

    {{-- MENTIONS --}}
    <div style="margin-top:40px;font-size:12px;color:#666;line-height:1.5;">

        <p>TVA non applicable, article 293 B du CGI</p>

        <p>En cas de retard de paiement, une pénalité de 10% pourra être appliquée.</p>

        <p>Indemnité forfaitaire pour frais de recouvrement : 40€</p>

    </div>

</div>
