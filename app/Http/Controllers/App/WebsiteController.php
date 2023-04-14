<?php

namespace App\Http\Controllers\App;

use App\Repositories\WebsiteRepository;

use Illuminate\Support\Facades\Gate;

use App\Enums\UserRole;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Website;

class WebsiteController extends Controller
{
    /**
     * The website repository implementation.
     *
     * @var WebsiteRepository
     */
    protected $website;

    public function __construct(WebsiteRepository $website)
    {
        $this->website = $website;
    }

    public function create()
    {
        return Inertia::render('App/Website/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'domain' => 'required',
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
            'domain' => 'required',
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
}
