<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Inscription Produit - Pro</title>
</head>
<body class="bg-slate-900 text-white p-12">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-black uppercase tracking-tighter">Nouveau Produit</h1>
            <a href="{{ route('stock.index') }}" class="text-slate-400 hover:text-white transition text-sm font-bold">ANNULER</a>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white text-slate-900 p-10 rounded-3xl shadow-2xl space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Nom du Produit</label>
                    <input type="text" name="name" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 font-bold focus:border-indigo-500 outline-none transition" placeholder="Ex: iPhone 15 Pro">
                </div>
                <div>
                    <label class="block text-xs font-black uppercase text-slate-400 mb-2">Stock Initial</label>
                    <input type="number" name="stock_quantity" required class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl p-4 font-bold focus:border-indigo-500 outline-none transition" placeholder="0">
                </div>
            </div>

            <div class="space-y-4">
                <div class="border-2 border-dashed border-slate-200 p-6 rounded-2xl hover:border-indigo-500 transition cursor-pointer relative">
                    <label class="block text-center cursor-pointer">
                        <span class="text-sm font-bold text-slate-600">📸 Ajouter une image produit</span>
                        <input type="file" name="image" class="hidden" accept="image/*">
                    </label>
                </div>

                <div class="border-2 border-dashed border-slate-200 p-6 rounded-2xl hover:border-indigo-500 transition cursor-pointer relative">
                    <label class="block text-center cursor-pointer">
                        <span class="text-sm font-bold text-slate-600">🎥 Ajouter une vidéo démo</span>
                        <input type="file" name="video" class="hidden" accept="video/*">
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-black text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-indigo-200 uppercase tracking-widest">
                Enregistrer dans la Base de Données
            </button>
        </form>
    </div>
</body>
</html>