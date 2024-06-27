<?php

namespace Database\Seeders;

use App\Enums\Ask;
use App\Enums\Status;
use App\Models\Slider;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class SliderTableSeeder extends Seeder
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

            $sliders = [
                [
                    'image' => [
                        'en' => 'image.png',
                        'ar' => 'image.png'
                    ],
                    'status'      => Status::ACTIVE,
                    'mean_slider' => Ask::YES,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'image' => [
                        'en' => 'image.png',
                        'ar' => 'image.png'
                    ],
                    'status'      => Status::ACTIVE,
                    'mean_slider' => Ask::NO,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'image' => [
                        'en' => 'image.png',
                        'ar' => 'image.png'
                    ],
                    'status'      => Status::ACTIVE,
                    'mean_slider' => Ask::NO,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]
            ];

            foreach ($sliders as $slider) {
                $sliderObject = Slider::create($slider);
//                if (file_exists(public_path('/images/seeder/slider/' . env('DISPLAY') .'/' . strtolower(str_replace(' ', '_', $slider)) . '.png'))) {
//                    $sliderObject->addMedia(public_path('/images/seeder/slider/' . env('DISPLAY') .'/' . strtolower(str_replace(' ', '_', $slider)) . '.png'))->preservingOriginal()->toMediaCollection('slider');
//                }
            }
        }
    }
}
