<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

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
    ];

    public function isCurrentWebsite($website)
    {
        return $website->id === $this->currentWebsite->id;
    }

    public function allWebsites()
    {
        return $this->websites->sortBy('name');
    }

    public function currentWebsite()
    {
        return $this->belongsTo(Website::class, 'current_website_id');
    }

    public function belongsToWebsite($website)
    {
        return $this->websites->contains(function ($t) use ($website) {
            return $t->id === $website->id;
        });
    }

    public function websiteRole($website)
    {
        if (!$this->belongsToWebsite($website)) {
            return;
        }

        $user = $this->whereHas('websites', function (Builder $query) use ($website) {
            $query->where('websites.id', $website->id);
        })
            ->where('id', $this->id)
            ->with('websites')
            ->first();

        return $user->websites->first()->membership->role;
    }

    public function hasWebsiteRole($website, $role)
    {
        if (!$this->belongsToWebsite($website)) {
            return;
        }

        $user = $this->whereHas('websites', function (Builder $query) use ($website) {
            $query->where('websites.id', $website->id);
        })
            ->where('id', $this->id)
            ->with('websites')
            ->first();

        return $user->websites->first()->membership->role === $role;
    }

    public function switchWebsite($website)
    {
        if (!$this->belongsToWebsite($website)) {
            return false;
        }

        $this->forceFill([
            'current_website_id' => $website->id,
        ])->save();

        $this->setRelation('currentWebsite', $website);

        return true;
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    public function websites()
    {
        return $this->belongsToMany(Website::class)->withPivot('role')->as('membership')->withTimestamps();
    }

    public function getAvatarAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=FFFFFF&background=9CA3AF&length=1';
    }
}
