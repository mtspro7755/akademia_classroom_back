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
        Schema::create('activite_ressources', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['lien', 'pdf'])->default('lien');
            $table->foreignId('ressource_id')->constrained();
            $table->foreignId('activite_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_ressources');
    }
};
