<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id, // اختيار تصنيف عشوائي
            'brand_id' => Brand::inRandomOrder()->first()->id, // اختيار علامة تجارية عشوائية
            'name' => $this->faker->word, // اسم المنتج عشوائي
            'slug' => $this->faker->slug, // Slug عشوائي
            'short_description' => $this->faker->sentence, // وصف قصير عشوائي
            'description' => $this->faker->paragraph, // وصف طويل عشوائي
            'price' => $this->faker->randomFloat(2, 10, 5000), // سعر عشوائي للمنتج
            'selling_price' => $this->faker->randomFloat(2, 10, 5000), // سعر البيع العشوائي
            'qty' => $this->faker->numberBetween(1, 100), // كمية عشوائية
            'minqty' => $this->faker->numberBetween(1, 10), // الحد الأدنى للكمية
            'tax' => $this->faker->randomFloat(2, 1, 20), // ضريبة عشوائية
            'status' => $this->faker->boolean, // حالة المنتج (نشط أو غير نشط)
            'trend' => $this->faker->boolean, // إذا كان المنتج شائعًا (عشوائي)
            'meta_title' => $this->faker->sentence, // عنوان ميتا عشوائي
            'meta_keywords' => $this->faker->words(5, true), // كلمات مفتاحية عشوائية
            'meta_description' => $this->faker->paragraph, // وصف ميتا عشوائي
        ];
    }
}

