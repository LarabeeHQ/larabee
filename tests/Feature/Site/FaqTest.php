<?php

namespace Tests\Feature\Site;

use Tests\TestCase;

class FaqTest extends TestCase
{
    public function test_faq_page_can_be_displayed(): void
    {
        $response = $this->get(route('site.faq'));

        $response->assertOk();
    }
}
