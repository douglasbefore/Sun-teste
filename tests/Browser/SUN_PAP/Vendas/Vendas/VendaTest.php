<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;


use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Browser\Pages\SUN_PAP\Vendas\Vendas\VendaPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * @throws \Exception
     * @throws \Throwable
     * @Test InserirVendaVendedor
     * @group InserirVendaVendedor
     */
    public function testInserirVendaVendedor()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
//            $browser->FazerLogin(self::$canal, '02717678123');
            $browser->FazerLogin(self::$canal, '05114040189');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $browser->on(new VendaPage);

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, '@AlertaRequisicaoToken');

            $browser->element('@BotaoContinuar')->isDisplayed();

            $cpf = FuncoesPhp::gerarCPF(1);
            $browser->type('@CampoClienteCPF', $cpf);
            $browser->element('@BotaoContinuar')->isDisplayed();
            $browser->click('@BotaoServicoMovel');

            $browser->element('@BotaoContinuar')->isEnabled();
            $browser->press('@BotaoContinuar');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCarregandoDados');
            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCadastroCPF360');

            $dadosCliente = new VendaPAPFuncao();
            $dadosCliente->PreencherCamposDadosCliente($browser);

            $browser->element('@BotaoContinuar')->isEnabled();
            $browser->press('@BotaoContinuar');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCarregandoDados');

            $browser->type('@CampoEnderecoCep', '79002-212');
            $browser->type('@CampoEnderecoNumero', '780');
            $funcoes->loadCarregandoCampoNull($browser, '@AlertaEnderecoCarregandoCidade');


            $browser->element('@BotaoContinuar')->isEnabled();
            $browser->press('@BotaoContinuar');

            $browser->pause(500);
        });
    }
}
