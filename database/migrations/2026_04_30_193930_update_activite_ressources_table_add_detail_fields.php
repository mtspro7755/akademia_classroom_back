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
        Schema::table('activite_ressources', function (Blueprint $table) {
            $table->string('titre')->after('type');
            $table->string('lienRessource')->nullable()->after('titre');
            $table->string('pdfRessource')->nullable()->after('lienRessource');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activite_ressources', function (Blueprint $table) {
            $table->dropColumn(['titre', 'lienRessource', 'pdfRessource']);
        });
    }
};
