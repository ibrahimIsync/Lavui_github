<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Product;
use App\Models\ProductSection;
use App\Models\ProductSectionProduct;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductSectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {

            $productSections = [
                [
                    'name' => [
                        'en' => 'product section 1',
                        'ar' => 'المجموعه الاول'
                    ],
                    'slug' => Str::slug('product section 1'),
                    'status' => Status::ACTIVE,
                    'description' => [
                        'en' => 'product section 1 description',
                        'ar' => 'الديسكربش الاول'
                    ],
                    'title' => [
                        'en' => 'product section title 1',
                        'ar' => 'العنوان الاول'
                    ],
                    'image' => 'image.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'product section 2',
                        'ar' => 'المجموعه الثاني'
                    ],
                    'slug' => Str::slug('product section 2'),
                    'status' => Status::ACTIVE,
                    'description' => [
                        'en' => 'product section 2 description',
                        'ar' => 'الديسكربش الثاني'
                    ],
                    'title' => [
                        'en' => 'product section title 2',
                        'ar' => 'العنوان الثاني'
                    ],
                    'image' => 'image.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'product section 3',
                        'ar' => 'المجموعه الثالث'
                    ],
                    'slug' => Str::slug('product section 3'),
                    'status' => Status::ACTIVE,
                    'description' => [
                        'en' => 'product section 3 description',
                        'ar' => 'الديسكربش الثالث'
                    ],
                    'title' => [
                        'en' => 'product section title 3',
                        'ar' => 'العنوان الثالث'
                    ],
                    'image' => 'image.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]
            ];

            foreach ($productSections as $productSection) {
                $section = ProductSection::create($productSection);

                $products = Product::select('id')->inRandomOrder()->limit(35)->get();
                foreach ($products as $product) {
                    ProductSectionProduct::create([
                        'product_section_id' => $section->id,
                        'product_id'         => $product->id,
                    ]);
                }
            }
        }
    }
}
