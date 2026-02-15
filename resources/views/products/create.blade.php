<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit | Brina-Oyas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

   @extends('layouts.app')

@section('title', 'Ajouter un Produit')

@section('body-class', 'bg-slate-50 font-sans')

@section('content')
    <nav class="bg-indigo-900 text-white p-4 shadow-md fixed top-0 w-full z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-xl font-bold italic tracking-wider hover:text-indigo-300">BRINA-OYAS</a>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('products.index') }}" class="hover:text-indigo-300">Annuler</a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-rose-400 hover:text-rose-300 font-bold ml-4">
                        <i class="fas fa-power-off"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mx-auto pt-24 pb-10 px-4 flex justify-center">
        
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden w-full" style="max-width: 600px;">
            <div class="p-6 bg-emerald-500 border-b border-emerald-600 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-black text-white">Nouveau Produit</h2>
                    <p class="text-emerald-100 text-sm">Ajouter un article à l'inventaire</p>
                </div>
                <div class="bg-white/20 text-white px-3 py-1 rounded-lg text-xs font-bold uppercase">
                    Saisie
                </div>
            </div>

            <form action="{{ route('products.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-slate-700 font-bold mb-2">Désignation du produit</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Ex: Oya à planter Taille M"
                               class="w-full px-4 py-3 rounded-xl border @error('name') border-rose-500 @else border-slate-200 @enderror focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition">
                        @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-2">Catégorie</label>
                        <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition bg-white">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-2">Description (Optionnel)</label>
                        <textarea name="description" rows="3" placeholder="Détails techniques, matière..."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-slate-700 font-bold mb-2">Prix (FCFA)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required
                                   class="w-full px-4 py-3 rounded-xl border @error('price') border-rose-500 @else border-slate-200 @enderror focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition text-emerald-600 font-bold text-lg">
                        </div>

                        <div>
                            <label class="block text-slate-700 font-bold mb-2">Stock Initial</label>
                            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required
                                   class="w-full px-4 py-3 rounded-xl border @error('stock_quantity') border-rose-500 @else border-slate-200 @enderror focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition font-bold text-lg text-slate-700">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 font-bold mb-2">Seuil d'alerte minimum</label>
                        <input type="number" name="stock_min" value="{{ old('stock_min', 5) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none transition italic text-slate-500">
                        <p class="text-[10px] text-slate-400 mt-1 italic">Le produit apparaîtra en alerte sur le dashboard sous ce seuil.</p>
                    </div>
                </div>

                <div class="mt-10 flex space-x-4">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-4 rounded-xl font-black shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition transform active:scale-95">
                        <i class="fas fa-plus-circle mr-2"></i> Créer l'article
                    </button>
                    <a href="{{ route('products.index') }}" class="flex-1 bg-slate-100 text-slate-600 py-4 rounded-xl font-bold text-center hover:bg-slate-200 transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>

    </main>
@endsection

</body>
</html>