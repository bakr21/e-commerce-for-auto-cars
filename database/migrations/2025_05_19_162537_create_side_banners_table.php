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
        Schema::create('side_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->string('subtitle_en');
            $table->string('subtitle_ar');
            $table->string('button_text_en');
            $table->string('button_text_ar');
            $table->string('button_link')->nullable();
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->integer('position')->default(1); // 1 for top, 2 for bottom
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('side_banners');
    }
};
