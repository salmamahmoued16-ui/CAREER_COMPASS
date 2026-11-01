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
    Schema::table('roadmaps', function (Blueprint $table) {

        if (Schema::hasColumn('roadmaps', 'career_prediction_id')) {

            $table->dropForeign(['career_prediction_id']);
            $table->dropColumn('career_prediction_id');
        }

        if (!Schema::hasColumn('roadmaps', 'career_id')) {
            $table->foreignId('career_id')
                  ->nullable()
                  ->constrained('careers');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    
public function down(): void
{
    Schema::table('roadmaps', function (Blueprint $table) {
        $table->dropForeign(['career_id']);
        $table->dropColumn('career_id');

        $table->foreignId('career_prediction_id')->nullable();
    });
}

    
};
