<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Session extends Model
{
    use HasFactory, HasUuids;

    const DEVICE_MOBILE = 'mobile';
    const DEVICE_TABLET = 'tablet';
    const DEVICE_DESKTOP = 'desktop';

    public $timestamps = false;

    protected $fillable = [
        'website_id',
        'hostname',
        'browser',
        'os',
        'device',
        'screen',
        'language',
        'country',
        'region',
        'city',
        'utm_medium',
        'utm_source',
        'utm_campaign',
        'utm_content',
        'utm_term'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->created_at = $model->created_at ? $model->created_at : now();
        });
    }

    public function website(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function pageViews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PageView::class);
    }

    public static function generateHash($websiteId, $hostname, $ip, $userAgent)
    {
        return hash('md5', "{$websiteId}-{$hostname}-{$ip}-{$userAgent}");
    }
}
