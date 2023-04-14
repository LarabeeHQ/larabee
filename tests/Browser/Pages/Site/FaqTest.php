<?php

namespace Tests\Browser\Pages\Site;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FaqTest extends DuskTestCase
{
    /**
     * @group site
     */
    public function test_faq_page_can_be_displayed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('site.faq'))
                ->assertSee('Frequently asked questions');
        });
    }
}
