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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_id')->constrained();
            $table->foreignId('thematique_id')->constrained();
            $table->text('contenu');
            $table->text('description')->nullable();
            $table->foreignId('parent_post_id')->nullable()->constrained('posts');
            $table->enum('typePost',['Question','Reponse']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
