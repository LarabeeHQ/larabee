<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Storage;

use App\Models\Traits\HasWebsites;

use App\Enums\UserTheme;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, Billable, HasWebsites;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone_id',
        'theme',
        'current_website_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'theme' => UserTheme::class,
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'photo_url',
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? Storage::url($this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=9CA3AF&length=1';
    }

    public function getPlanAttribute()
    {
        if (!$this->subscription('default')) {
            return ['name' => 'trial'];
        };

        $plans = config('plans.index');
        $stripeId = $this->subscription('default')->items->first()->stripe_price;

        foreach($plans as $plan) {
            if ($plan['stripeIdMonthly'] === $stripeId) {
                return $plan;
            }

            else if ($plan['stripeIdYearly'] === $stripeId) {
                return $plan;
            }
        }
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
