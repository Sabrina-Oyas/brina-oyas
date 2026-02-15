<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit | Brina-Oyas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans">

@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<div class="max-w-2xl mx-auto mt-10 p-8 bg-white rounded-3xl shadow-lg border border-slate-100">
    <h2 class="text-2xl font-black mb-6">Modifier l'article : {{ $product->name }}</h2>
    
    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block font-bold mb-1">Nom de l'article</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full p-3 bg-slate-50 border rounded-xl">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-bold mb-1">Stock</label>
                <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="w-full p-3 bg-slate-50 border rounded-xl">
            </div>
            <div>
                <label class="block font-bold mb-1">Prix</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full p-3 bg-slate-50 border rounded-xl">
            </div>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition-all">
            Enregistrer les modifications
        </button>
    </form>
</div>
@endsection 

</body>
</html>