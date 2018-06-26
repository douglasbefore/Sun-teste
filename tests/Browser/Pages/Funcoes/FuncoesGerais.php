<?php

namespace Tests\Browser\Pages\Funcoes;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FuncoesGerais extends Page
{
    private static $Padrao = 120;

    /**
     * Funçãoo para utilizar quando a muitos check list na tela de cadastro.
     * Forçando assim testar todas.
     *
     * @param  Browser $browser
     * @param  array $elemento
     * @return void
     */
    public function elementoCheck(Browser $browser, $elemento, $elementoIds, $SomenteVerificar = false)
    {
        foreach ($elemento[$elementoIds] as $checksIds => $CheckAcoes) {

            $idCheck = $elementoIds . '[]';
            $idDivCheck = '#' . $elementoIds . '_' . $checksIds;
            $textoCheck = $CheckAcoes['texto'];

            // Verifica a descri��o do ckeckbox.
            $browser->with($idDivCheck, function (Browser $table) use ($textoCheck) {
                $table->assertSee($textoCheck);
            });

            // Verifica se a op��o tem que vir selecionada.
            if ($SomenteVerificar) {
                if ($CheckAcoes['Default'] == 1) {
                    $browser->assertChecked($idCheck, $checksIds);
                } else {
                    $browser->assertNotChecked($idCheck, $checksIds);
                }
            } else {
                if ($CheckAcoes['Acao'] == 1) {
                    $browser->check($idCheck, $checksIds);
                }
            }
        }
    }

    /**
     * Funçao para esperar acabar o load de carregar do sistema.
     *
     * @param  Browser $browser
     * @return bool
     */
    public function loadCarregando($browser, $selector = '#load')
    {
        $browser->pause(500);
        if (!$browser->element($selector)->isDisplayed()) {
            return true;
        } else {
            $browser->pause(500);
            self::loadCarregando($browser, $selector);
        }
    }

    /**
     * Funçao para esperar acabar os loads que apos finalizar sao removidos do html.
     *
     * @param  Browser $browser
     * @return bool
     */
    public function loadCarregandoCampoNull($browser, $selector = '#load', $tempo = null)
    {
        $tempoPadrao = $tempo!=null ? $tempo : self::$Padrao;

        do {
            $selectorEnabled = $browser->element($selector);
            $browser->pause(500);
            $tempoPadrao--;
            $retorno = !(isset($selectorEnabled) XOR ($tempoPadrao != 0));
        } while ($retorno);

        if($tempoPadrao<=0){
            $browser->assertSee($selector);
        }
    }

    /**
     * Funçao para esperar ate o selector fique abilitado.
     *
     * @param  Browser $browser
     * @return bool
     */
    public function elementsIsEnabled($browser, $selector)
    {
        $tempoPadrao = self::$Padrao;
        do {
            $selectorEnabled = $browser->element($selector)->isEnabled();
            $browser->pause(500);
            $tempoPadrao--;
            $retorno = !(empty($selectorEnabled) XOR ($tempoPadrao != 0));
        } while ($retorno);

        if($tempoPadrao<=0){
            $browser->assertSee($selector);
        }
    }

    /**
     * Funçao para esperar ate o selector fique abilitado.
     *
     * @param  Browser $browser
     * @return bool
     */
    public function retornaValueOption($browser, $selector, $text)
    {
        $valueOperadora = $browser->elements($selector);

        foreach ($valueOperadora as $operadora){
            if(strpos(strtolower($operadora->getText()), strtolower($text))) {
                return $operadora->getAttribute('value');
            }
        }
        return 0;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        // TODO: Implement url() method.
    }
}
