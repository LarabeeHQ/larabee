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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

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

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function page_views()
    {
        return $this->hasMany(PageView::class);
    }

    public function first_page_view()
    {
        return $this->hasOne(PageView::class)->orderBy('created_at', 'asc');
    }

    public function last_page_view()
    {
        return $this->hasOne(PageView::class)->latest();
    }

    public static function generateHash($websiteId, $hostname, $ip, $userAgent)
    {
        return hash('md5', "{$websiteId}-{$hostname}-{$ip}-{$userAgent}");
    }
}
