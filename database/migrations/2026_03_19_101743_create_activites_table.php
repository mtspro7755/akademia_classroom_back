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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quete_id')->constrained();
            $table->string('titre');
            $table->text('description');
            $table->integer('duree');
            $table->string('statut');
            $table->integer('ordreAffichage');
            $table->enum('typeActivite',['Veille','Atelier']);
            $table->enum('typeLivrable',['Lien','Question']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
