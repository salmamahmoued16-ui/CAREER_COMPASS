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
    Schema::create('career_paths', function (Blueprint $table) {
        $table->id();

        $table->string('title');
        $table->text('description');

        $table->integer('salary')->nullable();
        $table->integer('growth')->nullable();

        $table->string('duration')->nullable();
        $table->string('work_type')->nullable();

        $table->string('image')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_paths');
    }
};
