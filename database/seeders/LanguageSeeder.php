<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create(['name' => 'English', 'locale' => 'en', 'flag' => '🇺🇸']);
        Language::create(['name' => 'Portuguese', 'locale' => 'pt-BR', 'flag' => '🇧🇷']);
    }
}
