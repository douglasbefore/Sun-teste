<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use App\consultaCliente;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicoPAP;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Browser\SUN_PAP\Vendas\Vendas\CampoVenda;
use Tests\Browser\SUN_PAP\Vendas\Vendas\IncluirServicos;
use Tests\Browser\SUN_PAP\Vendas\Vendas\FixaTelefoniaFixa;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaPAPTest;

class VendaServicoFixaTelefoniaFixaPAPTest extends DuskTestCase
{
    /**
     * Verifica todos os campos obrigatorios do serviço telefonia Fixa.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoFixaTelefoniaFixa
     * @group ServicoFixaTelefoniaFixa
     * @return void
     */
    public function testServicoFixaTelefoniaFixa()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
//            $dadosVenda->getVenda()->setClienteCPF(consultaCliente::buscaClienteFixa());
            $dadosVenda->getVenda()->setClienteCPF('10746123701');
            $dadosVenda->testEscolherVendaFixa();
            $dadosVenda->dadosCliente();

            $this->ServicoFixaTelefoniaFixa($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->faturaFixa();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoFixaTelefoniaFixa(Browser $browser, VendaPAPTest $dadosVenda){

        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(FixaTelefoniaFixa::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixaTelefoniaFixa::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoFixaTelefoniaFixa);
        $browser->pause(500);

        if($browser->element(RodapeVenda::ValueTaxaHabilitacaoFixa)->getText() != 'Gratuita') {
            $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
        }
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $valuePlano = $funcoes->retornaValueOption($browser, FixaTelefoniaFixa::OptionPlano, 'Ilimitado Fixo Local');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixaTelefoniaFixa::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixaTelefoniaFixa::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
        $browser->assertVisible(FixaTelefoniaFixa::Validar_RadioPortabilidade);
        $browser->assertMissing(FixaTelefoniaFixa::CampoNumeroCliente);

        $dadosServico->setServicoPortabilidade($browser->element(FixaTelefoniaFixa::RadioPortabilidadeNao)->getText());
        $browser->press(FixaTelefoniaFixa::RadioPortabilidadeNao);
        $browser->assertMissing(FixaTelefoniaFixa::CampoNumeroCliente);

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campos obrigatorios do serviço telefonia Fixa com portabilidade sim.
     *  - Portabilidade: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoFixaTelefoniaFixaPortabilidade
     * @group ServicoFixaTelefoniaFixaPortabilidade
     * @return void
     */
    public function testServicoFixaTelefoniaFixaPortabilidade()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->getVenda()->setClienteCPF(consultaCliente::buscaClienteFixa());
            $dadosVenda->testEscolherVendaFixa();
            $dadosVenda->dadosCliente();

            $this->ServicoFixaTelefoniaFixaPortabilidade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->faturaFixa();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoFixaTelefoniaFixaPortabilidade(Browser $browser, VendaPAPTest $dadosVenda){

        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(FixaTelefoniaFixa::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixaTelefoniaFixa::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoFixaTelefoniaFixa);
        $browser->pause(500);

        if($browser->element(RodapeVenda::ValueTaxaHabilitacaoFixa)->getText() != 'Gratuita') {
            $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
        }
        $browser->pause(500);
        $browser->press(CampoVenda::BotaoContinuar);

        $valuePlano = $funcoes->retornaValueOption($browser, FixaTelefoniaFixa::OptionPlano, 'Ilimitado Fixo Local');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixaTelefoniaFixa::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixaTelefoniaFixa::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
        $browser->assertVisible(FixaTelefoniaFixa::Validar_RadioPortabilidade);
        $browser->assertMissing(FixaTelefoniaFixa::CampoNumeroCliente);

        $dadosServico->setServicoPortabilidade($browser->element(FixaTelefoniaFixa::RadioPortabilidadeSim)->getText());
        $browser->press(FixaTelefoniaFixa::RadioPortabilidadeSim);
        $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixaTelefoniaFixa::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
        $browser->assertMissing(FixaTelefoniaFixa::Validar_RadioPortabilidade);
        $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
        $browser->assertVisible(FixaTelefoniaFixa::Validar_CampoNumeroCliente);

        $browser->type(FixaTelefoniaFixa::CampoNumeroCliente, '9996325874');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixaTelefoniaFixa::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixaTelefoniaFixa::Validar_SelectPlano);
        $browser->assertMissing(FixaTelefoniaFixa::Validar_RadioPortabilidade);
        $browser->assertVisible(FixaTelefoniaFixa::CampoNumeroCliente);
        $browser->assertVisible(FixaTelefoniaFixa::Validar_CampoNumeroCliente);

        $dadosServico->setServicoNumeroCliente('33112211');
        $browser->value(FixaTelefoniaFixa::CampoNumeroCliente, '');
        $browser->type(FixaTelefoniaFixa::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());

        $dadosVenda->VendaServico($dadosServico);
    }
}
