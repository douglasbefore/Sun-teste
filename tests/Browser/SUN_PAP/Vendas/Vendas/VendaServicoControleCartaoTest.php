<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;

class VendaServicoControleCartaoTest extends DuskTestCase
{
    /**
     * Verifica se após selecionar serviço Controle Cartão, esta desabilitando os serviços
     * que não são permitidos junto com o Fatura.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleControleOutrosServicosDesabilitados
     * @group ServicoMovelControleControleOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelControleControleOutrosServicosDesabilitados()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->press(IncluirServicos::BotaoMovelControleCartao);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);

            $browser->assertVisible(IncluirServicos::BotaoMovelControleFaturaDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelFixoFWT);
            $browser->assertVisible(IncluirServicos::BotaoMovelControleCartaoDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelControlePassDigitalDesabilitado);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de cliente Alta
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartaoValidarClienteAlta
     * @group ServicoMovelControleCartaoValidarClienteAlta
     * @return void
     */
    public function testValidarServicoMovelControleCartaoClienteAlta()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
//            $browser->waitFor(CampoVenda::BotaoContinuar);
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
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleCartao);
            $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleCartao::Validar_SelectPlano);
            $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

            $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
            $browser->select(ControleCartao::SelectPlano, $valuePlano['value']);
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

            $browser->press(CampoVenda::BotaoEnviarPedido);

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }
}
