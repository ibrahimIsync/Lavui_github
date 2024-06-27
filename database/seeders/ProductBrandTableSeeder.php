<?php

namespace Database\Seeders;

use App\Enums\Status;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class ProductBrandTableSeeder extends Seeder
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
            $brands = [
                [
                    'name' => [
                        'en' => 'puma',
                        'ar' => 'بوما'
                    ],
                    'slug' => Str::slug('puma'),
                    'image' => 'image.png',
                    'description' => [
                        'en' => 'This is puma',
                        'ar' => 'هذا يكون بوما'
                    ],
                    'status' => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'Chanel',
                        'ar' => 'شانيل'
                    ],
                    'slug' => Str::slug('chanel'),
                    'image' => 'image.png',
                    'description' => [
                        'en' => 'This is chanel',
                        'ar' => 'هذا يكون شانيل'
                    ],
                    'status' => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'Dior',
                        'ar' => 'ديور'
                    ],
                    'slug' => Str::slug('dior'),
                    'image' => 'image.png',
                    'description' => [
                        'en' => 'This is dior',
                        'ar' => 'هذا يكون ديور'
                    ],
                    'status' => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'Prada',
                        'ar' => 'برادا'
                    ],
                    'slug' => Str::slug('prada'),
                    'image' => 'image.png',
                    'description' => [
                        'en' => 'This is prada',
                        'ar' => 'هذا يكون برادا'
                    ],
                    'status' => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name' => [
                        'en' => 'Diva',
                        'ar' => 'ديفا'
                    ],
                    'slug' => Str::slug('diva'),
                    'image' => 'image.png',
                    'description' => [
                        'en' => 'This is diva',
                        'ar' => 'هذا يكون ديفا'
                    ],
                    'status' => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]
            ];
            foreach ($brands as $brand) {
                $productBand = ProductBrand::create($brand);
//                if (file_exists(public_path('/images/seeder/brand/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $fashionBrand)) . '.png'))) {
//                    $productBand->addMedia(public_path('/images/seeder/brand/' . env('DISPLAY') . '/' . strtolower(str_replace(' ', '_', $fashionBrand)) . '.png'))->preservingOriginal()->toMediaCollection('product-brand');
//                }
            }
        }
    }
}
