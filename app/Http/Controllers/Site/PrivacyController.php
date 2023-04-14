<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Str;

use Inertia\Inertia;

class PrivacyController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Privacy', [
            'policy' => Str::markdown(file_get_contents(resource_path('markdown/privacy.md'))),
        ]);
    }
}
