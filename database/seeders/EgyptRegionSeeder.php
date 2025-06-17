<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EgyptRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            ['name' => 'Cairo', 'name_ar' => 'القاهرة', 'code' => 'cairo'],
            ['name' => 'Giza', 'name_ar' => 'الجيزة', 'code' => 'giza'],
            ['name' => 'Alexandria', 'name_ar' => 'الإسكندرية', 'code' => 'alex'],
            ['name' => 'Aswan', 'name_ar' => 'أسوان', 'code' => 'aswan'],
            ['name' => 'Asyut', 'name_ar' => 'أسيوط', 'code' => 'asuit'],
            ['name' => 'Beheira', 'name_ar' => 'البحيرة', 'code' => 'beheira'],
            ['name' => 'Beni Suef', 'name_ar' => 'بني سويف', 'code' => 'beni-suef'],
            ['name' => 'Dakahlia', 'name_ar' => 'الدقهلية', 'code' => 'dakahlia'],
            ['name' => 'Damietta', 'name_ar' => 'دمياط', 'code' => 'damietta'],
            ['name' => 'Fayoum', 'name_ar' => 'الفيوم', 'code' => 'fayoum'],
            ['name' => 'Gharbia', 'name_ar' => 'الغربية', 'code' => 'gharbia'],
            ['name' => 'Ismailia', 'name_ar' => 'الإسماعيلية', 'code' => 'ismailia'],
            ['name' => 'Kafr El Sheikh', 'name_ar' => 'كفر الشيخ', 'code' => 'kafr-el-sheikh'],
            ['name' => 'Luxor', 'name_ar' => 'الأقصر', 'code' => 'luxor'],
            ['name' => 'Matruh', 'name_ar' => 'مطروح', 'code' => 'matruh'],
            ['name' => 'Minya', 'name_ar' => 'المنيا', 'code' => 'minya'],
            ['name' => 'Monufia', 'name_ar' => 'المنوفية', 'code' => 'monufia'],
            ['name' => 'New Valley', 'name_ar' => 'الوادي الجديد', 'code' => 'new-valley'],
            ['name' => 'North Sinai', 'name_ar' => 'شمال سيناء', 'code' => 'north-sinai'],
            ['name' => 'Port Said', 'name_ar' => 'بورسعيد', 'code' => 'port-said'],
            ['name' => 'Qalyubia', 'name_ar' => 'القليوبية', 'code' => 'qalyubia'],
            ['name' => 'Qena', 'name_ar' => 'قنا', 'code' => 'qena'],
            ['name' => 'Red Sea', 'name_ar' => 'البحر الأحمر', 'code' => 'red-sea'],
            ['name' => 'Sharqia', 'name_ar' => 'الشرقية', 'code' => 'sharqia'],
            ['name' => 'Sohag', 'name_ar' => 'سوهاج', 'code' => 'sohag'],
            ['name' => 'South Sinai', 'name_ar' => 'جنوب سيناء', 'code' => 'south-sinai'],
            ['name' => 'Suez', 'name_ar' => 'السويس', 'code' => 'suez'],
        ];

        DB::table('egypt_regions')->insert($regions);
    }
}
