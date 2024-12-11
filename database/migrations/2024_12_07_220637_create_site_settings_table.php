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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->string('site_image')->nullable(); 
            $table->string('map_link')->nullable(); 
            $table->string('phone_number')->nullable(); 
            $table->text('company_description')->nullable(); 
            $table->string('hotline')->nullable(); 
            $table->string('address')->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('facebook_link')->nullable(); 
            $table->string('whatsapp_number')->nullable();
            $table->string('twitter_link')->nullable(); 
            $table->string('linkedin_link')->nullable(); 
            $table->string('working_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
