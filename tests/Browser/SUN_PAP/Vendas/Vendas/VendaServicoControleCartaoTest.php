<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaServicoControleCartaoTest extends DuskTestCase
{

    /**,,,
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de cliente Alta
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartaoValidarClienteAlta
     * @group ServicoMovelControleCartaoValidarClienteAlta
     * @return void
     */
    public function testValidarServicoMovelControleCartaoClienteAlta()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {

            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);
            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);
            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->click(ControleCartao::RadioTipoClienteAlta);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoICCID);

            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertVisible(ControleCartao::Validar_CampoICCID);

            $browser->type(ControleCartao::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Realiza uma venda com controle Cartao Cliente alta
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testServicoMovelControleCartaoClienteAlta()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {

            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);
            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);

            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);
            $browser->waitFor(ControleCartao::SelectPlano);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->click(ControleCartao::RadioTipoClienteAlta);
            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());
            $browser->type(ControleCartao::CampoICCID, FuncoesPhp::geraICCIDRandomico());

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de Migração
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testValidarCamposServicoMovelControleCartaoTipoMigracao()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {

            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);
            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);
            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
            $browser->press(ControleCartao::RadioTipoClienteMigracao);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleCartao::CampoICCID);
            $browser->assertMissing(ControleCartao::Validar_CampoICCID);

            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleCartao::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleCartao::CampoICCID);
            $browser->assertMissing(ControleCartao::Validar_CampoICCID);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Realiza uma venda com controle Cartao Cliente Migração
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testServicoMovelControleCartaoClienteMigracao()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {

            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);
            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);

            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);
            $browser->waitFor(ControleCartao::SelectPlano);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->click(ControleCartao::RadioTipoClienteMigracao);
            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testValidarCamposServicoMovelControleCartaoTipoUpgrade()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);
            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
            $browser->press(ControleCartao::RadioTipoClienteUpgrade);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleCartao::CampoICCID);
            $browser->assertMissing(ControleCartao::Validar_CampoICCID);

            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleCartao::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleCartao::CampoICCID);
            $browser->assertMissing(ControleCartao::Validar_CampoICCID);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Realiza uma venda com controle Cartao Cliente Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testServicoMovelControleCartaoClienteUpgrade()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {

            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeRealizandoAnalise);
            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);

            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);
            $browser->waitFor(ControleCartao::SelectPlano);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano,$valuePlano);
            $browser->click(ControleCartao::RadioTipoClienteUpgrade);
            $browser->type(ControleCartao::CampoNumeroCliente, FuncoesPhp::gerarCelularRandomico());

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }
}
