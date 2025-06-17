<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🚀 بدء إنشاء البيانات الأساسية...');

        // تشغيل السيدرز بالترتيب الصحيح
        $this->call([
            CountrySeeder::class,
            EgyptRegionSeeder::class,
            SiteSettingSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
        ]);

        // الحصول على مصر كدولة افتراضية
        $egypt = \App\Models\Country::where('code', 'EG')->first();

        // إنشاء مستخدم إداري
        \App\Models\User::factory()->create([
            'name' => 'مدير الموقع',
            'email' => 'admin@autoparts.com',
            'password' => bcrypt('123456789'),
            'type' => 1, // admin
            'status' => 1,
            'country_id' => $egypt->id,
            'email_verified_at' => now(),
        ]);

        // إنشاء مستخدم عادي
        \App\Models\User::factory()->create([
            'name' => 'أحمد محمد',
            'email' => 'user@autoparts.com',
            'password' => bcrypt('123456789'),
            'type' => 0, // user
            'status' => 1,
            'country_id' => $egypt->id,
            'email_verified_at' => now(),
        ]);

        $this->command->info('✅ تم إنشاء البيانات بنجاح!');
        $this->command->info('📊 الملخص:');
        $this->command->info('   - الدول: ' . \App\Models\Country::count());
        $this->command->info('   - إعدادات الموقع: ' . \App\Models\SiteSetting::count());
        $this->command->info('   - التصنيفات: ' . \App\Models\Category::count());
        $this->command->info('   - العلامات التجارية: ' . \App\Models\Brand::count());
        $this->command->info('   - المنتجات: ' . \App\Models\Product::count());
        $this->command->info('   - صور المنتجات: ' . \App\Models\ProductImage::count());
        $this->command->info('   - المستخدمين: ' . \App\Models\User::count());
        $this->command->info('');
        $this->command->info('🔑 بيانات تسجيل الدخول:');
        $this->command->info('   المدير: admin@autoparts.com / 123456789');
        $this->command->info('   المستخدم: user@autoparts.com / 123456789');
    }
}
