<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء 10 تصنيفات لقطع غيار السيارات
        
        Category::create([
            'name' => [
                'en' => 'Car Filters',
                'ar' => 'فلاتر السيارات'
            ],
            'slug' => 'car-filters',
            'description' => [
                'en' => 'Air filters, oil filters, fuel filters, and cabin filters for all car models',
                'ar' => 'فلاتر الهواء والزيت والوقود والمكيف لجميع موديلات السيارات'
            ],
            'image' => 'categories/filters.jpg',
            'is_showing' => 1,
            'is_popular' => 1,
            'meta_title' => [
                'en' => 'Car Filters - High Quality Auto Parts',
                'ar' => 'فلاتر السيارات - قطع غيار عالية الجودة'
            ],
            'meta_description' => [
                'en' => 'Buy high quality car filters for all vehicle types. Air, oil, fuel and cabin filters available.',
                'ar' => 'اشتري فلاتر السيارات عالية الجودة لجميع أنواع المركبات. فلاتر الهواء والزيت والوقود والمكيف متوفرة.'
            ],
            'meta_keywords' => [
                'en' => 'car filters, air filter, oil filter, fuel filter, cabin filter',
                'ar' => 'فلاتر السيارات, فلتر هواء, فلتر زيت, فلتر وقود, فلتر مكيف'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Brake System',
                'ar' => 'نظام الفرامل'
            ],
            'slug' => 'brake-system',
            'description' => [
                'en' => 'Brake pads, brake discs, brake fluid and complete brake system components',
                'ar' => 'فحمات فرامل وأقراص فرامل وسائل فرامل ومكونات نظام الفرامل الكاملة'
            ],
            'image' => 'categories/brakes.jpg',
            'is_showing' => 1,
            'is_popular' => 1,
            'meta_title' => [
                'en' => 'Brake System Parts - Safety First',
                'ar' => 'قطع نظام الفرامل - الأمان أولاً'
            ],
            'meta_description' => [
                'en' => 'Complete brake system parts for maximum safety. Brake pads, discs and fluids.',
                'ar' => 'قطع نظام فرامل كاملة لأقصى أمان. فحمات وأقراص وسوائل فرامل.'
            ],
            'meta_keywords' => [
                'en' => 'brake pads, brake discs, brake fluid, brake system',
                'ar' => 'فحمات فرامل, أقراص فرامل, سائل فرامل, نظام فرامل'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Electrical System',
                'ar' => 'النظام الكهربائي'
            ],
            'slug' => 'electrical-system',
            'description' => [
                'en' => 'Car batteries, spark plugs, ignition coils and electrical components',
                'ar' => 'بطاريات السيارات وشمعات الإشعال وكويلات الإشعال والمكونات الكهربائية'
            ],
            'image' => 'categories/electrical.jpg',
            'is_showing' => 1,
            'is_popular' => 1,
            'meta_title' => [
                'en' => 'Car Electrical Parts - Reliable Performance',
                'ar' => 'قطع كهربائية للسيارات - أداء موثوق'
            ],
            'meta_description' => [
                'en' => 'High quality electrical parts for your car. Batteries, spark plugs and more.',
                'ar' => 'قطع كهربائية عالية الجودة لسيارتك. بطاريات وشمعات إشعال والمزيد.'
            ],
            'meta_keywords' => [
                'en' => 'car battery, spark plugs, ignition coils, electrical parts',
                'ar' => 'بطارية سيارة, شمعات إشعال, كويلات إشعال, قطع كهربائية'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Tires & Wheels',
                'ar' => 'الإطارات والعجلات'
            ],
            'slug' => 'tires-wheels',
            'description' => [
                'en' => 'High quality tires, rims and wheel accessories for all vehicle types',
                'ar' => 'إطارات عالية الجودة وجنوط وإكسسوارات العجلات لجميع أنواع المركبات'
            ],
            'image' => 'categories/tires.jpg',
            'is_showing' => 1,
            'is_popular' => 1,
            'meta_title' => [
                'en' => 'Tires & Wheels - Premium Quality',
                'ar' => 'الإطارات والعجلات - جودة ممتازة'
            ],
            'meta_description' => [
                'en' => 'Premium tires and wheels for optimal performance and safety.',
                'ar' => 'إطارات وعجلات ممتازة للأداء الأمثل والأمان.'
            ],
            'meta_keywords' => [
                'en' => 'tires, wheels, rims, tire accessories',
                'ar' => 'إطارات, عجلات, جنوط, إكسسوارات إطارات'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Engine Parts',
                'ar' => 'قطع المحرك'
            ],
            'slug' => 'engine-parts',
            'description' => [
                'en' => 'Engine oils, gaskets, pistons and complete engine components',
                'ar' => 'زيوت المحرك والجوانات والمكابس ومكونات المحرك الكاملة'
            ],
            'image' => 'categories/engine.jpg',
            'is_showing' => 1,
            'is_popular' => 1,
            'meta_title' => [
                'en' => 'Engine Parts - Power & Performance',
                'ar' => 'قطع المحرك - قوة وأداء'
            ],
            'meta_description' => [
                'en' => 'Complete engine parts for maximum power and performance.',
                'ar' => 'قطع محرك كاملة لأقصى قوة وأداء.'
            ],
            'meta_keywords' => [
                'en' => 'engine oil, gaskets, pistons, engine parts',
                'ar' => 'زيت محرك, جوانات, مكابس, قطع محرك'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Lighting',
                'ar' => 'الإضاءة'
            ],
            'slug' => 'lighting',
            'description' => [
                'en' => 'Headlights, tail lights, fog lights and complete lighting solutions',
                'ar' => 'مصابيح أمامية وخلفية وكشافات ضباب وحلول إضاءة كاملة'
            ],
            'image' => 'categories/lighting.jpg',
            'is_showing' => 1,
            'is_popular' => 0,
            'meta_title' => [
                'en' => 'Car Lighting - Bright & Safe',
                'ar' => 'إضاءة السيارات - مشرقة وآمنة'
            ],
            'meta_description' => [
                'en' => 'Complete car lighting solutions for better visibility and safety.',
                'ar' => 'حلول إضاءة سيارات كاملة لرؤية أفضل وأمان أكبر.'
            ],
            'meta_keywords' => [
                'en' => 'headlights, tail lights, fog lights, car lighting',
                'ar' => 'مصابيح أمامية, مصابيح خلفية, كشافات ضباب, إضاءة سيارات'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Suspension System',
                'ar' => 'نظام التعليق'
            ],
            'slug' => 'suspension-system',
            'description' => [
                'en' => 'Shock absorbers, springs and suspension system components',
                'ar' => 'ممتصات الصدمات والنوابض ومكونات نظام التعليق'
            ],
            'image' => 'categories/suspension.jpg',
            'is_showing' => 1,
            'is_popular' => 0,
            'meta_title' => [
                'en' => 'Suspension System - Smooth Ride',
                'ar' => 'نظام التعليق - قيادة سلسة'
            ],
            'meta_description' => [
                'en' => 'Quality suspension parts for a smooth and comfortable ride.',
                'ar' => 'قطع تعليق عالية الجودة لقيادة سلسة ومريحة.'
            ],
            'meta_keywords' => [
                'en' => 'shock absorbers, springs, suspension parts',
                'ar' => 'ممتصات صدمات, نوابض, قطع تعليق'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Cooling System',
                'ar' => 'نظام التبريد'
            ],
            'slug' => 'cooling-system',
            'description' => [
                'en' => 'Radiators, cooling fans, hoses and cooling system components',
                'ar' => 'رديتر ومراوح تبريد وخراطيم ومكونات نظام التبريد'
            ],
            'image' => 'categories/cooling.jpg',
            'is_showing' => 1,
            'is_popular' => 0,
            'meta_title' => [
                'en' => 'Cooling System - Engine Protection',
                'ar' => 'نظام التبريد - حماية المحرك'
            ],
            'meta_description' => [
                'en' => 'Complete cooling system parts to protect your engine from overheating.',
                'ar' => 'قطع نظام تبريد كاملة لحماية محركك من السخونة الزائدة.'
            ],
            'meta_keywords' => [
                'en' => 'radiator, cooling fan, coolant, cooling system',
                'ar' => 'رديتر, مروحة تبريد, سائل تبريد, نظام تبريد'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'Fuel System',
                'ar' => 'نظام الوقود'
            ],
            'slug' => 'fuel-system',
            'description' => [
                'en' => 'Fuel pumps, fuel tanks, fuel lines and fuel system components',
                'ar' => 'طرمبات وقود وخزانات وقود وأنابيب وقود ومكونات نظام الوقود'
            ],
            'image' => 'categories/fuel.jpg',
            'is_showing' => 1,
            'is_popular' => 0,
            'meta_title' => [
                'en' => 'Fuel System - Efficient Performance',
                'ar' => 'نظام الوقود - أداء فعال'
            ],
            'meta_description' => [
                'en' => 'Quality fuel system parts for efficient engine performance.',
                'ar' => 'قطع نظام وقود عالية الجودة لأداء محرك فعال.'
            ],
            'meta_keywords' => [
                'en' => 'fuel pump, fuel tank, fuel lines, fuel system',
                'ar' => 'طرمبة وقود, خزان وقود, أنابيب وقود, نظام وقود'
            ]
        ]);

        Category::create([
            'name' => [
                'en' => 'AC & Heating',
                'ar' => 'التكييف والتدفئة'
            ],
            'slug' => 'ac-heating',
            'description' => [
                'en' => 'AC compressors, evaporators, condensers and climate control components',
                'ar' => 'كمبروسر مكيف ومبخر وكوندنسر ومكونات التحكم في المناخ'
            ],
            'image' => 'categories/ac.jpg',
            'is_showing' => 1,
            'is_popular' => 0,
            'meta_title' => [
                'en' => 'AC & Heating - Comfort Control',
                'ar' => 'التكييف والتدفئة - التحكم في الراحة'
            ],
            'meta_description' => [
                'en' => 'Complete AC and heating system parts for optimal comfort.',
                'ar' => 'قطع نظام تكييف وتدفئة كاملة للراحة المثلى.'
            ],
            'meta_keywords' => [
                'en' => 'ac compressor, evaporator, condenser, heating system',
                'ar' => 'كمبروسر مكيف, مبخر, كوندنسر, نظام تدفئة'
            ]
        ]);
    }
}
