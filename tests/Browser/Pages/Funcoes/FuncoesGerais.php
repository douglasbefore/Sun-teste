<?php

namespace Tests\Browser\Pages\Funcoes;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FuncoesGerais extends Page
{
     /**
      * Funçãoo para utilizar quando a muitos check list na tela de cadastro.
      * Forçando assim testar todas.
      *
      * @param  Browser $browser
      * @param  array $elemento
      * @return void
      */
    public function ElementoCheck(Browser $browser, $elemento, $elementoIds, $SomenteVerificar = false)
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
     * Função para acessar as abas que existem nos telas de cadastros
     *
     * @param  Browser $browser
     * @param  string $divAba
     * @param  string $linkAba
     * @return void
     */
    public function SelecionarAba(Browser $browser, $Href, $ClasseHref)
    {

        $IdAba = $browser->elements($ClasseHref);

        $browser->waitFor($IdAba);

        $browser->RolarBarraSeletor($IdAba);
        // Pega as cordenadas em qual posi��o esta o elemento a ser clicado;
//        $coordenadas = $browser->element($IdAba)->getLocation();
//        $tamanho = $browser->element($IdAba)->getSize();
//
//        $browser->script("window.scrollTo(" . ($coordenadas->getX() + $tamanho->getHeight()) . ", 0);");

        $browser->click($IdAba);

    }

    /**
     * Função rolar barra de rolagem até o campo para ser clicado.
     *
     * @param  Browser $browser
     * @param  string $Seletor
     * @return void
     */
    public function RolarBarraSeletor(Browser $browser, $Seletor)
    {

        // Pega as cordenadas em qual posi��o esta o elemento a ser clicado;
        $coordenadas = $browser->element($Seletor)->getLocation();
        $tamanho = $browser->element($Seletor)->getSize();

        $browser->script("window.scrollTo(" . ($coordenadas->getX() + $tamanho->getHeight()) . ", 0);");
    }

    /**
     * Função para acessar as abas que existem nos telas de cadastros
     *
     * @param  Browser $browser
     * @param  string $grupoBotao
     * @param  string $botaoClass
     * @param  string $botaoDescricao
     * @return void
     */
    public function ClickBotaoFlutuante(Browser $browser, $grupoBotao, $botaoDescricao)
    {
        $browser->with($grupoBotao, function ($Botao) use ($botaoDescricao) {
            $Botao->click($botaoDescricao);
        });
    }

    /**
     * Função para esperar acabar o load de carregar do sistema.
     *
     * @param  Browser $browser
     * @return bool
     */
    public function loadCarregando(Browser $browser, $selector = '#load'){

        if(isset($selector)) {
            if (!$browser->element($selector)->isDisplayed()) {
                return true;
            } else {
                $browser->pause(500);
                self::loadCarregando($browser, $selector);
            }
        }
    }

    public function loadCarregandoCampoNull(Browser $browser, $selector = '#load'){
            if (!$browser->element($selector)) {
                return true;
            } else {
                $browser->pause(500);
                self::loadCarregando($browser, $selector);
            }
    }
//while (isset($campo_token)) {
//    $campo_token = $browser->element('@AlertaRequisicaoToken');
//    $browser->pause(500);
//}


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
