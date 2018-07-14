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
//use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;
//use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;

class VendaServicoFixoFWTPAPTest extends DuskTestCase
{
    /**
     * Verifica se após selecionar serviço Fixo FWT, esta desabilitando os serviços
     * que não são permitidos junto com o Fixo FWT.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTOutrosServicosDesabilitados
     * @group ServicoMovelFixoFWTOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelFixoFWTOutrosServicosDesabilitados()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();

            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->press(IncluirServicos::BotaoMovelFixoFWT);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);

            $posFatura = $browser->element(ControlePosFatura::PosicaoIncluirServicoExiste);
            if(isset($posFatura)){
                $browser->assertVisible(IncluirServicos::BotaoMovelPosFatura);
            }
            $browser->assertVisible(IncluirServicos::BotaoMovelControleFatura);
            $browser->assertVisible(IncluirServicos::BotaoMovelFixoFWTDesabilitado);
            $browser->assertVisible(IncluirServicos::BotaoMovelControleCartao);
            $browser->assertVisible(IncluirServicos::BotaoMovelControlePassDigitalDesabilitado);
        });
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Fixo FWT.
     *  - Portabilidade: Não
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTOutrosServicosDesabilitados
     * @group ServicoMovelFixoFWTOutrosServicosDesabilitados
     * @return void
     */
    public function testServicoMovelFixoFWT()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelFixoFWT($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelFixoFWT(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $dadosServico->setServicoNome(FixoFWT::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixoFWT::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $browser->press(IncluirServicos::BotaoMovelFixoFWT);

        $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixoFWT::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(FixoFWT::RadioPortabilidadeNao)->getText());
        $browser->press(FixoFWT::RadioPortabilidadeNao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(FixoFWT::CampoICCID,  $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(FixoFWT::RadioFaturaViaPostal)->getText());
        $browser->press(FixoFWT::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $random = rand(0,count($browser->elements(FixoFWT::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(FixoFWT::RadioDataVencimento)[$random]->getText());
        $browser->elements(FixoFWT::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Fixo FWT com tipo fatura E-mail.
     *  - Portabilidade: Não
     *  - Tipo Fatura: E-mail
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTFaturaEmail
     * @group ServicoMovelFixoFWTFaturaEmail
     * @return void
     */
    public function testServicoMovelFixoFWTFaturaEmail()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelFixoFWTFaturaEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelFixoFWTFaturaEmail(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $dadosServico->setServicoNome(FixoFWT::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixoFWT::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $browser->press(IncluirServicos::BotaoMovelFixoFWT);

        $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixoFWT::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(FixoFWT::RadioPortabilidadeNao)->getText());
        $browser->press(FixoFWT::RadioPortabilidadeNao);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(FixoFWT::CampoICCID,  $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(FixoFWT::RadioFaturaEmail)->getText());
        $browser->press(FixoFWT::RadioFaturaEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_CampoEmail);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $browser->type(FixoFWT::CampoEmail, 'teste');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_CampoEmail);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testetesteteste@teste.com.br');
        $browser->type(FixoFWT::CampoEmail,  $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertMissing(FixoFWT::Validar_CampoEmail);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $random = rand(0,count($browser->elements(FixoFWT::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(FixoFWT::RadioDataVencimento)[$random]->getText());
        $browser->elements(FixoFWT::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Fixo FWT com tipo fatura E-mail.
     *  - Portabilidade: Sim
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTPortabilidade
     * @group ServicoMovelFixoFWTPortabilidade
     * @return void
     */
    public function testServicoMovelFixoFWTPortabilidade()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelFixoFWTPortabilidade($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelFixoFWTPortabilidade(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $dadosServico->setServicoNome(FixoFWT::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixoFWT::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $browser->press(IncluirServicos::BotaoMovelFixoFWT);

        $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixoFWT::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(FixoFWT::RadioPortabilidadeSim)->getText());
        $browser->press(FixoFWT::RadioPortabilidadeSim);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $browser->type(FixoFWT::CampoNumeroCliente, '(99) 99999-9999');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->value(FixoFWT::CampoNumeroCliente, '');
        $browser->type(FixoFWT::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionOperadora, 'Claro');
        $dadosServico->setServicoOperadora($valuePlano['text']);
        $browser->select(FixoFWT::SelectOperadora, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(FixoFWT::CampoICCID,  $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(FixoFWT::RadioFaturaViaPostal)->getText());
        $browser->press(FixoFWT::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $random = rand(0,count($browser->elements(FixoFWT::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(FixoFWT::RadioDataVencimento)[$random]->getText());
        $browser->elements(FixoFWT::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Fixo FWT com tipo fatura E-mail.
     *  - Portabilidade: Sim
     *  - Operadora: Outros
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTPortabilidadeOutros
     * @group ServicoMovelFixoFWTPortabilidadeOutros
     * @return void
     */
    public function testServicoMovelFixoFWTPortabilidadeOutros()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelFixoFWTPortabilidadeOutros($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelFixoFWTPortabilidadeOutros(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $dadosServico->setServicoNome(FixoFWT::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixoFWT::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $browser->press(IncluirServicos::BotaoMovelFixoFWT);

        $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixoFWT::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(FixoFWT::RadioPortabilidadeSim)->getText());
        $browser->press(FixoFWT::RadioPortabilidadeSim);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $browser->type(FixoFWT::CampoNumeroCliente, '(99) 99999-9999');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->value(FixoFWT::CampoNumeroCliente, '');
        $browser->type(FixoFWT::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionOperadora, 'Outros');
        $dadosServico->setServicoOperadora($valuePlano['text']);
        $browser->select(FixoFWT::SelectOperadora, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoOutraOperadora('Operadora Teste');
        $browser->type(FixoFWT::CampoOutraOperadora, $dadosServico->getServicoOutraOperadora());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(FixoFWT::CampoICCID,  $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(FixoFWT::RadioFaturaViaPostal)->getText());
        $browser->press(FixoFWT::RadioFaturaViaPostal);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $random = rand(0,count($browser->elements(FixoFWT::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(FixoFWT::RadioDataVencimento)[$random]->getText());
        $browser->elements(FixoFWT::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }

    /**
     * Verifica todos os campo obrigatorios para o serviço movel Fixo FWT com tipo fatura E-mail.
     *  - Portabilidade: Sim
     *  - Operadora: Outros
     *
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoMovelFixoFWTPortabilidadeOutrosEmail
     * @group ServicoMovelFixoFWTPortabilidadeOutrosEmail
     * @return void
     */
    public function testServicoMovelFixoFWTPortabilidadeOutrosEmail()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $this->ServicoMovelFixoFWTPortabilidadeOutrosEmail($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->validarResumoVenda();
        });
    }

    public function ServicoMovelFixoFWTPortabilidadeOutrosEmail(Browser $browser, VendaPAPTest $dadosVenda){
        $funcoes = new FuncoesGerais();
        $dadosServico = new VendaServicoPAP();

        $dadosServico->setServicoNome(FixoFWT::NomeDoServico);
        $dadosServico->setServicoElementoPlanoResumo(FixoFWT::LabelServicoResumo);
        $dadosServico->setServicoVendaDDD($dadosVenda->getVenda()->getVendaDDD());

        $funcoes->barraRolagemElemento($browser, IncluirServicos::BotaoIncluirServico);
        if($browser->element(IncluirServicos::BotaoIncluirServico)->isDisplayed()){
            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);
        }
        $browser->press(IncluirServicos::BotaoMovelFixoFWT);

        $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);
        $browser->press(CampoVenda::BotaoContinuar);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertVisible(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
        $dadosServico->setServicoDescricaoPlano($valuePlano['text']);
        $browser->select(FixoFWT::SelectPlano, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoPortabilidade($browser->element(FixoFWT::RadioPortabilidadeSim)->getText());
        $browser->press(FixoFWT::RadioPortabilidadeSim);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $browser->type(FixoFWT::CampoNumeroCliente, '(99) 99999-9999');
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertVisible(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoNumeroCliente(FuncoesPhp::gerarCelularRandomico());
        $browser->value(FixoFWT::CampoNumeroCliente, '');
        $browser->type(FixoFWT::CampoNumeroCliente, $dadosServico->getServicoNumeroCliente());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertVisible(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionOperadora, 'Outros');
        $dadosServico->setServicoOperadora($valuePlano['text']);
        $browser->select(FixoFWT::SelectOperadora, $valuePlano['value']);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoOutraOperadora('Operadora Teste');
        $browser->type(FixoFWT::CampoOutraOperadora, $dadosServico->getServicoOutraOperadora());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertVisible(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoICCID(FuncoesPhp::geraICCIDRandomico());
        $browser->type(FixoFWT::CampoICCID,  $dadosServico->getServicoICCID());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertVisible(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoFatura($browser->element(FixoFWT::RadioFaturaEmail)->getText());
        $browser->press(FixoFWT::RadioFaturaEmail);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertVisible(FixoFWT::Validar_CampoEmail);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $dadosServico->setServicoEmail('testeteste@teste.com.br');
        $browser->type(FixoFWT::CampoEmail, $dadosServico->getServicoEmail());
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);

        $browser->element(FixoFWT::SeletorNomeServico)->getLocationOnScreenOnceScrolledIntoView();
        $browser->assertMissing(FixoFWT::Validar_SelectPlano);
        $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
        $browser->assertMissing(FixoFWT::Validar_CampoNumeroCliente);
        $browser->assertMissing(FixoFWT::Validar_SelectOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoOutraOperadora);
        $browser->assertMissing(FixoFWT::Validar_CampoICCID);
        $browser->assertMissing(FixoFWT::Validar_RadioFatura);
        $browser->assertMissing(FixoFWT::Validar_CampoEmail);
        $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

        $random = rand(0,count($browser->elements(FixoFWT::RadioDataVencimento))-1);
        $dadosServico->setServicoDataVencimento($browser->elements(FixoFWT::RadioDataVencimento)[$random]->getText());
        $browser->elements(FixoFWT::RadioDataVencimento)[$random]->click();

        $dadosVenda->VendaServico($dadosServico);
    }
}
