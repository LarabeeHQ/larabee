<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PageView extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->created_at ? $model->created_at : now();
        });
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
