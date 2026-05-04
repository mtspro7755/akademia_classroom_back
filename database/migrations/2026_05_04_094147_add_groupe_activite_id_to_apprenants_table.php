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
        if (!Schema::hasColumn('apprenants', 'groupe_activite_id')) {
            Schema::table('apprenants', function (Blueprint $table) {
                $table->foreignId('groupe_activite_id')
                    ->nullable()
                    ->after('statutCompte')
                    ->constrained('groupe_activites')
                    ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            $table->dropForeign(['groupe_activite_id']);
            $table->dropColumn('groupe_activite_id');
        });
    }
};
