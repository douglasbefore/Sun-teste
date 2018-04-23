<?php

namespace Tests\Browser\Pages\Funcoes;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use Tests\Browser\Pages\Elementos\CaminhoMenu as Caminho;

class FuncoesMenu extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
//        return '/';
    }

    /**
     * Assesar o menu escolido pela fun��o teste.
     *
     * @param Browser $browser
     * @param string $menu
     * @return void
     */

    public function EntrarMenu(Browser $browser, $menu)
    {
        $browser->waitFor('#menu', 60);

        $Canal = FuncaoLogin::getCanalUsuario();

        foreach (Caminho::ListagemMenu($Canal)[$menu]['Caminho'] as $key => $caminho) {

                $MenuEstaFechado = false;

                if ($key == 'Menu') {
                    // busca a informação do menu, para verificar se o menu ja esta aberto ou não.
                    $texto = $browser->script('var elem = document.getElementById("' . str_replace('#', '', $caminho[0]) . '").className; return elem;');

                    $MenuEstaFechado = (strpos($texto[0], 'open') !== false);
                }

                if ($key == 'Grupo') {

                    $browser->waitFor('#subCapa', 20);
                    $var = "var text = document.querySelectorAll('.box-header'); for(i=0;i<text.length;i++){ if(text[i].innerText.indexOf('" . $caminho[0] . "')==1){ return i; }}";

                    $CountSubCapa = $browser->script($var);
                    $browser->script("jQuery.find('.box-header')[\"{$CountSubCapa[0]}\"].click();");

                } elseif ($key == 'BotaoItem') {
                    $botaoClass = $caminho[1];
                    $botaoDescricao = $caminho[2];

                    $browser->waitFor($caminho[0]);
                    $browser->with($caminho[0], function ($Botao) use ($botaoClass, $botaoDescricao) {
                        $Botao->click($botaoClass, $botaoDescricao);
                    });
                } elseif ($key != 'FormTela') {
                    if (!$MenuEstaFechado) {
                        $browser->waitFor($caminho[0], 20);
                        $browser->click($caminho[0]);
                        $browser->assertVisible($caminho[0]);
                    }
                } else {
                    $browser->waitFor($caminho[0], 20);
                    $browser->assertSee($caminho[1]);
                }
        }
    }
}
