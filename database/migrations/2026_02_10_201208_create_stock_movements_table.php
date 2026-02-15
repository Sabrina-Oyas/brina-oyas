<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cette table enregistre l'historique détaillé des flux (Entrées/Sorties)
     * conformément au point 3.4 du cahier des charges de brina-oyas.
     */
    public function up(): void
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            
            // Relation avec le produit [cite: 54]
            $table->foreignId('product_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Type de mouvement : Entrée ou Sortie [cite: 50, 55]
            // Entrée (achat, retour, correction) [cite: 51]
            // Sortie (vente, perte, casse, expiration) [cite: 52]
            $table->enum('type', ['entree', 'sortie']);

            // Quantité concernée par le mouvement [cite: 56]
            $table->integer('quantity');

            // Date du mouvement [cite: 57]
            $table->dateTime('movement_date');

            // Utilisateur ayant effectué l'opération 
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Motif du mouvement (ex: Vente, Casse, Achat fournisseur) [cite: 59]
            $table->string('reason');

            // Pour l'historique et la traçabilité [cite: 60]
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};