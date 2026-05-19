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
        Schema::table('livrables', function (Blueprint $table) {
            $table->dropForeign(['activite_id']);
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livrables', function (Blueprint $table) {
            $table->dropForeign(['activite_id']);
            $table->foreign('activite_id')->references('id')->on('activites');
        });
    }
};
