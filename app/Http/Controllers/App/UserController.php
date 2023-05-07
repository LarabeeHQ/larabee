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
            ->withCount('page_views')
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

    public function destroy($id)
    {
        $website = auth()->user()->currentWebsite;

        $session = Session::where('website_id', $website->id)
            ->where('id', $id)
            ->firstOrFail();

        $session->delete();

        session()->flash('flash.banner', 'User deleted successfully');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('users.index');
    }
}
