<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PageView extends Model
{
    use HasFactory, HasUuids;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
