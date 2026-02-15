<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('stock_quantity')->default(0);
            $table->text('description')->nullable();
            $table->decimal('prix', 8, 2); // ex: 150.50
            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            // Lien avec la catégorie
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('products');
    }
};