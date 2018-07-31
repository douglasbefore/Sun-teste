<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\Pages\Funcoes;

use Facebook\WebDriver\Remote\RemoteWebElement;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Concerns\InteractsWithElements;
use phpDocumentor\Reflection\Element;
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
     * Funçao para rolar a barra de rolagem até o elemento.
     *
     * @param  Browser $browser
     * @param $seletor
     * @param null $id
     */
    public function barraRolagemElemento(Browser $browser, $seletor, $id = null){
        $posicaoTopoPagina = $browser->driver->executeScript('return posicaoTopoPagina = $(window).scrollTop();');

        if(is_null($id)) {
            $tamanhoElemento = $browser->driver->executeScript('return $("' . $seletor . '").height();');
            $posicaoElemento = $browser->element($seletor)->getLocation()->getY();
        }else{
            $tamanhoElemento = $browser->driver->executeScript('var itens = $("' . $seletor . '").map(function () {
                                                                                return $(this).height();
                                                                            }).get();
                                                                       return itens['.$id.'];');
            $posicaoElemento = $browser->elements($seletor)[$id]->getLocation()->getY();
        }

        if($posicaoTopoPagina > $posicaoElemento){
            $y = $posicaoElemento-$tamanhoElemento;
        }else{
            $y = $posicaoElemento+$tamanhoElemento;
        }


//        $elementLocal = $browser->element($seletor)->getLocation();
//        $x= $elementLocal->getX();
//        $y= $pagina-$elementLocal->getY();
        $browser->driver->executeScript('window.scrollTo(0, '. $y. ');');
    }

    /**
     * Funçao para rolar a barra de rolagem até o id retornado do elements.
     *
     * @param  Browser $browser
     * @var $id RemoteWebElement
     */
    public function barraRolagemElementoId(Browser $browser, $seletor, $id){
        $pagina = $browser->driver->executeScript('return $height = $(window).scrollTop();');

        $elementLocal = $id->getLocation();
        $x= $elementLocal->getX()+10;
        $y= $pagina-$elementLocal->getY()+10;
        $browser->driver->executeScript('window.scrollTo('. $x .','. $y .');');
    }

    /**
     * Funçao para esperar acabar o load de carregar do sistema.
     *
     * @param  Browser $browser
     * @param string $selector
     * @return bool
     */
    public function loadCarregando(Browser $browser, $selector = '#load')
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
     * @param string $selector
     * @param null $tempo
     * @return void
     */
    public function loadCarregandoCampoNull(Browser $browser, $selector = '#load', $tempo = null)
    {
        $tempoPadrao = $tempo!=null ? $tempo : self::$Padrao;
        $browser->pause(200);
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
     * @param $selector
     * @return void
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
     * @param $selector
     * @param $text
     * @return array
     */
    public function retornaValueOption($browser, $selector, $text = null)
    {
        $valueOption = $browser->elements($selector);

        if(!is_null($text)) {
            foreach ($valueOption as $option) {
                if (strpos(strtolower($option->getText()), strtolower($text))) {
                    return array("value" => $option->getAttribute('value'),
                                 "text" => $option->getAttribute('text'));
                }
            }
        }
        else{
            $random = rand(1, count($valueOption) - 1);

            return array("value" => $valueOption[$random]->getAttribute('value'),
                         "text"  => $valueOption[$random]->getAttribute('text'));
        }
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
