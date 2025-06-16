<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();

        $product1 = Product::create([
            'name' => [
                'en' => 'Air Filter for Toyota Corolla',
                'ar' => 'فلتر هواء لتويوتا كورولا'
            ],
            'slug' => 'air-filter-toyota-corolla',
            'description' => [
                'en' => 'High quality air filter for Toyota Corolla 2015-2020. Ensures clean air flow to engine for optimal performance.',
                'ar' => 'فلتر هواء عالي الجودة لتويوتا كورولا 2015-2020. يضمن تدفق هواء نظيف للمحرك للحصول على أداء مثالي.'
            ],
            'short_description' => [
                'en' => 'Premium air filter for Toyota Corolla',
                'ar' => 'فلتر هواء ممتاز لتويوتا كورولا'
            ],
            'price' => 200.00,
            'selling_price' => 150.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'car-filters')->first()->id,
            'brand_id' => $brands->where('slug', 'mann-filter')->first()->id,
            'qty' => 50,
            'minqty' => 5,
            'status' => 1,
            'trend' => 1,
            'meta_title' => [
                'en' => 'Toyota Corolla Air Filter - High Quality',
                'ar' => 'فلتر هواء تويوتا كورولا - جودة عالية'
            ],
            'meta_description' => [
                'en' => 'Buy premium air filter for Toyota Corolla. High quality, long lasting performance.',
                'ar' => 'اشتري فلتر هواء ممتاز لتويوتا كورولا. جودة عالية وأداء طويل المدى.'
            ],
            'meta_keywords' => [
                'en' => 'toyota corolla air filter, car air filter, mann filter',
                'ar' => 'فلتر هواء تويوتا كورولا, فلتر هواء سيارة, مان فلتر'
            ]
        ]);

        $product2 = Product::create([
            'name' => [
                'en' => 'Brake Pads Front for Honda Civic',
                'ar' => 'فحمات فرامل أمامية لهوندا سيفيك'
            ],
            'slug' => 'brake-pads-front-honda-civic',
            'description' => [
                'en' => 'Premium brake pads for Honda Civic front wheels. Excellent stopping power and durability.',
                'ar' => 'فحمات فرامل ممتازة للعجلات الأمامية لهوندا سيفيك. قوة توقف ممتازة ومتانة عالية.'
            ],
            'short_description' => [
                'en' => 'Front brake pads for Honda Civic',
                'ar' => 'فحمات فرامل أمامية لهوندا سيفيك'
            ],
            'price' => 450.00,
            'selling_price' => 350.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'brake-system')->first()->id,
            'brand_id' => $brands->where('slug', 'brembo')->first()->id,
            'qty' => 30,
            'minqty' => 3,
            'status' => 1,
            'trend' => 1,
            'meta_title' => [
                'en' => 'Honda Civic Brake Pads - Brembo Quality',
                'ar' => 'فحمات فرامل هوندا سيفيك - جودة بريمبو'
            ],
            'meta_description' => [
                'en' => 'High performance brake pads for Honda Civic. Brembo quality for maximum safety.',
                'ar' => 'فحمات فرامل عالية الأداء لهوندا سيفيك. جودة بريمبو لأقصى أمان.'
            ],
            'meta_keywords' => [
                'en' => 'honda civic brake pads, front brake pads, brembo',
                'ar' => 'فحمات فرامل هوندا سيفيك, فحمات فرامل أمامية, بريمبو'
            ]
        ]);

        $product3 = Product::create([
            'name' => [
                'en' => 'Car Battery 12V 70Ah',
                'ar' => 'بطارية سيارة 12 فولت 70 أمبير'
            ],
            'slug' => 'car-battery-12v-70ah',
            'description' => [
                'en' => 'High capacity 12V 70Ah car battery. Reliable starting power for most car models.',
                'ar' => 'بطارية سيارة عالية السعة 12 فولت 70 أمبير. قوة تشغيل موثوقة لمعظم موديلات السيارات.'
            ],
            'short_description' => [
                'en' => 'Reliable 12V 70Ah car battery',
                'ar' => 'بطارية سيارة موثوقة 12 فولت 70 أمبير'
            ],
            'price' => 950.00,
            'selling_price' => 800.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'electrical-system')->first()->id,
            'brand_id' => $brands->where('slug', 'bosch')->first()->id,
            'qty' => 25,
            'minqty' => 2,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'Car Battery 12V 70Ah - Bosch Quality',
                'ar' => 'بطارية سيارة 12 فولت 70 أمبير - جودة بوش'
            ],
            'meta_description' => [
                'en' => 'Reliable car battery with 70Ah capacity. Bosch quality for long lasting performance.',
                'ar' => 'بطارية سيارة موثوقة بسعة 70 أمبير. جودة بوش لأداء طويل المدى.'
            ],
            'meta_keywords' => [
                'en' => 'car battery, 12v battery, 70ah battery, bosch',
                'ar' => 'بطارية سيارة, بطارية 12 فولت, بطارية 70 أمبير, بوش'
            ]
        ]);

        $product4 = Product::create([
            'name' => [
                'en' => 'Car Tire 195/65R15',
                'ar' => 'إطار سيارة 195/65R15'
            ],
            'slug' => 'car-tire-195-65r15',
            'description' => [
                'en' => 'High quality car tire 195/65R15. Excellent grip and durability for safe driving.',
                'ar' => 'إطار سيارة عالي الجودة 195/65R15. قبضة ممتازة ومتانة للقيادة الآمنة.'
            ],
            'short_description' => [
                'en' => 'Premium car tire 195/65R15',
                'ar' => 'إطار سيارة ممتاز 195/65R15'
            ],
            'price' => 1400.00,
            'selling_price' => 1200.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'tires-wheels')->first()->id,
            'brand_id' => $brands->where('slug', 'continental')->first()->id,
            'qty' => 40,
            'minqty' => 4,
            'status' => 1,
            'trend' => 1,
            'meta_title' => [
                'en' => 'Car Tire 195/65R15 - Continental Quality',
                'ar' => 'إطار سيارة 195/65R15 - جودة كونتيننتال'
            ],
            'meta_description' => [
                'en' => 'Premium car tire with excellent performance. Continental quality for safe driving.',
                'ar' => 'إطار سيارة ممتاز بأداء ممتاز. جودة كونتيننتال للقيادة الآمنة.'
            ],
            'meta_keywords' => [
                'en' => 'car tire, 195/65r15, continental tire',
                'ar' => 'إطار سيارة, 195/65r15, إطار كونتيننتال'
            ]
        ]);

        $product5 = Product::create([
            'name' => [
                'en' => 'Engine Oil 5W-30 4L',
                'ar' => 'زيت محرك 5W-30 4 لتر'
            ],
            'slug' => 'engine-oil-5w30-4l',
            'description' => [
                'en' => 'Premium synthetic engine oil 5W-30. Provides excellent engine protection and performance.',
                'ar' => 'زيت محرك صناعي ممتاز 5W-30. يوفر حماية وأداء ممتاز للمحرك.'
            ],
            'short_description' => [
                'en' => 'Synthetic engine oil 5W-30 4L',
                'ar' => 'زيت محرك صناعي 5W-30 4 لتر'
            ],
            'price' => 550.00,
            'selling_price' => 450.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'engine-parts')->first()->id,
            'brand_id' => $brands->where('slug', 'mahle')->first()->id,
            'qty' => 60,
            'minqty' => 6,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'Engine Oil 5W-30 4L - Mahle Quality',
                'ar' => 'زيت محرك 5W-30 4 لتر - جودة ماهلي'
            ],
            'meta_description' => [
                'en' => 'Premium synthetic engine oil for optimal engine performance and protection.',
                'ar' => 'زيت محرك صناعي ممتاز لأداء وحماية مثالية للمحرك.'
            ],
            'meta_keywords' => [
                'en' => 'engine oil, 5w30, synthetic oil, mahle',
                'ar' => 'زيت محرك, 5w30, زيت صناعي, ماهلي'
            ]
        ]);

        $product6 = Product::create([
            'name' => [
                'en' => 'LED Headlight H7',
                'ar' => 'مصباح أمامي LED H7'
            ],
            'slug' => 'led-headlight-h7',
            'description' => [
                'en' => 'High brightness LED headlight H7. Energy efficient with long lifespan.',
                'ar' => 'مصباح أمامي LED H7 عالي السطوع. موفر للطاقة مع عمر طويل.'
            ],
            'short_description' => [
                'en' => 'Bright LED headlight H7',
                'ar' => 'مصباح أمامي LED H7 مشرق'
            ],
            'price' => 320.00,
            'selling_price' => 250.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'lighting')->first()->id,
            'brand_id' => $brands->where('slug', 'hella')->first()->id,
            'qty' => 35,
            'minqty' => 3,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'LED Headlight H7 - Hella Quality',
                'ar' => 'مصباح أمامي LED H7 - جودة هيلا'
            ],
            'meta_description' => [
                'en' => 'High brightness LED headlight for better visibility and safety.',
                'ar' => 'مصباح أمامي LED عالي السطوع لرؤية أفضل وأمان أكبر.'
            ],
            'meta_keywords' => [
                'en' => 'led headlight, h7 bulb, car lighting, hella',
                'ar' => 'مصباح أمامي led, لمبة h7, إضاءة سيارة, هيلا'
            ]
        ]);

        $product7 = Product::create([
            'name' => [
                'en' => 'Shock Absorber Front',
                'ar' => 'ممتص صدمات أمامي'
            ],
            'slug' => 'shock-absorber-front',
            'description' => [
                'en' => 'High quality front shock absorber for smooth and comfortable ride.',
                'ar' => 'ممتص صدمات أمامي عالي الجودة لقيادة سلسة ومريحة.'
            ],
            'short_description' => [
                'en' => 'Front shock absorber',
                'ar' => 'ممتص صدمات أمامي'
            ],
            'price' => 750.00,
            'selling_price' => 600.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'suspension-system')->first()->id,
            'brand_id' => $brands->where('slug', 'febi')->first()->id,
            'qty' => 20,
            'minqty' => 2,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'Front Shock Absorber - Febi Quality',
                'ar' => 'ممتص صدمات أمامي - جودة فيبي'
            ],
            'meta_description' => [
                'en' => 'High quality shock absorber for smooth and comfortable ride.',
                'ar' => 'ممتص صدمات عالي الجودة لقيادة سلسة ومريحة.'
            ],
            'meta_keywords' => [
                'en' => 'shock absorber, suspension, febi, car parts',
                'ar' => 'ممتص صدمات, تعليق, فيبي, قطع سيارة'
            ]
        ]);

        $product8 = Product::create([
            'name' => [
                'en' => 'Car Radiator',
                'ar' => 'رديتر سيارة'
            ],
            'slug' => 'car-radiator',
            'description' => [
                'en' => 'High efficiency car radiator for optimal engine cooling performance.',
                'ar' => 'رديتر سيارة عالي الكفاءة لأداء تبريد مثالي للمحرك.'
            ],
            'short_description' => [
                'en' => 'Efficient car radiator',
                'ar' => 'رديتر سيارة فعال'
            ],
            'price' => 1100.00,
            'selling_price' => 900.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'cooling-system')->first()->id,
            'brand_id' => $brands->where('slug', 'valeo')->first()->id,
            'qty' => 15,
            'minqty' => 1,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'Car Radiator - Valeo Quality',
                'ar' => 'رديتر سيارة - جودة فاليو'
            ],
            'meta_description' => [
                'en' => 'High efficiency radiator for optimal engine cooling performance.',
                'ar' => 'رديتر عالي الكفاءة لأداء تبريد مثالي للمحرك.'
            ],
            'meta_keywords' => [
                'en' => 'car radiator, cooling system, valeo, engine cooling',
                'ar' => 'رديتر سيارة, نظام تبريد, فاليو, تبريد محرك'
            ]
        ]);

        $product9 = Product::create([
            'name' => [
                'en' => 'Fuel Pump Electric',
                'ar' => 'طرمبة وقود كهربائية'
            ],
            'slug' => 'fuel-pump-electric',
            'description' => [
                'en' => 'High pressure electric fuel pump for reliable fuel delivery to engine.',
                'ar' => 'طرمبة وقود كهربائية عالية الضغط لتوصيل موثوق للوقود للمحرك.'
            ],
            'short_description' => [
                'en' => 'Electric fuel pump',
                'ar' => 'طرمبة وقود كهربائية'
            ],
            'price' => 900.00,
            'selling_price' => 750.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'fuel-system')->first()->id,
            'brand_id' => $brands->where('slug', 'denso')->first()->id,
            'qty' => 18,
            'minqty' => 2,
            'status' => 1,
            'trend' => 1,
            'meta_title' => [
                'en' => 'Electric Fuel Pump - Denso Quality',
                'ar' => 'طرمبة وقود كهربائية - جودة دينسو'
            ],
            'meta_description' => [
                'en' => 'High pressure electric fuel pump for reliable fuel delivery.',
                'ar' => 'طرمبة وقود كهربائية عالية الضغط لتوصيل موثوق للوقود.'
            ],
            'meta_keywords' => [
                'en' => 'fuel pump, electric pump, denso, fuel system',
                'ar' => 'طرمبة وقود, طرمبة كهربائية, دينسو, نظام وقود'
            ]
        ]);

        $product10 = Product::create([
            'name' => [
                'en' => 'AC Compressor',
                'ar' => 'كمبروسر مكيف'
            ],
            'slug' => 'ac-compressor',
            'description' => [
                'en' => 'High efficiency AC compressor for optimal cooling performance in your car.',
                'ar' => 'كمبروسر مكيف عالي الكفاءة لأداء تبريد مثالي في سيارتك.'
            ],
            'short_description' => [
                'en' => 'Efficient AC compressor',
                'ar' => 'كمبروسر مكيف فعال'
            ],
            'price' => 1800.00,
            'selling_price' => 1500.00,
            'tax' => 0.00,
            'category_id' => $categories->where('slug', 'ac-heating')->first()->id,
            'brand_id' => $brands->where('slug', 'denso')->first()->id,
            'qty' => 12,
            'minqty' => 1,
            'status' => 1,
            'trend' => 0,
            'meta_title' => [
                'en' => 'AC Compressor - Denso Quality',
                'ar' => 'كمبروسر مكيف - جودة دينسو'
            ],
            'meta_description' => [
                'en' => 'High efficiency AC compressor for optimal cooling performance.',
                'ar' => 'كمبروسر مكيف عالي الكفاءة لأداء تبريد مثالي.'
            ],
            'meta_keywords' => [
                'en' => 'ac compressor, air conditioning, denso, cooling',
                'ar' => 'كمبروسر مكيف, تكييف هواء, دينسو, تبريد'
            ]
        ]);

        $products = Product::all();
        foreach ($products as $product) {
            $imageCount = rand(2, 3);
            for ($i = 1; $i <= $imageCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => "products/{$product->slug}-{$i}.jpg"
                ]);
            }
        }
    }
}
