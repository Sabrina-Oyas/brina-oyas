<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
   public function index() {
    $products = Product::all();
    
    $alerts = $products->filter(function($product) {
        $days = $product->getPredictedDaysRemaining();
        // Alerte si le stock tombe à 0 dans moins de 7 jours OU si stock < seuil
        return ($days !== null && $days <= 7) || ($product->stock <= 5);
    });

    return view('dashboard', compact('alerts'));
}
}