<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->enum('modaliteTravail', ['individuel', 'collectif'])
                ->default('individuel')
                ->after('typeLivrable');
        });
    }

    public function down(): void
    {
        Schema::table('activites', function (Blueprint $table) {
            $table->dropColumn('modaliteTravail');
        });
    }
};
