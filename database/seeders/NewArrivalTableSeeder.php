<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\NewArrival;
use App\Models\Product;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;

class NewArrivalTableSeeder extends Seeder
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
            $products = Product::select('id')->inRandomOrder()->limit(3)->get();

            foreach ($products as $product) {
                NewArrival::create([
                    'product_id' => $product->id,
                    'status' => Status::ACTIVE,
                    'image' => 'image.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]);
            }
        }
    }
}
