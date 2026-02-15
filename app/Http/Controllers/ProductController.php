<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Afficher tous les produits
    public function index() {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:products',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $path = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'name' => $request->name,
            'stock_quantity' => $request->stock_quantity,
            'image' => $path
        ]);

        return back()->with('success', 'Produit ajouté au catalogue !');
    }

    // Supprimer un produit
    public function destroy($id) {
        $product = Product::findOrFail($id);
        if($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return back()->with('success', 'Produit supprimé.');
    }
}