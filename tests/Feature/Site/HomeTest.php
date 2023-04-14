<?php

namespace Tests\Feature\Site;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function test_home_page_can_be_displayed(): void
    {
        $response = $this->get(route('site.home'));

        $response->assertOk();
    }
}
