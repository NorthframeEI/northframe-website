```html
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Votre facture acquittée {{ $invoice->number }} - NorthFrame</title>
</head>

<body
    style="margin:0;padding:0;background:#f5f7fa;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding:40px 20px;">

                <table role="presentation" width="600" cellspacing="0" cellpadding="0"
                    style="
                    max-width:600px;
                    width:100%;
                    background:#ffffff;
                    border-radius:16px;
                    overflow:hidden;
                    border:1px solid #e5e7eb;
                ">

                    {{-- HEADER --}}
                    <tr>
                        <td style="padding:40px 32px;background:#111827;text-align:center;">

                            <img src="{{ $message->embed(public_path('logos/logo_email_header.svg')) }}"
                                alt="NorthFrame" style="display:block;margin:0 auto;max-width:220px;height:auto;">

                            <div style="width:60px;height:2px;background:#3b82f6;margin:24px auto;"></div>

                            <p
                                style="
                                margin:0;
                                color:#94a3b8;
                                font-size:12px;
                                letter-spacing:2px;
                                text-transform:uppercase;
                            ">
                                Facture acquittée
                            </p>

                            <h1
                                style="
                                margin:12px 0 0;
                                color:#ffffff;
                                font-size:28px;
                                line-height:1.3;
                                font-weight:700;
                            ">
                                Votre facture acquittée est disponible
                            </h1>

                        </td>
                    </tr>


                    {{-- CONTENT --}}
                    <tr>
                        <td style="padding:32px;">

                            <p style="margin:0 0 20px;color:#334155;line-height:1.7;">
                                Bonjour
                                <strong>{{ $invoice->customer->contact_name }}</strong>,
                            </p>

                            <p style="color:#334155;line-height:1.7;">
                                Nous vous transmettons ci-joint votre facture acquittée
                                <strong>{{ $invoice->number }}</strong>,
                                attestant du règlement intégral des sommes dues.
                            </p>

                            <p style="color:#334155;line-height:1.7;">
                                Ce document constitue votre justificatif de paiement. Aucun règlement complémentaire
                                n'est attendu concernant cette facture.
                            </p>


                            {{-- RESUME --}}
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="
                                margin-top:30px;
                                background:#f8fafc;
                                border:1px solid #e2e8f0;
                                border-radius:12px;
                            ">

                                <tr>
                                    <td style="padding:20px;">

                                        <strong style="color:#111827;">
                                            Informations de la facture
                                        </strong>

                                        <br><br>

                                        <span style="color:#64748b;">
                                            Numéro :
                                        </span>

                                        <strong>
                                            {{ $invoice->number }}
                                        </strong>

                                        <br>

                                        <span style="color:#64748b;">
                                            Montant réglé :
                                        </span>

                                        <strong>
                                            {{ number_format($invoice->paid_amount, 2, ',', ' ') }} €
                                        </strong>

                                        <br>

                                        <span style="color:#64748b;">
                                            Date de règlement :
                                        </span>

                                        <strong>
                                            {{ $invoice->payments->last()->paid_at->format('d/m/Y') }}
                                        </strong>

                                    </td>
                                </tr>

                            </table>


                            <p
                                style="
                                margin-top:30px;
                                color:#334155;
                                line-height:1.7;
                            ">
                                La facture acquittée est disponible en pièce jointe au format PDF.
                            </p>


                            <p
                                style="
                                color:#334155;
                                line-height:1.7;
                            ">
                                Nous vous remercions pour votre confiance et restons à votre disposition pour toute
                                information complémentaire.
                            </p>


                        </td>
                    </tr>


                    {{-- FOOTER --}}
                    <tr>
                        <td
                            style="
                            padding:24px 32px;
                            background:#f8fafc;
                            border-top:1px solid #e5e7eb;
                            color:#64748b;
                            font-size:13px;
                            line-height:1.6;
                        ">

                            <strong style="color:#111827;">
                                NorthFrame
                            </strong>

                            <br>

                            112 Rue de Cambrai<br>
                            62000 Arras

                            <br><br>

                            contact@northframe.fr

                            <br><br>

                            Cet email contient un document confidentiel destiné à son destinataire.

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
```
