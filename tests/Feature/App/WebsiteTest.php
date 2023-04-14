<?php

namespace Tests\Feature\App;

use App\Models\User;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    public function test_can_visit_website_create_page()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('websites.create'));

        $response->assertOk();
    }
}
