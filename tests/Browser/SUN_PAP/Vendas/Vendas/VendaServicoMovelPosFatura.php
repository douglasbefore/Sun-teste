<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 20/07/18
 * Time: 18:04
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\PosFatura;
use Tests\Browser\SUN_PAP\Vendas\Vendas\CampoVenda;
use Tests\Browser\SUN_PAP\Vendas\Vendas\IncluirServicos;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;

class VendaServicoMovelPosFaturaTest extends DuskTestCase
{
    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: N�o
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteAlta
     * @group ServicoMovelPosFaturaClienteAlta
     * @return void
     */
    public function testServicoMovelPosFaturaClienteAlta()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteAlta($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteAlta(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteAlta)->getText());
        $browser->press(PosFatura::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(PosFatura::RadioPortabilidadeNao)->getText());
        $browser->press(PosFatura::RadioPortabilidadeNao);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(PosFatura::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaViaPostal)->getText());
        $browser->press(PosFatura::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);
        $browser->pause(500);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteAltaPortabilidade
     * @group ServicoMovelPosFaturaClienteAltaPortabilidade
     * @return void
     */
    public function testServicoMovelPosFaturaClienteAltaPortabilidade()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteAltaPortabilidade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteAltaPortabilidade(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteAlta)->getText());
        $browser->press(PosFatura::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(PosFatura::RadioPortabilidadeSim)->getText());
        $browser->press(PosFatura::RadioPortabilidadeSim);
        $browser->assertVisible(PosFatura::CampoNumeroCliente);
        $browser->assertVisible(PosFatura::SelectOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valueOperadora = $funcoes->retornaValueOption($browser, PosFatura::OptionOperadora, 'Claro');
        $dadosServico->setServicoOperadora($valueOperadora['text']);
        $browser->select(PosFatura::SelectOperadora, $valueOperadora['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(PosFatura::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaViaPostal)->getText());
        $browser->press(PosFatura::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Alta
     *  - Portabilidade: Sim
     *  - Operadora: Outros
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteAltaPortabilidadeOutros
     * @group ServicoMovelPosFaturaClienteAltaPortabilidadeOutros
     * @return void
     */
    public function testServicoMovelPosFaturaClienteAltaPortabilidadeOutros()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteAltaPortabilidadeOutros($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteAltaPortabilidadeOutros(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteAlta)->getText());
        $browser->press(PosFatura::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(PosFatura::RadioPortabilidadeSim)->getText());
        $browser->press(PosFatura::RadioPortabilidadeSim);
        $browser->assertVisible(PosFatura::CampoNumeroCliente);
        $browser->assertVisible(PosFatura::SelectOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_SelectOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valueOperadora = $funcoes->retornaValueOption($browser, PosFatura::OptionOperadora, 'Outros');
        $dadosServico->setServicoOperadora($valueOperadora['text']);
        $browser->select(PosFatura::SelectOperadora, $valueOperadora['value']);
        $browser->assertVisible(PosFatura::CampoOutraOperadora);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
//        $browser->assertVisible(PosFatura::Validar_CampoOutraOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoOutraOperadora('Operadora Teste');
        $browser->type(PosFatura::CampoOutraOperadora, $dadosServico->getServicoOutraOperadora());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
//        $browser->assertMissing(PosFatura::Validar_CampoOutraOperadora);
        $browser->assertVisible(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(PosFatura::CampoICCID, $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaEmail)->getText());
        $browser->press(PosFatura::RadioFaturaEmail);
        $browser->assertVisible(PosFatura::CampoEmail);
        $browser->value(PosFatura::CampoEmail, '');
        $browser->type(PosFatura::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('teste_teste_teste@teste.com');
        $browser->value(PosFatura::CampoEmail, '');
        $browser->type(PosFatura::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertMissing(PosFatura::Validar_SelectOperadora);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertMissing(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Migracao
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteMigracao
     * @group ServicoMovelPosFaturaClienteMigracao
     * @return void
     */
    public function testServicoMovelPosFaturaClienteMigracao()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteMigracao($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteMigracao(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteMigracao)->getText());
        $browser->press(PosFatura::RadioTipoClienteMigracao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaViaPostal)->getText());
        $browser->press(PosFatura::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Migracao
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteMigracaoEmail
     * @group ServicoMovelPosFaturaClienteMigracaoEmail
     * @return void
     */
    public function testServicoMovelPosFaturaClienteMigracaoEmail()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteMigracaoEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteMigracaoEmail(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteMigracao)->getText());
        $browser->press(PosFatura::RadioTipoClienteMigracao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaEmail)->getText());
        $browser->press(PosFatura::RadioFaturaEmail);
        $browser->assertVisible(PosFatura::CampoEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->value(PosFatura::CampoEmail, '');
        $browser->type(PosFatura::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(PosFatura::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertMissing(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteUpgrade
     * @group ServicoMovelPosFaturaClienteUpgrade
     * @return void
     */
    public function testServicoMovelPosFaturaClienteUpgrade()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteUpgrade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });

    }

    public function ServicoMovelPosFaturaClienteUpgrade(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteUpgrade)->getText());
        $browser->press(PosFatura::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaViaPostal)->getText());
        $browser->press(PosFatura::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura
     *  - Tipo de cliente: Upgrade
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaClienteUpgradeEmail
     * @group ServicoMovelPosFaturaClienteUpgradeEmail
     * @return void
     */
    public function testServicoMovelPosFaturaClienteUpgradeEmail()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaClienteUpgradeEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelPosFaturaClienteUpgradeEmail(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser, PosFatura::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(PosFatura::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteUpgrade)->getText());
        $browser->press(PosFatura::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaEmail)->getText());
        $browser->press(PosFatura::RadioFaturaEmail);
        $browser->assertVisible(PosFatura::CampoEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->value(PosFatura::CampoEmail, '');
        $browser->type(PosFatura::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(PosFatura::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertMissing(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o servi�o movel Pos Fatura com dependentes
     *  - Dependentes: sim
     *  - Tipo de cliente: Upgrade
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaDependentesClienteAlta
     * @group ServicoMovelPosFaturaDependentesClienteAlta
     * @return void
     */
    public function testServicoMovelPosFaturaDependentesClienteAlta()
    {
        $this->browse(function (Browser $browser) {

            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelPosFaturaDependentesClienteAlta($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    /**
     * @param Browser $browser
     * @param VendaPAPTest $dadosVenda
     */
    public function ServicoMovelPosFaturaDependentesClienteAlta(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(PosFatura::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(PosFatura::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelPosFatura);
        $funcoes->loadCarregandoCampoNull($browser, PosFatura::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoPossuiDependente($this->selecionaPlanoComDependentes($browser, $dadosServico));

        $quantidadeDependentesGratuitos = preg_replace("/[^0-9]/", "", $browser->element(PosFatura::Validar_SelectPlano)->getText());
        $dadosServico->setServicoQuantidadeDependenteGratuitos($quantidadeDependentesGratuitos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertVisible(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoTipoCliente($browser->element(PosFatura::RadioTipoClienteUpgrade)->getText());
        $browser->press(PosFatura::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->type(PosFatura::CampoNumeroCliente, '99963258744');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertVisible(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente('91111-1111');
        $browser->value(PosFatura::CampoNumeroCliente, '');
        $browser->type(PosFatura::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoNumeroCliente);
        $browser->assertVisible(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(PosFatura::RadioFaturaEmail)->getText());
        $browser->press(PosFatura::RadioFaturaEmail);
        $browser->assertVisible(PosFatura::CampoEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $browser->value(PosFatura::CampoEmail, '');
        $browser->type(PosFatura::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertVisible(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(PosFatura::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(PosFatura::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(PosFatura::Validar_SelectPlano);
        $browser->assertMissing(PosFatura::Validar_RadioTipoCliente);
        $browser->assertMissing(PosFatura::Validar_CampoICCID);
        $browser->assertMissing(PosFatura::Validar_RadioFatura);
        $browser->assertMissing(PosFatura::Validar_CampoEmail);
        $browser->assertVisible(PosFatura::Validar_RadioDataVencimento);

        $random = rand(0, count($browser->elements(PosFatura::RadioDataVencimento)) - 1);
        $dadosServico->setServicoDataVencimento($browser->elements(PosFatura::RadioDataVencimento)[$random]->getText());
        $browser->elements(PosFatura::RadioDataVencimento)[$random]->click();

        $browser->press(PosFatura::BotaoAdicionarDependentes);
        $browser->pause(200);
        $browser->assertSeeIn(PosFatura::Modal_DependentesTitulo, 'Dados dos Dependentes');

        do{
            $acabou=false;
            $botao = $browser->element(PosFatura::Modal_BotaoAdicionarDependente);

            if(isset($botao)){
                $browser->press(PosFatura::Modal_BotaoAdicionarDependente);
                $browser->pause(200);
            }else{
                $acabou=true;
            }
        }while(!$acabou);

        $elementesDependentes = $browser->elements(PosFatura::Modal_Dependentes);
        $contaQuantidadeDependentesGratuiros=0;

        foreach ($elementesDependentes as $id => $dependentes) {
            $dadosDependentes = new VendaServicoDependentesPAP();

            $dadosDependentes->setDependenteid($id);

            $dependentes->getLocationOnScreenOnceScrolledIntoView();
            $browser->pause(100);

            $element = $browser->script('return $(".module-container .modal-wrapper .v-modal.center .dependentes-item .dependente-selecionado")['. $id .'];')[0]['ELEMENT'];

            $browser->with($element , function (Browser $itemDependente){
                $itemDependente->assertSee('Dados + Voz - Gratuito');
            });

//            $dadosDependentes->setDependentePlano($nomePlano);

            if (strpos($dadosDependentes->getDependentePlano(), 'Gratuito')) {
                $contaQuantidadeDependentesGratuiros++;
            }

//            $imputNumeroLinha = $browser->element($dependentes . ' [id^="numeroLinha_"]');
//            $imputNumeroLinha->value('teste');

        }
        $this->assertEquals($dadosServico->getServicoQuantidadeDependenteGratuitos(), $contaQuantidadeDependentesGratuiros);

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica se ap�s selecionar servi�o Pos Fatura, esta desabilitando os servi�os
     * que n�o s�o permitidos junto com o Fatura.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelPosFaturaOutrosServicosDesabilitados
     * @group ServicoMovelPosFaturaOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelPosFaturaOutrosServicosDesabilitados()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->press(IncluirServicos::BotaoMovelPosFatura);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);

            $posFatura = $browser->element(PosFatura::PosicaoIncluirServicoExiste);
            if(isset($posFatura)){
                $browser->assertVisible(IncluirServicos::BotaoMovelPosFatura);
            }
            $browser->assertVisible(IncluirServicos::BotaoMovelControleFatura);
            $browser->assertVisible(IncluirServicos::BotaoMovelFixoFWT);
            $browser->assertVisible(IncluirServicos::BotaoMovelControleCartao);
            $browser->assertVisible(IncluirServicos::BotaoMovelControlePassDigitalDesabilitado);
        });
    }

    /**
     * @param Browser $browser
     * @param VendaServicoPAP $dadosServico
     * @return bool
     */
    public function selecionaPlanoComDependentes(Browser $browser, VendaServicoPAP $dadosServico)
    {
        $planosPosFatura = $browser->elements(PosFatura::OptionPlano);

        foreach ($planosPosFatura as $plano) {
            $browser->select(PosFatura::SelectPlano, $plano->getAttribute('value'));
            $avisoDependente = $browser->element(PosFatura::Validar_SelectPlano);

            if (isset($avisoDependente)) {
                if (strpos($avisoDependente->getText(), 'dependentes')) {
                    $quantidade = preg_replace("/[^0-9]/", "", $avisoDependente->getText());
                    $dadosServico->setServicoQuantidadeDependenteGratuitos($quantidade);
                    return true;
                }
            }
        }
        return false;
    }

}