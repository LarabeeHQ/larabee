<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use App\Services\Bot;

use App\Models\Session;
use App\Models\PageView;

class ProcessColletectedData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public $website;

    public $bot;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $website)
    {
        $this->data = $data;
        $this->website = $website;
        $this->bot = new Bot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::beginTransaction();

        try {

            if ($this->bot->isBot($this->data['user_agent'])) {
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
            $url = parse_url($this->data['url']['path']);
            isset($url['query']) ? parse_str($url['query'], $queryParams) : null;

            // if found in cache
            if (Cache::has("session:$hash")) {
                $session = Cache::get("session:$hash");
            }
            else {
                // get geo data
                $geo = geoip($this->data['ip']);

                $session = Session::create([
                    'website_id' => $this->website['id'],
                    'device' => $this->data['device'],
                    'hostname' => $this->data['hostname'],
                    'browser' => $this->data['browser']['name'],
                    'browser_version' => $this->data['browser']['version'],
                    'os' => $this->data['os'],
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

            // get referrer
            $referrer = null;
            if ($this->data['referrer']) {
                $referrerUrl = parse_url($this->data['referrer']);
                if (isset($referrerUrl['host']) && $referrerUrl['host'] != $this->website['domain']) {
                    $referrer = $referrerUrl['host'];
                }
            }

            $pageView = new PageView;
            $pageView->session_id = $session->id;
            $pageView->website_id = $session->website_id;
            $pageView->url = $url['path'];
            $pageView->title = $this->data['url']['title'];
            $pageView->referrer = $referrer;
            $pageView->save();

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }
}
