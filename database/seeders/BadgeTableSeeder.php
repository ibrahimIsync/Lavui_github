<?php

namespace Database\Seeders;

use App\Enums\Status;
use App\Models\Badge;
use Dipokhalder\EnvEditor\EnvEditor;
use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $envService = new EnvEditor();
        if ($envService->getValue('DEMO')) {
            $badges = [
                [
                    'level'       => 'silver',
                    'points'      => 15000,
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'level'       => 'bronze',
                    'points'      => 30000,
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
                [
                    'level'       => 'premium',
                    'points'      => 50000,
                    'status'      => Status::ACTIVE,
                    'created_at'  => now(),
                    'updated_at'  => now()
                ],
            ];
            foreach ($badges as $badge) {
                Badge::create($badge);
            }
        }
    }
}
