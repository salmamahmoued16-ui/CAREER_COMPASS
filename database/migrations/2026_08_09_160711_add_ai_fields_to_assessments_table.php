<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->string('education')->nullable();
            $table->string('specialization')->nullable();
            $table->json('skills')->nullable();
            $table->string('certification')->nullable();
            $table->decimal('cgpa', 5, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn([
                'education',
                'specialization',
                'skills',
                'certification',
                'cgpa',
            ]);
        });
    }
};
