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
        Schema::create('quetes', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->enum('statut',['Actif','Inactif']);
            $table->date('dateDebut');
            $table->date('dateLimite');
            $table->integer('niveauDifficulte');
            $table->foreignId('parcours_formation_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quetes');
    }
};
