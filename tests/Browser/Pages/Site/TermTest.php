<?php

namespace Tests\Browser\Pages\Site;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TermTest extends DuskTestCase
{
    /**
     * @group site
     */
    public function test_term_page_can_be_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('site.terms'))
                ->assertSee('Terms of service');
        });
    }
}
