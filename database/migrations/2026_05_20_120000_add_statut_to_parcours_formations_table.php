<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parcours_formations', function (Blueprint $table) {
            $table->enum('statut', ['Actif', 'Inactif', 'Archivé'])->default('Actif')->after('type');
        });
    }

    public function down(): void
    {
        Schema::table('parcours_formations', function (Blueprint $table) {
            $table->dropColumn('statut');
        });
    }
};
