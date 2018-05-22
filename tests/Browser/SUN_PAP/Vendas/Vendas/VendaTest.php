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

            $cpf = FuncoesPhp::gerarCPF(1);
            $browser->type('@CampoClienteCPF', $cpf);
            $browser->click('@BotaoServicoMovel');

            $funcoes->elementsIsEnabled($browser,'@BotaoContinuar');
            $browser->press('@BotaoContinuar');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCarregandoDados');
            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCadastroCPF360');

            $funcoeVenda = new VendaPAPFuncao();
            $funcoeVenda->PreencherCamposDadosCliente($browser);

            $funcoes->elementsIsEnabled($browser,'@BotaoContinuar');
            $browser->press('@BotaoContinuar');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaCarregandoDados');

            $browser->type('@CampoEnderecoCep', '79020-250');
            $browser->type('@CampoEnderecoNumero', '780');
            $funcoes->loadCarregandoCampoNull($browser, '@AlertaEnderecoCarregandoCidade');

            $funcoes->elementsIsEnabled($browser,'@BotaoContinuar');
            $browser->press('@BotaoContinuar');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaAgurdeRealizandoAnalise');

            $browser->click('@BotaoRecolherAnalise');
            $browser->pause(500);
            $browser->press('@BotaoServicoMovelControleCartao');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaServicoControleCartaoTipoCarregandoPlanos');
            $browser->waitFor('@SelectServicoControleCartaoPlano');
            $browser->select('@SelectServicoControleCartaoPlano',1123);
            $browser->click('@BotaoServicoControleCartaoTipoClienteAlta');
            $browser->type('@CampoServicoControleCartaoNumeroCliente', '67978485486');
            $browser->type('@CampoServicoControleCartaoICCID', '895599849844568854678945');

            $funcoes->elementsIsEnabled($browser,'@BotaoContinuar');
            $browser->press('@BotaoContinuar');
            $browser->press('@BotaoEnviarPedido');

            $funcoes->loadCarregandoCampoNull($browser, '@AlertaAgurdeCarregandoDados');
            $browser->assertVisible('@MensagemPedidoConcluidoSucesso');

        });
    }
}
