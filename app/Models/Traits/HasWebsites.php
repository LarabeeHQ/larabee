<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Website;
use App\Enums\UserRole;

trait HasWebsites
{
    public function websites()
    {
        return $this->belongsToMany(Website::class)->withPivot('role')->as('membership')->withTimestamps();
    }

    public function isCurrentWebsit($website)
    {
        return $website->id === $this->currentWebsite->id;
    }

    public function allWebsite()
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
        ->with('websites', function ($query) use ($website) {
            $query->where('websites.id', $website->id);
        })
        ->first();

        return $user->websites->first()->membership->role;
    }

    public function ownsWebsite($website)
    {
        if (is_null($website)) {
            return false;
        }

        return $this->websiteRole($website) === UserRole::ROLE_OWNER->value;
    }


    public function isAdminOnWebsite($website)
    {
        if (is_null($website)) {
            return false;
        }

        return $this->websiteRole($website) !== UserRole::ROLE_USER->value;
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
}
