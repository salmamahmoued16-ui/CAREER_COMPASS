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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
           $table->string('age');
$table->string('school_university');
$table->string('study_year');
$table->string('favorite_activity');
$table->string('interested_fields');
$table->string('current_need');
$table->boolean('join_workshop');
$table->string('commitment_level');
$table->string('career_goal');
$table->string('biggest_challenge');
$table->boolean('career_awareness');
$table->string('work_preference');

$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
