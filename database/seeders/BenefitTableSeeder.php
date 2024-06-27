<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Benefit;
use Illuminate\Database\Seeder;
use Dipokhalder\EnvEditor\EnvEditor;

class BenefitTableSeeder extends Seeder
{
    public function run()
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            $benefits = [
                [
                    'title'       => [
                        'en' => 'Professional Service',
                        'ar' => 'العنوان الاول',
                    ],
                    'description' => [
                        'en' => 'Efficient customer support from passionate team',
                        'ar' => 'الديسكربشن الاول'
                    ],
                    'status'      => Status::ACTIVE,
                    'icon'        => 'icon.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'title'       => [
                        'en' => 'Secure Payment',
                        'ar' => 'العنوان الثاني'
                    ],
                    'description' => [
                        'en' => 'Different secure payment methods',
                        'ar' => 'الديسكربشن الثاني'
                    ],
                    'status'      => Status::ACTIVE,
                    'icon'        => 'icon.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'title'       => [
                        'en' => 'Secure Payment',
                        'ar' => 'العنوان الثاني'
                    ],
                    'description' => [
                        'en' => 'Different secure payment methods',
                        'ar' => 'الديسكربشن الثاني'
                    ],
                    'status'      => Status::ACTIVE,
                    'icon'        => 'icon.png',
                    'created_at'  => now(),
                    'updated_at'  => now()
                ]
            ];
            foreach ($benefits as $benefit) {
                $benefitObject = Benefit::create($benefit);
//                if (file_exists(public_path('/images/seeder/benefit/' . strtolower(str_replace(' ', '_', $benefit['title'])) . '.png'))) {
//                    $benefitObject->addMedia(public_path('/images/seeder/benefit/' . strtolower(str_replace(' ', '_', $benefit['title'])) . '.png'))->preservingOriginal()->toMediaCollection('benefit');
//                }
            }
        }
    }
}
