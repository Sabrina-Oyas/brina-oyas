<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * C'est essentiel pour que Product::create() et $product->update() fonctionnent.
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'stock_min',
        'category_id',
    ];

  

// --- Tes relations ---
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    public function getDailyVelocity()
{
    $recentSales = \App\Models\Movement::where('product_id', $this->id)
        ->where('type', 'sortie')
        ->where('created_at', '>=', now()->subDays(30))
        ->sum('quantity');
    return round($recentSales / 30, 2);
 }
    /**
     * Un "Accessor" pour vérifier si le produit est en alerte de stock.
     * Utilisation : $product->is_low_stock (retourne true ou false)
     */
    // app/Http/Controllers/ProductController.php

// Dans app/Models/Product.php

// app/Http/Controllers/ProductController.php


// Dans app/Models/Product.php
public function getPredictedDaysRemaining()
{
    // On regarde les sorties des 30 derniers jours
    $recentSales = \App\Models\Movement::where('product_id', $this->id)
        ->where('type', 'sortie')
        ->where('created_at', '>=', now()->subDays(30))
        ->sum('quantity');

    if ($recentSales <= 0) return null;

    $dailyVelocity = $recentSales / 30;
    return floor($this->stock_quantity / $dailyVelocity);
}

    public function getIsLowStockAttribute()
    {
        // On considère qu'un produit est en alerte si :
        // 1. Le stock actuel est inférieur ou égal au stock minimum
        // OU
        // 2. Les prédictions indiquent une rupture dans les 7 prochains jours
        $predictedDays = $this->getPredictedDaysRemaining();
        return ($this->stock_quantity <= $this->stock_min) || ($predictedDays !== null && $predictedDays <= 7);
    }
}