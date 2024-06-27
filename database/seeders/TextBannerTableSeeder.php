<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\TextBanner;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;

class TextBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            $textBanners = [
                [
                    'name'       => [
                        'en' => 'Professional Service',
                        'ar' => 'العنوان الاول',
                    ],
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'Professional Service',
                        'ar' => 'العنوان الاول',
                    ],
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'Professional Service',
                        'ar' => 'العنوان الاول',
                    ],
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'name'       => [
                        'en' => 'Professional Service',
                        'ar' => 'العنوان الاول',
                    ],
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
            ];
            foreach ($textBanners as $textBanner) {
                TextBanner::create($textBanner);
            }
        }
    }
}
