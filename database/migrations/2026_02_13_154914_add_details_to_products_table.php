<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // On ajoute les colonnes nécessaires pour le Dashboard et la gestion
            $table->decimal('price', 10, 2)->default(0)->after('description');
            $table->integer('stock_quantity')->default(0)->after('stock');
            $table->integer('stock_min')->default(5)->after('stock_quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // On permet de revenir en arrière si besoin
            $table->dropColumn(['price', 'stock_quantity', 'stock_min']);
        });
    }
};