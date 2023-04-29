<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Enums\UserRole;
use App\Enums\UserTheme;

use App\Models\User;
use App\Models\Website;
use App\Models\Language;
use App\Models\Timezone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'trial_ends_at' => now()->addMonth(),
            'theme' => UserTheme::THEME_SYSTEM,
            'language_id' => Language::where('locale', 'en')->first()->id,
            'accepted_terms_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withWebsiteAndAdmin()
    {
        return $this->afterCreating(function (User $user) {

            // create a website
            $website = Website::factory()->create();

            // add the user to the team
            $user->teams()->attach($website->id, ['role' => UserRole::ROLE_OWNER, 'onboarding' => false]);

            // set the current team
            $user->current_website_id = $website->id;
            $user->save();
        });
    }
}
