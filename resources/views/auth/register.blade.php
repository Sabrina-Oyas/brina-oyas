<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brina Oyas - @yield('title')</title>
    <style>
        body, html { margin: 0; padding: 0; min-height: 100vh; font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; }
        
        /* Navbar */
        .navbar { background: #333; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; font-weight: 500; }
        .navbar .brand { font-size: 1.5em; font-weight: bold; margin-left: 0; color: #28a745; }

        /* Background avec image pour Auth */
        .auth-bg { background: url('/images/unnamed.jpg') no-repeat center center fixed; background-size: cover; }
        
        .main-wrapper { display: flex; justify-content: center; align-items: center; min-height: 90vh; padding: 20px; }
        
        /* Carte pour les formulaires */
        .glass-card { background: rgba(255, 255, 255, 0.95); padding: 35px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        
        /* Conteneur large pour le Dashboard */
        .wide-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 1000px; }

        .btn { padding: 10px 20px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
    </style>
</head>
<body class="@yield('body-class')">

   @extends('layouts.app')

@section('title', 'Inscription')
@section('body-class', 'auth-bg') {{-- Appel de l'image de fond --}}

@section('content')
    <h2 style="text-align: center; color: #333;">Créer un compte</h2>

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf

        <div style="display: flex; gap: 10px;">
            <div class="form-group" style="flex: 1;">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required placeholder="Jean" autocomplete="off">
            </div>
            <div class="form-group" style="flex: 1;">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required placeholder="Dupont" autocomplete="off">
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email professionnel</label>
            {{-- On utilise new-password même sur l'email pour tromper le remplissage automatique --}}
            <input type="email" id="email" name="email" required 
                   placeholder="prenom.nom@brina.com" 
                   autocomplete="new-password"
                   onfocus="this.removeAttribute('readonly');" readonly>
            <div id="email-hint" class="hint"></div>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required placeholder="8 caractères min." autocomplete="new-password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <a href="{{ route('login') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la connexion
            </a>
        </div>
    </form>

    <script>
        const firstname = document.getElementById('firstname');
        const lastname = document.getElementById('lastname');
        const emailField = document.getElementById('email');
        const hint = document.getElementById('email-hint');

        function updateEmail() {
            let fn = firstname.value.toLowerCase().trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/\s+/g, '');
            let ln = lastname.value.toLowerCase().trim().normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/\s+/g, '');

            if (fn && ln) {
                let suggestion = `${fn}.${ln}@brina.com`;
                emailField.value = suggestion;
                hint.innerText = "Suggestion : " + suggestion;
            } else {
                emailField.value = "";
                hint.innerText = "";
            }
        }

        firstname.addEventListener('input', updateEmail);
        lastname.addEventListener('input', updateEmail);
    </script>
@endsection
@if ($errors->any())
    <div style="background: #fee2e2; color: #b91c1c; padding: 10px; margin-bottom: 20px; border-radius: 8px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>