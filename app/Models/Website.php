<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Website extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'public' => 'boolean',
    ];

    const METRICS = [
        'online',
        'overview',
        'chart',
        'pages',
        'entry-pages',
        'exit-pages',
        'referrers',
        'utm-sources',
        'utm-mediums',
        'utm-campaigns',
        'utm-contents',
        'utm-terms',
        'browsers',
        'os',
        'devices',
        'languages',
        'countries',
        'regions',
        'cities'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->as('membership')->withTimestamps();
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
