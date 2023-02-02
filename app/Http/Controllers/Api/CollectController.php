<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Browser;

use App\Models\User;
use App\Models\Website;
use App\Models\Session;
use App\Models\PageView;

use Illuminate\Support\Facades\Cache;

class CollectController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website' => ['required', 'uuid'],
            'event' => ['required', 'string'],
            'hostname' => ['required', 'string'],
            'referrer' => ['nullable', 'url'],
            'language' => ['nullable', 'string'],
            'screen' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        // geo
        $geo = geoip($request->ip());

        // browser
        $browser = Browser::parse($request->header('user-agent'));

        // [websiteId, ip, userAgent]
        $sessionHash = hash('md5', "{$request->website}-{$request->ip()}-{$request->header('user-agent')}");
        $session = Cache::get('session:' . $sessionHash);

        if(!$session) {
            $session = new Session;
        }

        // set data
        $session->hash = $sessionHash;
        $session->website_id = $request->website;
        $session->hostname = $request->hostname;
        $session->browser = $browser->browserFamily();
        $session->os = $browser->platformFamily();
        $session->screen = $request->screen;
        $session->language = $request->language;

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
        $session->save();

        Cache::put('session:' . $sessionHash, $session, 1800); // 30 minutes


        $pageView = new PageView;
        $pageView->session_id = $session->id;
        $pageView->website_id = $session->website_id;
        $pageView->url = $request->url;
        $pageView->referrer = $request->referrer;
        $pageView->save();

        return response()->json(null, 202);
    }
}
