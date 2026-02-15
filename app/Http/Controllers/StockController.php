<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Movement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function dashboard() {
        return view('dashboard', [
            'totalProducts' => Product::count(),
            'totalItems'    => Product::sum('stock_quantity'),
            'lowStock'      => Product::where('stock_quantity', '<', 5)->count(),
        ]);
    }

    public function index()
    {
        $products = \App\Models\Product::all(); 
        $movements = \App\Models\Movement::with('product')->latest()->get();
        
        $stats = [
            'entrees' => \App\Models\Movement::where('type', 'entree')->sum('quantity'),
            'sorties' => \App\Models\Movement::where('type', 'sortie')->sum('quantity'),
        ];

        return view('stock.index', compact('products', 'movements', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:entree,sortie',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if ($request->type === 'sortie' && $product->stock_quantity < $request->quantity) {
            return back()->with('error', 'Stock insuffisant !');
        }

        Movement::create($request->all());

        if ($request->type === 'entree') {
            $product->increment('stock_quantity', $request->quantity);
        } else {
            $product->decrement('stock_quantity', $request->quantity);
        }

        return redirect()->route('stock.index')->with('success', 'Mouvement enregistré !');
    }

    public function createProduct()
    {
        return view('stock.create-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $product = new \App\Models\Product();
        $product->name = $request->name;
        $product->stock_quantity = $request->stock_quantity;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
            $product->image_url = '/storage/' . $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('products/videos', 'public');
            $product->video_url = '/storage/' . $videoPath;
        }

        $product->save();

        return redirect()->route('stock.index')->with('success', 'Produit enregistré avec succès !');
    }

    /**
     * MÉTHODE AJOUTÉE POUR LE PDF
     * Cette méthode permet de ne plus avoir l'erreur "Route [stock.pdf] not defined"
     */
    public function generatePDF()
    {
        $movements = \App\Models\Movement::with('product')->latest()->get();
        
        // Pour l'instant, on affiche une confirmation simple.
        // Si tu installes Barryvdh/DomPDF plus tard, on pourra générer un vrai fichier.
        return "Génération du PDF pour " . $movements->count() . " mouvements en cours de préparation...";
    }
}