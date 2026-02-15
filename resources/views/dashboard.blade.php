<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion de Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-slate-200 px-6 py-4 flex justify-between items-center shadow-sm">
            <span class="text-xl font-black text-indigo-600">STOCK PRO</span>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="text-indigo-600 font-bold">Dashboard</a>
                <a href="{{ route('stock.index') }}" class="text-slate-500 hover:text-indigo-600">Mouvements</a>
            </div>
        </nav>

        <div class="py-12 max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-slate-800 mb-8">Statistiques Globales</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Produits Référencés</p>
                    <p class="text-4xl font-black text-slate-900 mt-2">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Total en Stock</p>
                    <p class="text-4xl font-black text-indigo-600 mt-2">{{ $totalItems }}</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 border-b-4 border-b-red-500">
                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest text-red-400">Alertes Rupture</p>
                    <p class="text-4xl font-black text-red-600 mt-2">{{ $lowStock }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>