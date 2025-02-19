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
        Schema::create('question_themes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('title_size')->nullable();
            $table->string('title_color')->nullable();
            $table->string('title_align')->nullable();
            $table->string('title_font')->nullable();
            $table->unsignedInteger('text_size')->nullable();
            $table->string('text_color')->nullable();
            $table->string('text_align')->nullable();
            $table->string('text_font')->nullable();
            $table->string('image_position')->nullable();
            $table->string('image_size')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('container_color')->nullable();
            $table->string('container_shadow')->nullable();
            $table->string('border')->nullable();
            $table->jsonb('style')->nullable();
            $table->jsonb('script')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_themes');
    }
};
