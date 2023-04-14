<?php

namespace Tests\Browser\Pages\Site;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomeTest extends DuskTestCase
{
    /**
     * @group site
     */
    public function test_home_page_can_be_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('site.home'))
                ->assertSee('Are you ready to Launch your SaaS today?');
        });
    }
}
