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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 10, 2); // Selon Akademia_classroom_uml.drawio (6)_2.jpg
            $table->string('devise')->default('XOF');
            $table->enum('moyenPaiement', ['OM', 'Wave']); // Adapté du schéma
            $table->string('telephone');
            $table->string('referenceTransaction')->unique();
            $table->enum('statut', ['en_attente', 'confirme', 'echoue', 'rembourse'])->default('en_attente');
            $table->dateTime('datePaiement')->nullable();

            $table->foreignId('apprenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('cohorte_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
