<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;

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
//            $dadosVenda->inicioVenda();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoMovelFixoFWT);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoIncluirServico);
            $browser->pause(500);

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
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
//            $dadosVenda->inicioVenda();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoMovelFixoFWT);
            $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(FixoFWT::Validar_SelectPlano);
            $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
            $browser->select(FixoFWT::SelectPlano, $valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->press(FixoFWT::RadioPortabilidadeNao);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->type(FixoFWT::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->press(FixoFWT::RadioFaturaViaPostal);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertMissing(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->elements(FixoFWT::RadioDataVencimento)[1]->click();

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
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
            $funcoes = new FuncoesGerais();

            $dadosVenda = new VendaPAPTest();
//            $dadosVenda->inicioVenda();
            $dadosVenda->testEscolherVendaMovel();
            $dadosVenda->dadosCliente();

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);

            $browser->press(IncluirServicos::BotaoMovelFixoFWT);
            $funcoes->loadCarregandoCampoNull($browser, FixoFWT::AlertaCarregandoPlanos);

            $browser->press(CampoVenda::BotaoContinuar);
            $browser->assertVisible(FixoFWT::Validar_SelectPlano);
            $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $valuePlano = $funcoes->retornaValueOption($browser,FixoFWT::OptionPlano, 'FIXO LOCAL');
            $browser->select(FixoFWT::SelectPlano, $valuePlano);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertVisible(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->press(FixoFWT::RadioPortabilidadeNao);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertVisible(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->type(FixoFWT::CampoICCID, FuncoesPhp::geraICCIDRandomico());
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertVisible(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->press(FixoFWT::RadioFaturaEmail);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertMissing(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_CampoEmail);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->type(FixoFWT::CampoEmail, 'teste');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertMissing(FixoFWT::Validar_RadioFatura);
            $browser->assertVisible(FixoFWT::Validar_CampoEmail);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->type(FixoFWT::CampoEmail, 'testetesteteste@teste.com.br');
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->assertMissing(FixoFWT::Validar_SelectPlano);
            $browser->assertMissing(FixoFWT::Validar_RadioPortabilidade);
            $browser->assertMissing(FixoFWT::Validar_CampoICCID);
            $browser->assertMissing(FixoFWT::Validar_RadioFatura);
            $browser->assertMissing(FixoFWT::Validar_CampoEmail);
            $browser->assertVisible(FixoFWT::Validar_RadioDataVencimento);

            $browser->elements(FixoFWT::RadioDataVencimento)[1]->click();

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

}
