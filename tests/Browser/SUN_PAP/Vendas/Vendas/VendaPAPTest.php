<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
//use Tests\Browser\Pages\SUN_PAP\Vendas\Vendas\CampoVenda;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaPAPTest extends DuskTestCase
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
        new VendaServicosElementsPAP();
        new VendaElementsPAP();

        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
//            $browser->FazerLogin(self::$canal, '02717678123');
            $browser->FazerLogin(self::$canal, '05114040189');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $cpf = FuncoesPhp::gerarCPF(1);
            $browser->type(CampoVenda::CampoVendaCPFCliente, $cpf);
            $browser->click(CampoVenda::BotaoServicoMovel);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCarregandoDados);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCadastroCPF360);

            $funcoesVenda = new VendaPAPFuncao();
            $funcoesVenda->PreencherCamposDadosCliente($browser);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCarregandoDados);

            $browser->type(CampoVenda::CampoEnderecoCep, '79020-250');
            $browser->type(CampoVenda::CampoEnderecoNumero, '780');
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaEnderecoCarregandoCidade);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(CampoVenda::BotaoServicoMovelControleCartao);

            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);
            $browser->waitFor(ControleCartao::SelectPlano);
            $browser->select(ControleCartao::SelectPlano,1123);
            $browser->click(ControleCartao::BotaoTipoClienteAlta);
            $browser->type(ControleCartao::CampoNumeroCliente, '67978485486');
            $browser->type(ControleCartao::CampoICCID, '895599849844568854678945');

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);

        });
    }
}
