<?php

namespace App\Http\Controllers\App;

use Inertia\Inertia;

use App\Models\Session;

class UserController extends Controller
{
    public function index()
    {
        $website = auth()->user()->currentWebsite;

        $sesions = Session::where('website_id', $website->id)->latest()->paginate();

        return Inertia::render('App/User/Index', [
            'sessions' => $sesions,
            'website' => $website,
        ]);
    }
}
