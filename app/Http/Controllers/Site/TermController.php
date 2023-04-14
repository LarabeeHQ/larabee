<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Str;

use Inertia\Inertia;

class TermController extends Controller
{
    public function index()
    {
        return Inertia::render('Site/Term', [
            'terms' => Str::markdown(file_get_contents(resource_path('markdown/term.md'))),
        ]);
    }
}
