<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Session;
use App\Models\Website;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageView>
 */
class PageViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $referrers = json_decode(file_get_contents(database_path('factories/data/referrer.json')));
        $urls = json_decode(file_get_contents(database_path('factories/data/url.json')));

        $referrer = collect($referrers)->random();
        $url = collect($urls)->random();

        return [
            'website_id' => Website::factory(),
            'session_id' => Session::factory(),
            'url' => $url,
            'referrer' => $referrer,
            'created_at' => now()
        ];
    }
}
