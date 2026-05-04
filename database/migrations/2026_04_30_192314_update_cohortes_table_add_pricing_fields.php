<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cohortes', function (Blueprint $table) {
            $table->decimal('prix', 10, 2)->after('statut')->default(0.00);
            $table->string('devise')->after('prix')->default('XOF');
        });
    }

    public function down(): void
    {
        Schema::table('cohortes', function (Blueprint $table) {
            $table->dropColumn(['prix', 'devise']);
        });
    }
};
