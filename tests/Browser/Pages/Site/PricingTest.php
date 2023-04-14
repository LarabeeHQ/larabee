<?php

namespace Tests\Browser\Pages\Site;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PricingTest extends DuskTestCase
{
    /**
     * @group site
     */
    public function test_pricing_page_can_be_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('site.pricing'))
                ->assertSee('Simple And Transparent Pricing');
        });
    }
}
