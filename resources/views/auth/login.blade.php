<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Northframe Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen flex flex-col bg-northframe">

    <div class="flex flex-col items-center justify-center min-h-screen px-3 py-3">
        <form method="POST" action="{{ route('login.post') }}"
            class="overflow-visible w-full max-w-[500px] rounded-[12px] bg-surface shadow-lg px-[20px] md:px-[34px] py-[24px] border border-primary/5">
            @csrf
            <div class="flex justify-center mb-6">
                <img src="{{ asset('logos/logo_cadre.svg') }}" alt="Northframe" class="h-[200px]">
            </div>
            <div class="mb-8 text-center">
                <h2 class="text-h2 text-primary">
                    Connexion
                </h2>

                <p class="text-body text-secondary mt-1">
                    Accédez à votre espace d'administration.
                </p>
            </div>

            <div class="flex flex-col gap-5">

                <div class="flex flex-col gap-[6px]">
                    <label class="text-label text-secondary">
                        Email <span class="text-red-500">*</span>
                    </label>

                    <input name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary border border-transparent focus:border-brand outline-none transition"
                        placeholder="Entrez votre email" required>

                    @error('email')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-[6px]">
                    <label class="text-label text-secondary">
                        Mot de passe <span class="text-red-500">*</span>
                    </label>

                    <input name="password" type="password" autocomplete="current-password"
                        class="block w-full h-[48px] rounded-[10px] bg-dark px-3 text-secondary border border-transparent focus:border-brand outline-none transition"
                        placeholder="Entrez votre mot de passe" required>

                    @error('password')
                        <p class="text-red-500 text-sm">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit"
                    class="h-[48px] rounded-[10px] bg-brand text-white font-medium hover:opacity-90 transition">
                    Se connecter
                </button>

            </div>
        </form>
    </div>

</body>

</html>
