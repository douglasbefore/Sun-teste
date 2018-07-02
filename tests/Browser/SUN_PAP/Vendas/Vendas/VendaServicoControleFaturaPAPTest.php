<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;

class VendaServicoControleFaturaPAPTest extends DuskTestCase
{

    /**
     * Verifica se após selecionar serviço Controle Fatura, esta desabilitando os serviços
     * que não são permitidos junto com o Fatura.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaOutrosServicosDesabilitados
     * @group ServicoMovelControleFaturaOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelControleFaturaOutrosServicosDesabilitados()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoMovelControleFatura);
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
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControleFaturaClienteAlta($browser, $dadosVenda);

            $funcoes = new FuncoesGerais();
            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

    public function ServicoMovelControleFaturaClienteAlta(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControleFatura::NomeDoServico);

        $browser->press(IncluirServicos::BotaoMovelControleFatura);
        $funcoes->loadCarregandoCampoNull($browser, ControleFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControleFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleFatura::Validar_SelectPlano);
        $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleFatura::Validar_RadioFatura);
        $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,ControleFatura::OptionPlano, 'Controle Digital');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleFatura::Validar_SelectPlano);
        $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleFatura::Validar_RadioFatura);
        $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControleFatura::RadioTipoClienteAlta)->getText());
        $browser->press(ControleFatura::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleFatura::Validar_SelectPlano);
        $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleFatura::Validar_CampoICCID);
        $browser->assertVisible(ControleFatura::Validar_RadioFatura);
        $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(ControleFatura::RadioPortabilidadeNao)->getText());
        $browser->press(ControleFatura::RadioPortabilidadeNao);
        $browser->type(ControleFatura::CampoICCID, FuncoesPhp::geraICCIDRandomico());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleFatura::Validar_SelectPlano);
        $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(ControleFatura::Validar_CampoICCID);
        $browser->assertVisible(ControleFatura::Validar_RadioFatura);
        $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControleFatura::RadioFaturaViaPostal)->getText());
        $browser->press(ControleFatura::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleFatura::Validar_SelectPlano);
        $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(ControleFatura::Validar_CampoICCID);
        $browser->assertMissing(ControleFatura::Validar_RadioFatura);
        $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
        $browser->pause(500);

        $random = rand(0,count($browser->elements(ControleFatura::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControleFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControleFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
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
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
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
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
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

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Migracao
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteMigracao
     * @group ServicoMovelControleFaturaClienteMigracao
     * @return void
     */
    public function testServicoMovelControleFaturaClienteMigracao()
    {
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteMigracao);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
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
     *  - Tipo de cliente: Migracao
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteMigracao
     * @group ServicoMovelControleFaturaClienteMigracao
     * @return void
     */
    public function testServicoMovelControleFaturaClienteMigracaoEmail()
    {
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteMigracao);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioFaturaEmail);
            $browser->assertVisible(ControleFatura::CampoEmail);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoEmail,'');
            $browser->type(ControleFatura::CampoEmail,'teste');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_CampoEmail);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoEmail,'testeteste@teste.com.br');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
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

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteUpgrade
     * @group ServicoMovelControleFaturaClienteUpgrade
     * @return void
     */
    public function testServicoMovelControleFaturaClienteUpgrade()
    {
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteUpgrade);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
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
     *  - Tipo de cliente: Upgrade
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteUpgradeEmail
     * @group ServicoMovelControleFaturaClienteUpgradeEmail
     * @return void
     */
    public function testServicoMovelControleFaturaClienteUpgradeEmail()
    {
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

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
            $browser->select(ControleFatura::SelectPlano, $valuePlano['value']);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertVisible(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);
            $browser->press(ControleFatura::RadioTipoClienteUpgrade);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoNumeroCliente, '99963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertVisible(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoNumeroCliente, '');
            $browser->type(ControleFatura::CampoNumeroCliente, '67963258744');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoNumeroCliente);
            $browser->assertVisible(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->press(ControleFatura::RadioFaturaEmail);
            $browser->assertVisible(ControleFatura::CampoEmail);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->value(ControleFatura::CampoEmail,'');
            $browser->type(ControleFatura::CampoEmail,'teste');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
            $browser->assertMissing(ControleFatura::Validar_CampoICCID);
            $browser->assertMissing(ControleFatura::Validar_RadioFatura);
            $browser->assertVisible(ControleFatura::Validar_CampoEmail);
            $browser->assertVisible(ControleFatura::Validar_RadioDataVencimento);

            $browser->type(ControleFatura::CampoEmail,'testeteste@teste.com.br');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(ControleFatura::Validar_SelectPlano);
            $browser->assertMissing(ControleFatura::Validar_RadioTipoCliente);
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

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Fatura
     *  - Tipo de cliente: Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleFaturaClienteUpgrade
     * @group ServicoMovelControleFaturaClienteUpgrade
     * @return void
     */
    public function testServicoFixa()
    {
        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $acoesVenda = new VendaPAPTest();
//            $acoesVenda->getVenda()->setClienteCPF('00218606109');
            $acoesVenda->getVenda()->setClienteCPF('58248048187');

            $acoesVenda->testEscolherVendaFixa();
            $acoesVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
            $browser->press(IncluirServicos::BotaoFixaTelefoniaFixa);

            $browser->press(CampoVenda::BotaoContinuar);
            $valorTaxaInstalacao = $browser->value(CampoVenda::LabelTaxaInstalacaoFixa);
            if($valorTaxaInstalacao != 'Gratuita'){
                $browser->assertVisible(CampoVenda::Validar_RadioFormaPagamento);
                $browser->press(CampoVenda::RadioFormaPagamentoAVista);
                $browser->press(CampoVenda::BotaoContinuar);
            }

            $browser->assertVisible(FixaTelefoniaFixa::Validar_SelectPlano);
            $browser->assertVisible(FixaTelefoniaFixa::Validar_RadioPortabilidade);
            $browser->assertMissing(FixaTelefoniaFixa::CampoNumeroCliente);

            $valuePlano = $funcoes->retornaValueOption($browser,ControleFatura::OptionPlano, 'Ilimitado Fixo Local');
            $browser->select(FixaTelefoniaFixa::SelectPlano, $valuePlano['value']);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
            $browser->assertVisible(FixaTelefoniaFixa::Validar_RadioPortabilidade);
            $browser->assertMissing(FixaTelefoniaFixa::CampoNumeroCliente);

            $browser->press(FixaTelefoniaFixa::RadioPortabilidadeSim);
            $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
            $browser->assertMissing(FixaTelefoniaFixa::Validar_RadioPortabilidade);
            $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
            $browser->assertVisible(FixaTelefoniaFixa::Validar_CampoNumeroCliente);

            $browser->type(ControleFatura::CampoNumeroCliente, '9996325874');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
            $browser->assertMissing(FixaTelefoniaFixa::Validar_RadioPortabilidade);
            $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
            $browser->assertVisible(FixaTelefoniaFixa::Validar_CampoNumeroCliente);

            $browser->type(ControleFatura::CampoNumeroCliente, '6733112211');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

        });
    }

}
