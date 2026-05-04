<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('livrables', function (Blueprint $table) {
            $table->string('dureeActivite')->nullable()->after('dureeEffectue');
            $table->boolean('estEnRetard')->default(false)->after('dureeActivite');
            $table->integer('minutesRetard')->default(0)->after('estEnRetard');
        });
    }

    public function down(): void
    {
        Schema::table('livrables', function (Blueprint $table) {
            $table->dropColumn(['dureeActivite', 'estEnRetard', 'minutesRetard']);
        });
    }
};
