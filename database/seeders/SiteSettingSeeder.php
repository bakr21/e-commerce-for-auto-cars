<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء إعدادات الموقع لمتجر قطع غيار السيارات
        SiteSetting::create([
            'site_name' => [
                'en' => 'AutoParts Egypt',
                'ar' => 'قطع غيار مصر'
            ],
            'site_image' => 'site/logo.png',
            'map_link' => 'https://maps.google.com/embed?pb=!1m18!1m12!1m3!1d3454.1!2d31.2357!3d30.0444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDAyJzM5LjgiTiAzMcKwMTQnMDguNSJF!5e0!3m2!1sen!2seg!4v1234567890',
            'phone_number' => '+20 2 1234 5678',
            'company_description' => [
                'en' => 'Leading supplier of high-quality auto parts in Egypt. We provide genuine and aftermarket parts for all car brands with competitive prices and excellent customer service.',
                'ar' => 'المورد الرائد لقطع غيار السيارات عالية الجودة في مصر. نوفر قطع غيار أصلية وبديلة لجميع ماركات السيارات بأسعار تنافسية وخدمة عملاء ممتازة.'
            ],
            'hotline' => '+20 100 123 4567',
            'address' => [
                'en' => '15 Salah Salem Street, Nasr City, Cairo, Egypt',
                'ar' => '15 شارع صلاح سالم، مدينة نصر، القاهرة، مصر'
            ],
            'email' => 'info@autoparts-egypt.com',
            'facebook_link' => 'https://facebook.com/autoparts.egypt',
            'whatsapp_number' => '+20 100 123 4567',
            'twitter_link' => 'https://twitter.com/autoparts_egypt',
            'linkedin_link' => 'https://linkedin.com/company/autoparts-egypt',
            'working_hours' => 'السبت - الخميس: 9:00 ص - 6:00 م | الجمعة: 2:00 م - 6:00 م',
        ]);
    }
}
