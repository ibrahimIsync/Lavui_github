<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\CustomCollection;
use App\Models\CustomCollectionProduct;
use App\Models\Product;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            $collections = [
                [
                    'name'       => [
                        'en' => 'Professional Service 1',
                        'ar' => 'العنوان الاول',
                    ],
                    'description' => [
                        'en' => 'Efficient customer support from passionate team',
                        'ar' => 'الديسكربشن الاول'
                    ],
                    'image'       => 'image.png',
                    'slug'        => Str::slug('Professional Service 1'),
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'Professional Service 2',
                        'ar' => 'العنوان الاول',
                    ],
                    'description' => [
                        'en' => 'Efficient customer support from passionate team',
                        'ar' => 'الديسكربشن الاول'
                    ],
                    'image'       => 'image.png',
                    'slug'        => Str::slug('Professional Service 2'),
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'Professional Service 3',
                        'ar' => 'العنوان الاول',
                    ],
                    'description' => [
                        'en' => 'Efficient customer support from passionate team',
                        'ar' => 'الديسكربشن الاول'
                    ],
                    'image'       => 'image.png',
                    'slug'        => Str::slug('Professional Service 3'),
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
            ];
            foreach ($collections as $collection) {
                $customCollection = CustomCollection::create($collection);

                $products = Product::select('id')->inRandomOrder()->limit(35)->get();
                foreach ($products as $product) {
                    CustomCollectionProduct::create([
                        'custom_collection_id'  => $customCollection->id,
                        'product_id'            => $product->id,
                    ]);
                }
            }
        }
    }
}
