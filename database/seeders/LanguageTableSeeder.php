<?php

namespace Database\Seeders;


use App\Enums\Status;
use App\Models\Language;
use Illuminate\Database\Seeder;


class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $englishLanguageArray = [
            'name'   => 'English',
            'code'   => 'en',
            'status' => Status::ACTIVE
        ];

        $arabicLanguageArray = [
            'name'   => 'Arabic',
            'code'   => 'ar',
            'status' => Status::ACTIVE
        ];

        $englishLanguage = Language::create($englishLanguageArray);
        if (file_exists(public_path('/images/seeder/language/english.png'))) {
            $englishLanguage->addMedia(public_path('/images/seeder/language/english.png'))->preservingOriginal()->toMediaCollection('language');
        }

        $arabicLanguage = Language::create($arabicLanguageArray);
        if (file_exists(public_path('/images/seeder/language/arabic.png'))) {
            $arabicLanguage->addMedia(public_path('/images/seeder/language/arabic.png'))->preservingOriginal()->toMediaCollection('language');
        }
    }
}
