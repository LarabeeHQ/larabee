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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->data['ip'] = '104.103.238.0';

        // get session hash
        $hash = hash('md5', "{$this->data['website_id']}-{$this->data['ip']}-{$this->data['user_agent']}");

        // parse url
        $url = parse_url($this->data['url']);
        isset($url['query']) ? parse_str($url['query'], $queryParams) : null;


        if (!Cache::has("session:$hash")) {

            // get geo data
            $geo = geoip($this->data['ip']);

            // get browser data
            $browser = Browser::parse($this->data['user_agent']);

            // get user device
            if ($browser->isMobile()) {
                $device = Session::DEVICE_MOBILE;
            } elseif ($browser->isTablet()) {
                $device = Session::DEVICE_TABLET;
            } elseif ($browser->isDesktop()) {
                $device = Session::DEVICE_DESKTOP;
            }

            $session = Session::create([
                'hash' => $hash,
                'website_id' => $this->data['website_id'],
                'device' => $device,
                'hostname' => $this->data['hostname'],
                'browser' => $browser->browserFamily(),
                'os' => $browser->platformFamily(),
                'screen' => $this->data['screen'],
                'language' => $this->data['language'],
                'country' => $geo->country,
                'region' => $geo->state_name,
                'city' => $geo->city,
                'utm_medium' => isset($queryParams) ? $queryParams['utm_medium'] : null,
                'utm_source' => isset($queryParams) ? $queryParams['utm_source'] : null,
                'utm_campaign' => isset($queryParams) ? $queryParams['utm_campaign'] : null,
                'utm_content' => isset($queryParams) ? $queryParams['utm_content'] : null,
                'utm_term' => isset($queryParams) ? $queryParams['utm_term'] : null
            ]);

            Cache::put("session:$hash", $session, 1800); // 30 minutes
        }
        else {
            $session = Cache::get("session:$hash");
        }

        $pageView = new PageView;
        $pageView->session_id = $session->id;
        $pageView->website_id = $session->website_id;
        $pageView->url = $url['path'];
        $pageView->referrer = $this->data['referrer'];
        $pageView->save();
    }
}
