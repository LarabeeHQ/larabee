<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\User;
use App\Models\Timezone;

class RegisteredUserController extends Controller
{
    public function create()
    {
        if(config('app.self_hosted')) {
            return redirect(route('login'));
        }
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->timezone_id = Timezone::where('value', 'America/Sao_Paulo')->first()->id;
        $user->trial_ends_at = now()->addMonth();
        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('websites.create'));
    }
}
