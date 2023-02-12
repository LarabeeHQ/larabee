<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cache;

use Browser;

use App\Models\User;
use App\Models\Website;
use App\Models\Session;
use App\Models\PageView;

class ProcessColletectedData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $website)
    {
        $this->data = $data;
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // get browser data
        $browser = Browser::parse($this->data['user_agent']);

        if($browser->isBot()) {
            return;
        }

        // redis cache key
        $hash = Session::generateHash(
            $this->website['id'],
            $this->data['hostname'],
            $this->data['ip'],
            $this->data['user_agent']
        );

        // parse url
        $url = parse_url($this->data['url']);
        isset($url['query']) ? parse_str($url['query'], $queryParams) : null;

        // if found in cache, revalidate for more 30min
        if (Cache::has("session:$hash")) {
            $session = Cache::get("session:$hash");
        }
        else {
            // get geo data
            $geo = geoip($this->data['ip']);

            // get user device
            if ($browser->isMobile()) {
                $device = Session::DEVICE_MOBILE;
            } elseif ($browser->isTablet()) {
                $device = Session::DEVICE_TABLET;
            } elseif ($browser->isDesktop()) {
                $device = Session::DEVICE_DESKTOP;
            }

            $session = Session::create([
                'website_id' => $this->website['id'],
                'device' => $device,
                'hostname' => $this->data['hostname'],
                'browser' => $browser->browserFamily(),
                'os' => $browser->platformFamily(),
                'screen' => $this->data['screen'],
                'language' => $this->data['language'],
                'country' => $geo->iso_code,
                'region' => $geo->state_name,
                'city' => $geo->city,
                'utm_medium' => isset($queryParams['utm_medium']) ? $queryParams['utm_medium'] : null,
                'utm_source' => isset($queryParams['utm_source']) ? $queryParams['utm_source'] : null,
                'utm_campaign' => isset($queryParams['utm_campaign']) ? $queryParams['utm_campaign'] : null,
                'utm_content' => isset($queryParams['utm_content']) ? $queryParams['utm_content'] : null,
                'utm_term' => isset($queryParams['utm_term']) ? $queryParams['utm_term'] : null
            ]);
        }

        Cache::put("session:$hash", $session, now()->addMinutes($this->website['session_duration']));

        // parse referrer
        $referrer = null;
        $referrerUrl = parse_url($this->data['referrer']);

        if ($this->website['domain'] !== $this->data['referrer'] && isset($referrerUrl['host'])) {
            $referrer = $referrerUrl['host'];
        }

        $pageView = new PageView;
        $pageView->session_id = $session->id;
        $pageView->website_id = $session->website_id;
        $pageView->url = $url['path'];
        $pageView->referrer = $referrer;
        $pageView->save();
    }
}
