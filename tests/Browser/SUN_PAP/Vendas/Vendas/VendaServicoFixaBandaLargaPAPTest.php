<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use App\consultaCliente;
use Laravel\Dusk\Browser;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicoPAP;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Browser\SUN_PAP\Vendas\Vendas\CampoVenda;
use Tests\Browser\SUN_PAP\Vendas\Vendas\IncluirServicos;
use Tests\Browser\SUN_PAP\Vendas\Vendas\FixaBandaLarga;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaPAPTest;

class VendaServicoFixaBandaLargaPAPTest extends DuskTestCase
{
    /**
     * Verifica todos os campos obrigatorios do serviço Banda Larga.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoFixaBandaLargaAdicionais
     * @group ServicoFixaBandaLargaAdicionais
     * @return void
     */
    public function testServicoFixaBandaLarga()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
//            $dadosVenda->getVenda()->setClienteCPF('00218606109');
            $dadosVenda->getVenda()->setClienteCPF(consultaCliente::buscaClienteFixa());
            $dadosVenda->getVenda()->setEnderecoPrimeiroEndereco(true);

            $dadosVenda->testEscolherVendaFixa();
            $dadosVenda->dadosCliente();

            $this->ServicoFixaBandaLarga($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->faturaFixa();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoFixaBandaLarga(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(FixaBandaLarga::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixaBandaLarga::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoFixaBandaLarga);
        $browser->pause(500);

        if($browser->element(RodapeVenda::ValueTaxaHabilitacaoFixa)->getText() != 'Gratuita') {
            $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
        }
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixaBandaLarga::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixaBandaLarga::Validar_SelectPlano);

        $valuePlano = $funcoes->retornaValueOption($browser, FixaBandaLarga::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixaBandaLarga::SelectPlano, $valuePlano['value']);

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campos obrigatorios do serviço Banda Larga com serviços adicionais.
     * - Serviços Adicionais: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoFixaBandaLargaServicoAdicionais
     * @group ServicoFixaBandaLargaServicoAdicionais
     * @return void
     */
    public function testServicoFixaBandaLargaServicoAdicionais()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
//            $dadosVenda->getVenda()->setClienteCPF('00218606109');
            $dadosVenda->getVenda()->setClienteCPF(consultaCliente::buscaClienteFixa());

            $dadosVenda->testEscolherVendaFixa();
            $dadosVenda->dadosCliente();

            $this->ServicoFixaBandaLargaServicoAdicionais($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->faturaFixa();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoFixaBandaLargaServicoAdicionais(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(FixaBandaLarga::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixaBandaLarga::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoFixaBandaLarga);
        $browser->pause(500);

        if($browser->element(RodapeVenda::ValueTaxaHabilitacaoFixa)->getText() != 'Gratuita') {
            $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
        }
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixaBandaLarga::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixaBandaLarga::Validar_SelectPlano);

        $valuePlano = $funcoes->retornaValueOption($browser, FixaBandaLarga::OptionPlano);
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixaBandaLarga::SelectPlano, $valuePlano['value']);

        $browser->pause(500);
        $adicionais = FixaBandaLarga::CheckboxServicosAdicionais_ProtegeFamilia;
        $dadosServico->setServicoAdicionais($browser->element($adicionais)->getText());
        $browser->press($adicionais);

        $adicionais = FixaBandaLarga::CheckboxServicosAdicionais_ESPNPlay;
        $dadosServico->setServicoAdicionais($browser->element($adicionais)->getText());
        $browser->press($adicionais);

        $adicionais = FixaBandaLarga::CheckboxServicosAdicionais_FOXPremium;
        $dadosServico->setServicoAdicionais($browser->element($adicionais)->getText());
        $browser->press($adicionais);

        $adicionais = FixaBandaLarga::CheckboxServicosAdicionais_HBOGo;
        $dadosServico->setServicoAdicionais($browser->element($adicionais)->getText());
        $browser->press($adicionais);

        $dadosVenda->VendaServico($dadosServico);
    }
}
