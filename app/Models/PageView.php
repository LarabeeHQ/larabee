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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'created_at_formatted',
    ];

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('M d, Y h:i A');
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
