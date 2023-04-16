<?php

namespace App\Http\Controllers\App;

use Inertia\Inertia;

use App\Models\Session;

class UserController extends Controller
{
    public function index()
    {
        $website = auth()->user()->currentWebsite;

        $sessions = Session::where('website_id', $website->id)
            ->with('last_page_view')
            ->latest()
            ->paginate();

        return Inertia::render('App/User/Index', [
            'sessions' => $sessions,
            'website' => $website,
        ]);
    }

    public function show($id)
    {
        $website = auth()->user()->currentWebsite;

        $session = Session::where('website_id', $website->id)
            ->where('id', $id)
            ->with('page_views', function ($query) {
                $query->orderBy('created_at', 'desc');
            })
            ->with('first_page_view')
            ->firstOrFail();

        return Inertia::render('App/User/Show', [
            'session' => $session
        ]);
    }
}
