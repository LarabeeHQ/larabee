<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Browser;

use App\Models\Website;
use App\Models\Session;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ips = json_decode(file_get_contents(database_path('factories/data/ip.json')));
        $hostnames = json_decode(file_get_contents(database_path('factories/data/hostname.json')));
        $userAgents = json_decode(file_get_contents(database_path('factories/data/user_agent.json')));
        $screens = json_decode(file_get_contents(database_path('factories/data/screen.json')));
        $languages = json_decode(file_get_contents(database_path('factories/data/language.json')));
        $devices = json_decode(file_get_contents(database_path('factories/data/device.json')));

        // definitions
        $ip = collect($ips)->random();
        $userAgent = collect($userAgents)->random();
        $screen = collect($screens)->random();
        $language = collect($languages)->random();
        $device = collect($devices)->random();
        $hostname = collect($hostnames)->random();
        $utmMedium = collect(['cpc', 'feed', 'newsletter', null])->random();
        $utmSource = collect(['google', 'facebook', 'twitter', null])->random();
        $utmCampaign = collect(['cQ1', 'cQ2', 'cQ3', 'cQ4', null])->random();
        $utmContent = collect(['banner_top', 'banner_left', null])->random();
        $utmTerm = collect(['my+keyword', 'nice+keyword', null])->random();

        // get geo data
        $geo = geoip($ip);

        // get browser data
        $browser = Browser::parse($userAgent);

        return [
            'website_id' => Website::factory(),
            'hostname' => $hostname,
            'browser' => $browser->browserFamily(),
            'os' => $browser->platformFamily(),
            'device' => $device,
            'screen' => $screen,
            'language' => $language,
            'country' => $geo->iso_code,
            'region' => $geo->state_name,
            'city' => $geo->city,
            'utm_medium' => $utmMedium,
            'utm_source' => $utmSource,
            'utm_campaign' => $utmCampaign,
            'utm_content' => $utmContent,
            'utm_term' => $utmTerm,
            'created_at' => now()
        ];
    }
}
