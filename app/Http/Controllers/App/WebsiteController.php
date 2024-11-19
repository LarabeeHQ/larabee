<?php

namespace App\Http\Controllers\App;

use App\Enums\UserRole;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Website;

class WebsiteController extends Controller
{
    public function create()
    {
        return Inertia::render('App/Website/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => ['required', 'min:3'],
        ]);

        // get auth user
        $user = auth()->user();

        // website
        $website = new Website;
        $website->name = $request->name;
        $website->domain = $request->domain;
        $website->public = false;
        $website->save();

        // attach user to website
        $user->websites()->attach($website->id, [
            'role' => UserRole::ROLE_OWNER,
        ]);

        // set current team
        $user->forceFill([
            'current_website_id' => $website->id,
        ])->save();

        // change team
        $user->switchWebsite($website);

        session()->flash('flash.banner', 'Website created');
        session()->flash('flash.bannerStyle', 'success');

        return redirect(route('analytics'));
    }

    public function edit(Request $request)
    {
        $website = auth()->user()->currentWebsite;

        return Inertia::render('App/Website/Edit', [
            'website' => $website
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => ['required', 'min:3'],
        ]);

        $website = auth()->user()->currentWebsite;

        $website->name = $request->name;
        $website->domain = $request->domain;
        $website->session_duration = $request->session_duration;
        $website->public = $request->public;
        $website->save();

        session()->flash('flash.banner', 'Website updated');
        session()->flash('flash.bannerStyle', 'success');

        return back();
    }

    public function setCurrentWebsite(Request $request)
    {
        $website = Website::findOrFail($request->website_id);

        if (!$request->user()->switchWebsite($website)) {
            abort(403);
        }

        return Inertia::location(route('analytics'));
    }

    public function destroy()
    {
        $website = auth()->user()->currentWebsite;

        // update all users with current website equal it to null
        $website->users()->update(['current_website_id' => null]);

        // delete website
        $website->delete();

        session()->flash('flash.banner', 'Website deleted successfully.');
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('websites.create');
    }

    public function favicon($url)
    {
        try {
            $favicon = file_get_contents("https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=https://{$url}&size=128");
        } catch (\Throwable $th) {
            $favicon = file_get_contents(public_path('/images/websites/favicon.png'));
        }

        return response($favicon)->header('Content-Type', 'image/png');
    }
}
