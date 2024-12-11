<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // اسم العلامة التجارية عشوائي
            'slug' => $this->faker->slug, // Slug عشوائي
            'status' => $this->faker->boolean, // قيمة عشوائية True/False
            'image' => $this->faker->imageUrl(200, 200, 'business'), // صورة عشوائية للعلامة التجارية
        ];
    }
}
