<?php

namespace Tests\Browser\Pages\Funcoes;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class UrlPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */

    public function url()
    {
        if(env('USE_AMBIENTE') == 'beta' ){
            return env('BETA_APP_URL');
        }else{
            return env('LOCAL_APP_URL');
        }
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        //$browser->assertPathIsNot($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }

}



