<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('activites')->update([
            'statut' => DB::raw("
                CASE
                    WHEN statut IN ('actif', 'On', 'active') THEN 'Publié'
                    WHEN statut IN ('inactif', 'termine', 'closed') THEN 'Archivé'
                    ELSE 'Brouillon'
                END
            ")
        ]);


        Schema::table('activites', function (Blueprint $table) {
            $table->enum('statut', ['Brouillon', 'Publié', 'Archivé'])
                ->default('Brouillon')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->string('statut')->default('Brouillon')->change();
        });
    }
};
