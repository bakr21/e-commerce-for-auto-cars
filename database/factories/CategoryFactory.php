<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, // اسم تصنيف عشوائي
            'slug' => $this->faker->slug, // Slug عشوائي من اسم التصنيف
            'description' => $this->faker->sentence, // وصف عشوائي للتصنيف
            'image' => $this->faker->imageUrl(640, 480, 'categories'), // صورة عشوائية للتصنيف
            'is_showing' => $this->faker->boolean, // قيمة عشوائية True/False
            'is_popular' => $this->faker->boolean, // قيمة عشوائية True/False
            'meta_title' => $this->faker->sentence, // عنوان ميتا عشوائي
            'meta_description' => $this->faker->paragraph, // وصف ميتا عشوائي
            'meta_keywords' => $this->faker->words(5, true), // كلمات مفتاحية عشوائية
        ];
    }
}
