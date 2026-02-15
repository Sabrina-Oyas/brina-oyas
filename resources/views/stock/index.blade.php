<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion de Stock Pro - BDD Direct</title>
</head>
<body class="bg-slate-100 p-4 md:p-8 font-sans">

    <div class="max-w-6xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('stock.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour au Stock
            </a>
        </div>
        
        <div class="bg-slate-900 rounded-3xl shadow-2xl p-8 mb-10 border border-slate-800 transition-all hover:shadow-indigo-500/10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter">Inscription Produit</h2>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Enregistrement direct en base de données</p>
                </div>
                <div class="hidden md:block bg-indigo-500/10 border border-indigo-500/20 px-4 py-2 rounded-xl text-indigo-400 text-[10px] font-black uppercase">
                    Admin Mode Active
                </div>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @csrf
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Nom de l'article</label>
                    <input type="text" name="name" required class="w-full bg-slate-800 border-none rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="Ex: iPhone 15 Pro Max">
                </div>
                
                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Quantité Initiale</label>
                    <input type="number" name="stock_quantity" required class="w-full bg-slate-800 border-none rounded-2xl p-4 text-white font-bold focus:ring-2 focus:ring-indigo-500 outline-none transition" placeholder="0">
                </div>

                <div class="col-span-1">
                    <label class="block text-[10px] font-black uppercase text-slate-500 mb-2 tracking-widest">Image ou Vidéo</label>
                    <div class="relative group">
                        <input type="file" name="media" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full bg-slate-800 border-2 border-dashed border-slate-700 rounded-2xl p-4 text-center group-hover:border-indigo-500 transition">
                            <span class="text-xs font-bold text-slate-500">Choisir un fichier</span>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all uppercase text-sm tracking-widest shadow-xl shadow-indigo-500/20">
                        Publier l'article dans le catalogue
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-10 border border-white">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="bg-slate-100 p-8 flex flex-col justify-center items-center relative min-h-[300px]">
                    <div id="product-preview" class="text-center">
                        <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-4 mx-auto">
                            <span class="text-2xl text-slate-400">?</span>
                        </div>
                        <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">En attente de sélection</p>
                    </div>
                </div>

                <div class="p-10">
                    <h2 class="text-xl font-black mb-6 text-slate-800 uppercase tracking-tighter">Mouvement de Stock</h2>
                    <form action="{{ route('stock.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Sélectionner l'article</label>
                            <select name="product_id" id="product_select" class="w-full bg-slate-50 border-none rounded-xl p-4 font-bold focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                                <option value="">--- Choisir un produit ---</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            data-image="{{ $product->image_url }}" 
                                            data-video="{{ $product->video_url }}" 
                                            data-stock="{{ $product->quantity }}"> {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Action</label>
                                <select name="type" class="w-full bg-slate-50 border-none rounded-xl p-4 font-bold text-indigo-600">
                                    <option value="entree">ENTRÉE (+)</option>
                                    <option value="sortie">SORTIE (-)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Quantité</label>
                                <input type="number" name="quantity" min="1" required class="w-full bg-slate-50 border-none rounded-xl p-4 font-bold" placeholder="0">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-slate-900 hover:bg-black text-white font-black py-4 rounded-xl transition-all shadow-lg">
                            VALIDER L'OPÉRATION
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-indigo-600 p-8 rounded-3xl shadow-lg shadow-indigo-200">
                <p class="text-[10px] font-black uppercase text-indigo-200 tracking-widest mb-2">Volume Global Entrées</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-white">{{ $movements->where('type', 'entree')->sum('quantity') }}</p>
                    <span class="text-indigo-200 font-bold">unités</span>
                </div>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-200">
                <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-2">Volume Global Sorties</p>
                <div class="flex items-baseline gap-2">
                    <p class="text-4xl font-black text-rose-500">{{ $movements->where('type', 'sortie')->sum('quantity') }}</p>
                    <span class="text-slate-400 font-bold">unités</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-black text-slate-800 uppercase tracking-widest text-sm">Journal des Flux Récents</h3>
                <a href="{{ route('stock.pdf') }}" class="bg-rose-500 hover:bg-rose-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-rose-100 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Générer PDF
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">
                            <th class="px-8 py-5">Article</th>
                            <th class="px-8 py-5 text-center">Nature</th>
                            <th class="px-8 py-5 text-center">Quantité</th>
                            <th class="px-8 py-5 text-right">Date de flux</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($movements as $m)
                        <tr class="hover:bg-slate-50/80 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 group-hover:scale-105 transition-transform">
                                        @if($m->product->image_url)
                                            <img src="{{ asset('storage/' . $m->product->image_url) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-black text-slate-300">N/A</div>
                                        @endif
                                    </div>
                                    <span class="font-bold text-slate-700">{{ $m->product->name }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-center">
                                <span class="px-4 py-1.5 rounded-lg text-[9px] font-black tracking-widest uppercase {{ $m->type == 'entree' ? 'bg-emerald-100 text-emerald-600 border border-emerald-200' : 'bg-rose-100 text-rose-600 border border-rose-200' }}">
                                    {{ $m->type }}
                                </span>
                            </td>
                            <td class="px-8 py-5 text-center font-mono font-black text-slate-800 text-lg">
                                {{ $m->quantity }}
                            </td>
                            <td class="px-8 py-5 text-right">
                                <p class="text-slate-800 font-bold text-xs">{{ $m->created_at->format('d/m/Y') }}</p>
                                <p class="text-slate-400 text-[10px] font-medium">{{ $m->created_at->format('H:i') }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('product_select').addEventListener('change', function() {
            const option = this.options[this.selectedIndex];
            const preview = document.getElementById('product-preview');
            const img = option.getAttribute('data-image');
            const vid = option.getAttribute('data-video');
            const stock = option.getAttribute('data-stock');

            if (this.value === "") {
                preview.innerHTML = `
                    <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <span class="text-2xl text-slate-400">?</span>
                    </div>
                    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">En attente de sélection</p>`;
                return;
            }

            preview.innerHTML = '<div class="animate-pulse space-y-4 text-center"><div class="bg-slate-300 h-48 w-64 rounded-2xl mx-auto"></div><div class="h-4 bg-slate-300 w-1/2 mx-auto rounded-full"></div></div>';

            setTimeout(() => {
                preview.innerHTML = '';
                if (vid && vid !== "") {
                    preview.innerHTML += `<video src="/storage/${vid}" autoplay muted loop class="rounded-2xl shadow-2xl w-72 mb-4 mx-auto border-4 border-white"></video>`;
                } else if (img && img !== "") {
                    preview.innerHTML += `<img src="/storage/${img}" class="rounded-2xl shadow-2xl w-72 mb-4 mx-auto border-4 border-white object-cover aspect-square">`;
                } else {
                    preview.innerHTML += `<div class="w-24 h-24 bg-indigo-500 rounded-2xl flex items-center justify-center mb-4 mx-auto shadow-xl shadow-indigo-200 text-white font-black text-2xl">${option.text.trim().charAt(0)}</div>`;
                }
                preview.innerHTML += `<h4 class="font-black text-xl text-slate-800 uppercase tracking-tighter">${option.text}</h4>`;
                preview.innerHTML += `<p class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full inline-block text-[10px] font-black mt-2">STOCK ACTUEL : ${stock}</p>`;
            }, 300);
        });
    </script>
</body>
</html>