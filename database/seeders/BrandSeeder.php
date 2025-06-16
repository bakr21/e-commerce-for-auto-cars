<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء 10 علامات تجارية واقعية لقطع غيار السيارات
        
        Brand::create([
            'name' => 'Bosch',
            'slug' => 'bosch',
            'status' => 1,
            'image' => 'brands/bosch.jpg'
        ]);

        Brand::create([
            'name' => 'NGK',
            'slug' => 'ngk',
            'status' => 1,
            'image' => 'brands/ngk.jpg'
        ]);

        Brand::create([
            'name' => 'Brembo',
            'slug' => 'brembo',
            'status' => 1,
            'image' => 'brands/brembo.jpg'
        ]);

        Brand::create([
            'name' => 'Mann Filter',
            'slug' => 'mann-filter',
            'status' => 1,
            'image' => 'brands/mann-filter.jpg'
        ]);

        Brand::create([
            'name' => 'Valeo',
            'slug' => 'valeo',
            'status' => 1,
            'image' => 'brands/valeo.jpg'
        ]);

        Brand::create([
            'name' => 'Mahle',
            'slug' => 'mahle',
            'status' => 1,
            'image' => 'brands/mahle.jpg'
        ]);

        Brand::create([
            'name' => 'Denso',
            'slug' => 'denso',
            'status' => 1,
            'image' => 'brands/denso.jpg'
        ]);

        Brand::create([
            'name' => 'Continental',
            'slug' => 'continental',
            'status' => 1,
            'image' => 'brands/continental.jpg'
        ]);

        Brand::create([
            'name' => 'Hella',
            'slug' => 'hella',
            'status' => 1,
            'image' => 'brands/hella.jpg'
        ]);

        Brand::create([
            'name' => 'Febi',
            'slug' => 'febi',
            'status' => 1,
            'image' => 'brands/febi.jpg'
        ]);
    }
}
