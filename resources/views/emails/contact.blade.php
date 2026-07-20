<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Nouveau contact Northframe</title>
</head>

<body
    style="
    margin:0;
    padding:0;
    background:#f5f7fa;
    font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;
">

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

                    <!-- Header -->
                    <tr>
                        <td style=" padding:40px 32px; background:#111827; text-align:center; ">
                            <!-- Logo -->
                            <img src="{{ $message->embed(public_path('logos/logo_email_header.svg')) }}"
                                alt="NorthFrame" style="display:block;margin:0 auto;max-width:220px;height:auto;">
                            <!-- Séparateur -->
                            <div style=" width:60px; height:2px; background:#3b82f6; margin:24px auto; "></div>
                            <p
                                style=" margin:0; color:#94a3b8; font-size:12px; letter-spacing:2px; text-transform:uppercase; ">
                                Nouveau contact </p>
                            <h1
                                style=" margin:12px 0 0; color:#ffffff; font-size:28px; line-height:1.3; font-weight:700; ">
                                Nouveau message reçu </h1>
                            @if (env('APP_ENV') === 'local')
                                <p style="color:#ffffff">Mode développement</p>
                            @elseif(env('APP_ENV') === 'preprod')
                                <p style="color:#ffffff">Mode Preprod</p>
                            @endif
                        </td>

                    </tr>

                    <!-- Infos -->
                    <tr>
                        <td style="padding:32px;">

                            <table width="100%" cellspacing="0" cellpadding="0">

                                <tr>
                                    <td
                                        style="
                                    padding:12px 0;
                                    border-bottom:1px solid #f1f5f9;
                                ">
                                        <strong>Nom</strong><br>
                                        {{ $nom }}
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="
                                    padding:12px 0;
                                    border-bottom:1px solid #f1f5f9;
                                ">
                                        <strong>Email</strong><br>
                                        <a href="mailto:{{ $email }}"
                                            style="color:#2563eb;text-decoration:none;">
                                            {{ $email }}
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td
                                        style="
                                    padding:12px 0;
                                    border-bottom:1px solid #f1f5f9;
                                ">
                                        <strong>Entreprise</strong><br>
                                        {{ $entreprise }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding:12px 0; border-bottom:1px solid #f1f5f9;">
                                        <strong>Type de projet</strong><br>

                                        @if ($type_projet === 'vitrine')
                                            Site Vitrine
                                        @elseif($type_projet === 'landing')
                                            Landing Page
                                        @else
                                            {{ ucfirst($type_projet) }}
                                        @endif
                                    </td>
                                </tr>

                                @if ($template)
                                    <tr>
                                        <td
                                            style="
                                    padding:12px 0;
                                    border-bottom:1px solid #f1f5f9;
                                ">
                                            <strong>Template choisi</strong><br>
                                            {{ $template }}
                                        </td>
                                    </tr>
                                @endif

                            </table>

                            <!-- Message -->
                            <div style="
                            margin-top:32px;
                        ">
                                <h2
                                    style="
                                margin:0 0 16px;
                                font-size:18px;
                                color:#111827;
                            ">
                                    Description du projet
                                </h2>

                                <div
                                    style="
                                background:#f8fafc;
                                border:1px solid #e2e8f0;
                                border-radius:12px;
                                padding:20px;
                                color:#334155;
                                line-height:1.7;
                                white-space:pre-line;
                            ">
                                    {{ $contenuMessage }}
                                </div>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="
                        padding:24px 32px;
                        background:#f8fafc;
                        border-top:1px solid #e5e7eb;
                        color:#64748b;
                        font-size:13px;
                    ">
                            Message envoyé depuis le formulaire de contact Northframe.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
