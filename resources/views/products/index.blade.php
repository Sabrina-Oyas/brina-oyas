<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue & PDF - Brina Oyas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-50 p-6">
    <div class="max-w-7xl mx-auto">
        
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-black text-slate-800">Gestion de Stocks</h1>
            <div class="flex gap-4">
                <a href="{{ route('stock.index') }}" class="bg-indigo-600 text-white px-5 py-2 rounded-xl font-bold shadow-sm"><i class="fas fa-book-open mr-1"></i> Voir le Catalogue</a>
                <a href="/dashboard" class="bg-white border px-5 py-2 rounded-xl font-bold text-slate-600">Dashboard</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-7">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200">
                    <h2 class="font-bold text-xl mb-6 flex items-center">
                        <i class="fas fa-boxes mr-2 text-indigo-500"></i> Articles Disponibles
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($products as $product)
                        <div class="flex items-center p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" class="w-16 h-16 object-cover rounded-xl mr-4">
                            @else
                                <div class="w-16 h-16 bg-slate-200 rounded-xl mr-4 flex items-center justify-center text-slate-400"><i class="fas fa-image"></i></div>
                            @endif
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $product->name }}</h3>
                                <p class="text-xs font-bold text-indigo-600">Stock : {{ $product->stock_quantity }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 h-full">
                    <h2 class="font-bold text-xl mb-6 flex items-center">
                        <i class="fas fa-file-pdf mr-2 text-red-500"></i> Document PDF
                    </h2>
                    
                    <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-inner bg-slate-100" style="height: 600px;">
                        <embed 
                            src="{{ asset('documents/catalogue.pdf') }}" 
                            type="application/pdf" 
                            width="100%" 
                            height="100%" 
                        />
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ asset('documents/catalogue.pdf') }}" download class="flex items-center justify-center w-full py-3 bg-slate-800 text-white rounded-xl font-bold hover:bg-slate-700 transition">
                            <i class="fas fa-download mr-2"></i> Télécharger le PDF
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>