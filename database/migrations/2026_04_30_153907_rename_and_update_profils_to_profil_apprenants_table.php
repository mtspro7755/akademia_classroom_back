<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('profils', 'profil_apprenants');

        Schema::table('profil_apprenants', function (Blueprint $table) {

            $table->dropColumn(['typeProfil', 'niveauMinimal', 'niveauMaximal']);


            $table->text('aPropos')->nullable()->after('id');
            $table->string('niveauEtudes')->nullable();
            $table->string('profession')->nullable();
            $table->string('ville')->nullable();
            $table->string('adresse')->nullable();
            $table->string('photoProfil')->nullable();
            $table->string('photoCouverture')->nullable();
            $table->integer('totalLivrables')->default(0);
            $table->integer('totalRetards')->default(0);
            $table->foreignId('apprenant_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('profil_apprenants', function (Blueprint $table) {
            $table->dropColumn([
                'aPropos', 'niveauEtudes', 'profession', 'ville',
                'adresse', 'photoProfil', 'photoCouverture',
                'totalLivrables', 'totalRetards', 'apprenant_id'
            ]);

            $table->enum('typeProfil', ['Novice', 'Intermédiaire', 'Aguerri']);
            $table->integer('niveauMinimal');
            $table->integer('niveauMaximal');
        });

        Schema::rename('profil_apprenants', 'profils');
    }
};
