<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {

        if (Schema::hasTable('livrable_par_question')) {
            if (!Schema::hasTable('livrable_par_questions')) {
                Schema::rename('livrable_par_question', 'livrable_par_questions');
            } else {
                Schema::dropIfExists('livrable_par_question');
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('livrable_par_questions') && !Schema::hasTable('livrable_par_question')) {
            Schema::rename('livrable_par_questions', 'livrable_par_question');
        }
    }
};
