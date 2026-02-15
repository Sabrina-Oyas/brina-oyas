<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue - Brina Oyas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 p-6">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tighter uppercase">Catalogue Brina Oyas</h1>
                <p class="text-slate-500 text-sm font-medium">Gestion en temps réel des collections</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('dashboard') }}" class="bg-white border border-slate-200 text-slate-700 px-6 py-2 rounded-xl font-bold hover:shadow-sm transition">
                    Dashboard
                </a>
                <a href="{{ route('stock.index') }}" class="bg-slate-900 text-white px-6 py-2 rounded-xl font-bold hover:bg-indigo-600 transition shadow-lg">
                    <i class="fas fa-boxes mr-2"></i> Gérer le Stock
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200">
                    <h2 class="font-bold text-xl mb-6 text-slate-700 flex items-center">
                        <i class="fas fa-shopping-bag mr-2 text-indigo-500"></i> Articles en Rayon
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($products as $p)
                        <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-indigo-300 transition relative overflow-hidden">
                            
                            <div class="w-20 h-20 rounded-xl overflow-hidden mr-4 shadow-sm bg-white flex-shrink-0">
                                @if($p->image)
                                    <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                        <i class="fas fa-image text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow">
                                <h3 class="font-black {{ $p->stock_quantity < 5 ? 'text-red-600' : 'text-slate-800' }} uppercase text-sm mb-1">
                                    {{ $p->name }}
                                </h3>
                                
                                <div class="flex items-center justify-between">
                                    <p class="text-[11px] font-bold text-indigo-600 uppercase tracking-widest">
                                        Stock : {{ $p->stock_quantity }}
                                    </p>
                                    
                                    @if($p->stock_quantity < 5)
                                        <span class="text-[9px] bg-red-100 text-red-600 px-2 py-0.5 rounded-full font-black uppercase animate-pulse">
                                            Alerte
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="absolute left-0 top-0 h-full w-1 {{ $p->stock_quantity < 5 ? 'bg-red-500' : 'bg-indigo-500' }}"></div>
                        </div>
                        @endforeach
                    </div>

                    @if($products->isEmpty())
                        <div class="text-center py-10">
                            <i class="fas fa-box-open text-4xl text-slate-200 mb-3"></i>
                            <p class="text-slate-400 font-medium">Aucun produit dans le catalogue pour le moment.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-200 sticky top-6">
                    <h2 class="font-bold text-xl mb-4 text-slate-700 flex items-center">
                        <i class="fas fa-file-pdf mr-2 text-red-500"></i> Document PDF
                    </h2>
                    
                    <div class="rounded-2xl overflow-hidden border border-slate-100 bg-slate-100 shadow-inner" style="height: 550px;">
                        <embed 
                            src="{{ asset('documents/catalogue.pdf') }}#toolbar=0" 
                            type="application/pdf" 
                            width="100%" 
                            height="100%" 
                        />
                    </div>
                    
                    <a href="{{ asset('documents/catalogue.pdf') }}" download class="mt-6 flex items-center justify-center gap-2 w-full py-4 bg-red-50 text-red-600 rounded-2xl font-black hover:bg-red-100 transition border-2 border-transparent hover:border-red-200">
                        <i class="fas fa-cloud-download-alt"></i> TÉLÉCHARGER LE CATALOGUE
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>