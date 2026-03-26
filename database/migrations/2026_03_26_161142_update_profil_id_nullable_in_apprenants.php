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
        Schema::table('apprenants', function (Blueprint $table) {
            $table->dropForeign(['profil_id']);
            $table->foreignId('profil_id')->nullable()->change();
            $table->foreign('profil_id')->references('id')->on('profils')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            $table->dropForeign(['profil_id']);
            $table->foreignId('profil_id')->nullable(false)->change();
            $table->foreign('profil_id')->references('id')->on('profils');
        });
    }
};
