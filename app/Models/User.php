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


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, Billable;

    const ROLE_OWNER = 'OWNER';
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone_id'
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
        'trial_ends_at' => 'datetime'
    ];

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

    public function belongsToWebsite($website)
    {
        return $this->websites->contains(function ($t) use ($website) {
            return $t->id === $website->id;
        });
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function websites()
    {
        return $this->belongsToMany(Website::class)->withPivot('role')->as('membership')->withTimestamps();
    }
}
