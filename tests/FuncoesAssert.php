<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 30/01/18
 * Time: 13:26
 */

namespace Tests;

//use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

trait FuncoesAssert
{

    public function assertCampoDisable(Browser $browser, $selector)
    {
        DuskTestCase::assertFalse($browser->element($selector)->isEnabled(), 'O campo ['. $selector .'] não esta desabilitado!');
    }

    public function assertCampoNotDisable(Browser $browser, $seletorID)
    {
        DuskTestCase::assertTrue($browser->element($seletorID)->isEnabled(), 'O campo ['. $seletorID .'] n�o esta abilitado!');
    }

    public function alertaErroSistema(Browser $browser, $nomeAlerta, $mensagem, $tempoSegundosEspera = 10){
        $browser->waitFor($nomeAlerta, $tempoSegundosEspera);
        $browser->assertSee($mensagem);
        $browser->click($nomeAlerta);
    }

    /**
     * Assert
     *
     * @param  string  $selector
     * @return $this
     */
    public function assertVisibasdfle($selector)
    {
        $fullSelector = $this->resolver->format($selector);

        PHPUnit::assertTrue(
            $this->resolver->findOrFail($selector)->isDisplayed(),
            "Element [{$fullSelector}] is not visible."
        );

        return $this;
    }

}