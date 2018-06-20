<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaPAPTest extends DuskTestCase
{
    static $vendaFixa = false;
    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function inicioVenda($cpfUsuario = '05114040189')
    {
        $this->browse(function (Browser $browser) use ($cpfUsuario) {

            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
//            $browser->FazerLogin(self::$canal, '02717678123');
            $browser->FazerLogin(self::$canal, $cpfUsuario);

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function escolherVendaMovel($cpfCliente = null){

        new VendaElementsPAP();

        $this->browse(function (Browser $browser) use ($cpfCliente) {
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::LoadCarregando);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            if(!isset($cpfCliente)){
                $cpfCliente = FuncoesPhp::gerarCPF(1);
            }
            $browser->type(CampoVenda::CampoVendaCPFCliente, $cpfCliente);

            $browser->click(TipoServicos::BotaoMovel);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function escolherVendaFixa($cpfCliente = null){

        new VendaElementsPAP();
        self::$vendaFixa = true;

        $this->browse(function (Browser $browser) use ($cpfCliente) {
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            if(!isset($cpfCliente)){
                $cpfCliente = FuncoesPhp::gerarCPF(1);
            }
            $browser->type(CampoVenda::CampoVendaCPFCliente, $cpfCliente);

            $browser->click(TipoServicos::BotaoFixa);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function escolherVendaMovelFixa($cpfCliente = null){

        new VendaElementsPAP();
        self::$vendaFixa = true;

        $this->browse(function (Browser $browser) use ($cpfCliente) {
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            if(!isset($cpfCliente)){
                $cpfCliente = FuncoesPhp::gerarCPF(1);
            }
            $browser->type(CampoVenda::CampoVendaCPFCliente, $cpfCliente);

            $browser->click(TipoServicos::BotaoFixa);
            $browser->pause(100);
            $browser->click(TipoServicos::BotaoMovel);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function dadosCliente(){

        new VendaElementsPAP();

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCarregandoDados);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCadastroCPF360);

            $funcoesVenda = new VendaPAPFuncao();
            $retornoClienteCadastroWebVendas = $funcoesVenda->PreencherCamposDadosCliente($browser);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

            if(!$retornoClienteCadastroWebVendas) {
                $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCarregandoDados);
                $browser->value(CampoVenda::CampoEnderecoCep, '');
                $browser->value(CampoVenda::CampoEnderecoNumero, '');

                $browser->type(CampoVenda::CampoEnderecoCep, '79020-250');
                $browser->type(CampoVenda::CampoEnderecoNumero, '780');
                $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaEnderecoCarregandoCidade);

                $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
                $browser->press(CampoVenda::BotaoContinuar);
            }
            else{
                $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAguardandoWebVendas);
                $browser->waitForText('Escolha o Endereço');
                $browser->elements(CampoVenda::RadioEscolhaEndereco)[0]->click();
                $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
                $browser->press(CampoVenda::BotaoContinuar);
            }

            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaVerificando);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAguardeRealizandoAnalise);

            if(self::$vendaFixa){
                $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaBuscandoGruposOferta);

                $browser->waitForText('Grupo de Oferta');
                $browser->elements(CampoVenda::RadioGrupoOferta)[0]->click();

                $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
                $browser->press(CampoVenda::BotaoContinuar);
            }

        });
    }
}
