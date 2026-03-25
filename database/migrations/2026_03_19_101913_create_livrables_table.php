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
        Schema::create('livrables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_id')->constrained();
            $table->foreignId('activite_id')->constrained();
            $table->string('lien')->nullable();
            $table->enum('typeLivrable',['Lien','Question']);
            $table->string('statutCorrection')->nullable();
            $table->timestamp('dateSoumission')->nullable();
            $table->integer('dureeEffectue')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrables');
    }
};
