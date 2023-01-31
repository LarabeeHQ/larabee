<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Browser;

use App\Models\User;
use App\Models\Website;
use App\Models\Session;
use App\Models\PageView;

use Illuminate\Support\Facades\Cache;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            's' => ['required', 'uuid'], // website UUID
            'e' => ['required', 'string'], // evento, se é pageview ou outro evento
            'r' => ['nullable', 'url'], // referrer
            'w' => ['required', 'integer'], // width
            'p' => ['required', 'string'], // path
        ]);

        // geo
        $geo = geoip($request->ip());

        // browser
        $browser = Browser::parse($request->header('user-agent'));


        // [websiteId, ip, userAgent]
        $sessionHash = hash('md5', "{$request->s}-{$request->ip()}-{$request->header('user-agent')}");
        $session = Cache::get('session:' . $sessionHash);


        if(!$session) {
            $session = new Session;
            $session->website_id = $request->s;
            $session->hostname = $request->p;
            $session->browser = $browser->browserFamily();
            $session->os = $browser->platformFamily();
            $session->hash = $sessionHash;

            // device
            if($browser->isMobile()) {
                $device = 'Mobile';
            } elseif ($browser->isTablet()) {
                $device = 'Tablet';
            } elseif ($browser->isDesktop()) {
                $device = 'Desktop';
            }

            $session->device = $device;
            $session->country = $geo->country;
            $session->region = $geo->state_name;
            $session->city = $geo->city;

            $session->longitude = $geo->lon;
            $session->latitude = $geo->lat;
            $session->save();

            Cache::put('session:' . $sessionHash, $session, 500);
        }

        $pageView = new PageView;
        $pageView->session_id = $session->id;
        $pageView->website_id = $session->website_id;
        $pageView->path = $request->p;
        $pageView->referrer = $request->r;
        $pageView->save();

        return response()->json(null, 202);
    }
}
