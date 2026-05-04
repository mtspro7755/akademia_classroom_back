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
        Schema::table('penalites', function (Blueprint $table) {
            $table->enum('type_enum', ['activite', 'quete'])->after('penalite');
            $table->string('justificatif')->nullable()->after('type_enum'); // Chemin vers le fichier [pdf]

            $table->foreignId('livrable_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null')
                ->after('apprenant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penalites', function (Blueprint $table) {
            $table->dropForeign(['livrable_id']);
            $table->dropColumn(['type_enum', 'justificatif', 'livrable_id']);
        });
    }
};
