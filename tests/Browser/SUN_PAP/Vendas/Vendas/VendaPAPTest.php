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
    static $arrayTipoServicos = [];
    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * @throws \Exception
     * @throws \Throwable
     * @Test InserirVendaVendedor
     * @group InserirVendaVendedor
     */
    public function testInserirVendaVendedorMovel()
    {
        new VendaServicosElementsPAP();
        new VendaElementsPAP();

        $this->browse(function (Browser $browser){

            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
//            $browser->FazerLogin(self::$canal, '02717678123');
            $browser->FazerLogin(self::$canal, '05114040189');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $cpf = FuncoesPhp::gerarCPF(1);
//            $cpf = '04809269132';
//            $cpf = '05448296114';
            $browser->type(CampoVenda::CampoVendaCPFCliente, $cpf);

            foreach (self::$arrayTipoServicos as $TipoServico){
                $browser->click($TipoServico);
            }

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

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

            if(in_array(TipoServicos::BotaoFixa, self::$arrayTipoServicos) ){
                $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaBuscandoGruposOferta);

                $browser->waitForText('Grupo de Oferta');
                $browser->elements(CampoVenda::RadioGrupoOferta)[0]->click();

                $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
                $browser->press(CampoVenda::BotaoContinuar);
            }

        });
    }
}
