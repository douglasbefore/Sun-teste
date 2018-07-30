<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\SUN_PAP\Vendas\Vendas\ControlePassDigital;
use Tests\Browser\SUN_PAP\Vendas\Vendas\CampoVenda;
use Tests\Browser\SUN_PAP\Vendas\Vendas\IncluirServicos;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaServicoMovelControlePassDigitalTest extends DuskTestCase
{
    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Não
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteAlta
     * @group ServicoMovelControlePassDigitalClienteAlta
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteAlta()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteAlta($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteAlta(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteAlta)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(ControlePassDigital::RadioPortabilidadeNao)->getText());
        $browser->press(ControlePassDigital::RadioPortabilidadeNao);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(ControlePassDigital::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaViaPostal)->getText());
        $browser->press(ControlePassDigital::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);
        $browser->pause(500);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteAltaPortabilidade
     * @group ServicoMovelControlePassDigitalClienteAltaPortabilidade
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteAltaPortabilidade()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteAltaPortabilidade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteAltaPortabilidade(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteAlta)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(ControlePassDigital::RadioPortabilidadeSim)->getText());
        $browser->press(ControlePassDigital::RadioPortabilidadeSim);
        $browser->assertVisible(ControlePassDigital::CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::SelectOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valueOperadora = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionOperadora, 'Claro');
        $dadosServico->setServicoOperadora($valueOperadora['text']);
        $browser->select(ControlePassDigital::SelectOperadora, $valueOperadora['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(ControlePassDigital::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaViaPostal)->getText());
        $browser->press(ControlePassDigital::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     *  - Operadora: Outros
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteAltaPortabilidadeOutros
     * @group ServicoMovelControlePassDigitalClienteAltaPortabilidadeOutros
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteAltaPortabilidadeOutros()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteAltaPortabilidadeOutros($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteAltaPortabilidadeOutros(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteAlta)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(ControlePassDigital::RadioPortabilidadeSim)->getText());
        $browser->press(ControlePassDigital::RadioPortabilidadeSim);
        $browser->assertVisible(ControlePassDigital::CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::SelectOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valueOperadora = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionOperadora, 'Outros');
        $dadosServico->setServicoOperadora($valueOperadora['text']);
        $browser->select(ControlePassDigital::SelectOperadora, $valueOperadora['value']);
        $browser->assertVisible(ControlePassDigital::CampoOutraOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoOutraOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoOutraOperadora('Operadora Teste');
        $browser->type(ControlePassDigital::CampoOutraOperadora, $dadosServico->getServicoOutraOperadora());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoOutraOperadora);
        $browser->assertVisible(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(ControlePassDigital::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaEmail)->getText());
        $browser->press(ControlePassDigital::RadioFaturaEmail);
        $browser->assertVisible(ControlePassDigital::CampoEmail);
        $browser->value(ControlePassDigital::CampoEmail, '');
        $browser->type(ControlePassDigital::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('teste_teste_teste@teste.com');
        $browser->value(ControlePassDigital::CampoEmail, '');
        $browser->type(ControlePassDigital::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControlePassDigital::Validar_SelectOperadora);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertMissing(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Migracao
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteMigracao
     * @group ServicoMovelControlePassDigitalClienteMigracao
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteMigracao()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteMigracao($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteMigracao(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteMigracao)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteMigracao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaViaPostal)->getText());
        $browser->press(ControlePassDigital::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Migracao
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteMigracaoEmail
     * @group ServicoMovelControlePassDigitalClienteMigracaoEmail
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteMigracaoEmail()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteMigracaoEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteMigracaoEmail(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteMigracao)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteMigracao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaEmail)->getText());
        $browser->press(ControlePassDigital::RadioFaturaEmail);
        $browser->assertVisible(ControlePassDigital::CampoEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->value(ControlePassDigital::CampoEmail, '');
        $browser->type(ControlePassDigital::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(ControlePassDigital::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertMissing(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteUpgrade
     * @group ServicoMovelControlePassDigitalClienteUpgrade
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteUpgrade()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteUpgrade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });

    }

    public function ServicoMovelControlePassDigitalClienteUpgrade(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteUpgrade)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaViaPostal)->getText());
        $browser->press(ControlePassDigital::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Pass Digital
     *  - Tipo de cliente: Upgrade
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalClienteUpgradeEmail
     * @group ServicoMovelControlePassDigitalClienteUpgradeEmail
     * @return void
     */
    public function testServicoMovelControlePassDigitalClienteUpgradeEmail()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControlePassDigitalClienteUpgradeEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControlePassDigitalClienteUpgradeEmail(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControlePassDigital::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControlePassDigital::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
        $funcoes->loadCarregandoCampoNull($browser, ControlePassDigital::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, ControlePassDigital::OptionPlano, 'PASS DIGITAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControlePassDigital::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertVisible(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(ControlePassDigital::RadioTipoClienteUpgrade)->getText());
        $browser->press(ControlePassDigital::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->type(ControlePassDigital::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertVisible(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(ControlePassDigital::CampoNumeroCliente, '');
        $browser->type(ControlePassDigital::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(ControlePassDigital::RadioFaturaEmail)->getText());
        $browser->press(ControlePassDigital::RadioFaturaEmail);
        $browser->assertVisible(ControlePassDigital::CampoEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $browser->value(ControlePassDigital::CampoEmail, '');
        $browser->type(ControlePassDigital::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertVisible(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(ControlePassDigital::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControlePassDigital::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControlePassDigital::Validar_SelectPlano);
        $browser->assertMissing(ControlePassDigital::Validar_RadioTipoCliente);
        $browser->assertMissing(ControlePassDigital::Validar_CampoICCID);
        $browser->assertMissing(ControlePassDigital::Validar_RadioFatura);
        $browser->assertMissing(ControlePassDigital::Validar_CampoEmail);
        $browser->assertVisible(ControlePassDigital::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(ControlePassDigital::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->getText());
        $browser->elements(ControlePassDigital::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica se após selecionar serviço Controle Pass Digital, esta desabilitando os serviços
     * que não são permitidos junto com o Fatura.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControlePassDigitalOutrosServicosDesabilitados
     * @group ServicoMovelControlePassDigitalOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelControlePassDigitalOutrosServicosDesabilitados()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->press(IncluirServicos::BotaoMovelControlePassDigital);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);

            $posFatura = $browser->element(PosFatura::PosicaoIncluirServicoExiste);
            if(isset($posFatura)){
                $browser->assertVisible(IncluirServicos::BotaoMovelPosFaturaDesabilitado);
            }
            $browser->assertVisible(IncluirServicos::BotaoMovelControleFaturaDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelFixoFWTDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelControleCartaoDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelControlePassDigitalDesabilitado);
        });
    }
}
