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
        Schema::create('apprenant_quete', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_id')->constrained();
            $table->foreignId('quete_id')->constrained();
            $table->enum('statut',['EnCours','Termine']);
            $table->integer('dureeEffective')->nullable();
            $table->timestamp('dateSoumission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprenant_quete');
    }
};
