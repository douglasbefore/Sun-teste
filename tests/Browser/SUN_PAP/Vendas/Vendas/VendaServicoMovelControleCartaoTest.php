<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsServicosPAP;

class VendaServicoMovelControleCartaoTest extends DuskTestCase
{
    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de cliente Alta
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartaoValidarClienteAlta
     * @group ServicoMovelControleCartaoValidarClienteAlta
     * @return void
     */
    public function testServicoMovelControleCartaoClienteAlta()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControleCartaoClienteAlta($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControleCartaoClienteAlta(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControleCartao::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControleCartao::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControleCartao);
        $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_SelectPlano);
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

        $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControleCartao::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $dadosServico->setServicoTipoCliente($browser->element(ControleCartao::RadioTipoClienteAlta)->getText());
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->click(ControleCartao::RadioTipoClienteAlta);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoICCID);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->type(ControleCartao::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_CampoICCID);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(ControleCartao::CampoICCID, $dadosServico->getServicoICCID());

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de Migração
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testServicoMovelControleCartaoTipoMigracao()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControleCartaoTipoMigracao($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControleCartaoTipoMigracao(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControleCartao::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControleCartao::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControleCartao);
        $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_SelectPlano);
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

        $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControleCartao::SelectPlano,$valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleCartao::Validar_SelectPlano);
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

        $dadosServico->setServicoTipoCliente($browser->element(ControleCartao::RadioTipoClienteMigracao)->getText());
        $browser->press(ControleCartao::RadioTipoClienteMigracao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControleCartao::CampoICCID);
        $browser->assertMissing(ControleCartao::Validar_CampoICCID);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->type(ControleCartao::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Controle Cartão tipo de Upgrade
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelControleCartao
     * @group ServicoMovelControleCartao
     * @return void
     */
    public function testServicoMovelControleCartaoTipoUpgrade()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelControleCartaoTipoUpgrade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelControleCartaoTipoUpgrade(Browser $browser, VendaPAPTest $dadosVenda)
    {
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $browser->element(IncluirServicos::BotaoIncluirServico)->getLocationOnScreenOnceScrolledIntoView();
        if ($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()) {
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $dadosServico->setServicoNome(ControleCartao::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(ControleCartao::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $browser->press(IncluirServicos::BotaoMovelControleCartao);
        $funcoes->loadCarregandoCampoNull($browser, ControleCartao::AlertaCarregandoPlanos);

        $browser->press(CampoVenda::BotaoContinuar);
        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_SelectPlano);
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

        $valuePlano = $funcoes->retornaValueOption($browser, ControleCartao::OptionPlano, 'controle');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(ControleCartao::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(ControleCartao::Validar_SelectPlano);
        $browser->assertVisible(ControleCartao::Validar_RadioTipoCliente);
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);

        $dadosServico->setServicoTipoCliente($browser->element(ControleCartao::RadioTipoClienteUpgrade)->getText());
        $browser->press(ControleCartao::RadioTipoClienteUpgrade);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(ControleCartao::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(ControleCartao::Validar_CampoNumeroCliente);
        $browser->assertMissing(ControleCartao::CampoICCID);
        $browser->assertMissing(ControleCartao::Validar_CampoICCID);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->type(ControleCartao::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());

        $dadosVenda->VendaServico($dadosServico);
    }

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

            $posFatura = $browser->element(PosFatura::PosicaoIncluirServicoExiste);
            if(isset($posFatura)){
                $browser->assertVisible(IncluirServicos::BotaoMovelPosFatura);
            }
            $browser->assertVisible(IncluirServicos::BotaoMovelControleFaturaDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelFixoFWT);
            $browser->assertVisible(IncluirServicos::BotaoMovelControleCartaoDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelControlePassDigitalDesabilitado);
        });
    }
}
