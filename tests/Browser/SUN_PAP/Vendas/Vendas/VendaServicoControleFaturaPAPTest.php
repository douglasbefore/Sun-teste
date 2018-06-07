<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaServicoControleFaturaPAPTest extends DuskTestCase
{
    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Não
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaValidarClienteAlta
     * @group ServicoMovelControleFaturaValidarClienteAlta
     * @return void
     */
    public function testServicoMovelControleFaturaClienteAlta()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleFatura);
            $funcoes->loadCarregandoCampoNull($browser, ControleFatura::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $valuePlano = $funcoes->retornaValueOption($browser,ControleFatura::OptionPlano, 'Controle Digital');
            $browser->select(ControleFatura::SelectPlano, $valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteAlta);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioPortabilidadeNao);
            $browser->type(ControleFatura::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioFaturaViaPostal);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->elements(ControleFatura::RadioDataVencimento)[1]->click();

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaValidarClienteAltaPortabilidade
     * @group ServicoMovelControleFaturaValidarClienteAltaPortabilidade
     * @return void
     */
    public function testServicoMovelControleFaturaClienteAltaPortabilidade()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleFatura);
            $funcoes->loadCarregandoCampoNull($browser, ControleFatura::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $valuePlano = $funcoes->retornaValueOption($browser,ControleFatura::OptionPlano, 'Controle Digital');
            $browser->select(ControleFatura::SelectPlano, $valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteAlta);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioPortabilidadeSim);
            $browser->assertVisible(ControleFatura::CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::SelectOperadora);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $valueOperadora = $funcoes->retornaValueOption($browser,ControleFatura::OptionOperadora, 'Claro');
            $browser->select(ControleFatura::SelectOperadora, $valueOperadora);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioFaturaViaPostal);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->elements(ControleFatura::RadioDataVencimento)[1]->click();

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     *  - Operadora: Outros
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteAltaPortabilidadeOutros
     * @group ServicoMovelControleFaturaClienteAltaPortabilidadeOutros
     * @return void
     */
    public function testServicoMovelControleFaturaClienteAltaPortabilidadeOutros()
    {
        new VendaServicosElementsPAP();

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $comecoVenda = new VendaPAPTest();
            $comecoVenda::$arrayTipoServicos = [TipoServicos::BotaoMovel];
            $comecoVenda->testInserirVendaVendedorMovel();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoMovelControleFatura);
            $funcoes->loadCarregandoCampoNull($browser, ControleFatura::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $valuePlano = $funcoes->retornaValueOption($browser,ControleFatura::OptionPlano, 'Controle Digital');
            $browser->select(ControleFatura::SelectPlano, $valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteAlta);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioPortabilidadeSim);
            $browser->assertVisible(ControleFatura::CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::SelectOperadora);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $valueOperadora = $funcoes->retornaValueOption($browser,ControleFatura::OptionOperadora, 'Outros');
            $browser->select(ControleFatura::SelectOperadora, $valueOperadora);
            $browser->assertVisible(ControleFatura::CampoOutraOperadora);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoOutraOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoOutraOperadora, 'teste');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoOutraOperadora);
            $browser->assertVisible(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioFaturaEmail);
            $browser->assertVisible(ControleFatura::CampoEmail);
            $browser->value(ControleFatura::CampoEmail, '');
            $browser->type(ControleFatura::CampoEmail, 'teste');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_CampoEmail);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoEmail, '');
            $browser->type(ControleFatura::CampoEmail, 'teste_teste_teste@teste.com');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertMissing(ControleFatura::Validar_SelectOperadora);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertMissing(ControleFatura::Validar_CampoEmail);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->elements(ControleFatura::RadioDataVencimento)[1]->click();

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

}
