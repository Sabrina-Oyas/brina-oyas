<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'type', 
        'quantity', 
        'movement_date', 
        'user_id', 
        'reason'
    ];

    // Relation inverse : un mouvement appartient à un produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}