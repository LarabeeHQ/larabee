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

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->as('membership')->withTimestamps();
    }
}
