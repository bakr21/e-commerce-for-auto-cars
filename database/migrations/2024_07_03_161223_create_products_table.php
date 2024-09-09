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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
            $table->string('name');
            $table->string('slug');
            $table->text('short_description');
            $table->longText('description');
            $table->decimal('price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->unsignedInteger('qty');
            $table->decimal('tax', 5, 2);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('trend')->default(0);
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->text('meta_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
