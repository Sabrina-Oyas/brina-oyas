<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// 1. Accueil : Redirige vers la page de connexion
Route::get('/', function () {
    return view('auth.login');
});

// 2. Toutes les routes protégées (nécessitent d'être connecté)
Route::middleware(['auth', 'verified'])->group(function () {

    // LE DASHBOARD (Appelle la fonction dashboard dans StockController)
    Route::get('/dashboard', [StockController::class, 'dashboard'])->name('dashboard');

    // LA GESTION DES STOCKS (Entrées/Sorties et Historique)
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
    Route::post('/stock/update-product/{id}', [StockController::class, 'updateProductName'])->name('product.update.name');
    Route::get('/stock/pdf', [StockController::class, 'generatePDF'])->name('stock.pdf');

    // LE CATALOGUE (Visualisation des produits)
    Route::get('/catalogue', [ProductController::class, 'index'])->name('catalogue.index');

    Route::get('/products/create', [StockController::class, 'createProduct'])->name('products.create');
    Route::post('/products/store', [StockController::class, 'storeProduct'])->name('products.store');

    // LES PRODUITS (Gestion complète : ajout, modification, suppression)
    // Note : resource crée automatiquement les routes index, store, update, destroy, etc.
    Route::resource('products', ProductController::class);

    // LE PROFIL UTILISATEUR
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Inclut les routes d'authentification par défaut (Login, Register, etc.)
require __DIR__.'/auth.php';