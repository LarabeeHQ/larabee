<?php

namespace App\Http\Controllers\App;

use Inertia\Inertia;

use App\Models\Session;
use App\Models\PageView;
use App\Models\Event;

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
            ->with('first_page_view')
            ->firstOrFail();


        $eventsQuery = Event::where('session_id', $session->id)
        ->get();

        $eventDates = PageView::where('session_id', $session->id)
            ->get()
            ->merge($eventsQuery)
            ->sortByDesc('created_at')
            ->map(function ($data) {
                $data->type = $data->getTable() == 'page_views' ? 'page_view' : 'event';
                return $data;
            })
            ->groupBy(function ($event) {
                return $event->created_at->format('Y-m-d');
            })
            ->toArray();

        return Inertia::render('App/User/Show', [
            'session' => $session,
            'eventDates' => $eventDates,
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
