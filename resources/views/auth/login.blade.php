<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Brina Oyas</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('/images/unnamed.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .login-card {
            background: rgba(41, 1, 1, 0.9); /* Fond blanc semi-transparent */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2); /* Ombre plus prononcée */
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 1.8em;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
            background-color: #f9f9f9;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .register-link {
            margin-top: 25px;
            font-size: 0.95em;
            color: #666;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="login-card">
   
{{-- 1. On indique que cette page utilise le moule app.blade.php --}}
@extends('layouts.app')

{{-- 2. On définit le titre de l'onglet --}}
@section('title', 'Connexion')

{{-- 3. On insère le contenu spécifique à la connexion --}}
@section('content')
    <h2>Connexion Brina Oyas</h2>

    <form method="POST" action="{{ route('login') }}" autocomplete="off">
        @csrf

        <div class="form-group">
            <label for="email">Adresse Email</label>
            {{-- Le champ est vide par défaut comme tu l'as demandé --}}
            <input type="email" id="email" name="email" required value="" placeholder="Entrez votre email" autocomplete="off">
            
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder="Entrez votre mot de passe">
            
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        {{-- Voici le bloc des deux boutons côte à côte --}}
        <div class="button-group">
            <button type="submit" class="btn btn-primary">Se connecter</button>
            <a href="{{ url('/') }}" class="btn btn-secondary">Retour</a>
        </div>
    </form>

    <div class="register-link">
        Pas encore de compte ? <a href="{{ route('register') }}">Inscrivez-vous ici</a>
    </div>
@endsection

</body>
</html>