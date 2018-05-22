<?php

namespace Tests\Browser\SUN_PDR\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\SUN_PDR\vendas\vendas\VendaPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;


class VendaTest extends DuskTestCase
{
    private static $canal = FuncaoLogin::CANAL_PDR;

    /**
     *

     * @throws \Exception
     * @throws \Throwable
     * @Test InserirVendaPDRVendedor
     * @group InserirVendaPDRVendedor
     */
    public function testInserirVendaPDRVendedor()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirVenda';

            $browser->on(new FuncaoLogin);
//          $browser->FazerLogin(self::$canal, '02717678123');
            $browser->FazerLogin(self::$canal, '79663451149');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $browser->on(new VendaPage);

            $browser->type('@CampoClienteCPF', $cpf = FuncoesPhp::gerarCPF(1));
            $browser->click('@CampoClienteCarregarCPF');
            $browser->pause(1000);
            $browser->click('@AlertCPFSemCadastro360');
            $browser->type('@CampoClienteNome', $nome = FuncoesPhp::geraNomeRandomico());
            $browser->type('@CampoClienteDataNascimento','090811988');
            $browser->type('@CampoClienteNomeMae',$mae=FuncoesPhp::geraNomeRandomico());
            $browser->type('@CampoClienteCEP','79071160');
            $browser->click('@CampoClienteCarregarCEP');
            $browser->click('@BotaoContinuarSemAnalise');
            if($browser->element('@BotaoServicoPassDigital')->isDisplayed() || $browser->element('@BotaoServicoFatura')->isDisplayed()){
                $browser->click('@BotaoServicoPassDigital');
                $browser->click('@BotaoServicoFatura');
            }

            $browser->pause(50000);




        });
    }
}
