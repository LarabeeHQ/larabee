<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Timezone;
use App\Models\Website;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = auth()->user()->websites;
        return Inertia::render('Website/Index', [
            'websites' => $websites,
        ]);
    }

    public function create()
    {
        return Inertia::render('Website/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2'
        ]);

        // get auth user
        $user = auth()->user();

        // website
        $website = new Website;
        $website->name = $request->name;
        $website->timezone_id = Timezone::where('value', 'Africa/Monrovia')->first()->id;
        $website->save();

        // attach user to website
        $user->websites()->attach($website->id, [
            'role' => User::ROLE_OWNER,
        ]);

        $user->forceFill([
            'current_website_id' => $website->id,
        ])->save();

        // change website
        $user->switchWebsite($website);

        return redirect(route('websites.index'));
    }

    public function show($id)
    {

        // get user
        $user = auth()->user();

        // get website
        $website = Website::where('id', $id)->firstOrFail();

        // check if user belongs to website
        if (!$user->belongsToWebsite($website)) {
            abort(404);
        }

        return Inertia::render('Website/Show', [
            'website' => $website,
        ]);
    }

    public function setCurrentWebsite(Request $request)
    {
        $website = Website::findOrFail($request->website_id);

        if (!$request->user()->switchWebsite($website)) {
            abort(403);
        }

        return Inertia::location(route('inbox.index'));
    }
}
