<?php

namespace Tests\Browser\Pages\Site;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PrivacyTest extends DuskTestCase
{
    /**
     * @group site
     */
    public function test_privacy_page_can_be_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('site.privacy'))
                ->assertSee('Privacy Policy');
        });
    }
}
