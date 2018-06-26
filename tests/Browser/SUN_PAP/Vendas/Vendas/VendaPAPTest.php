<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaServicosElementsPAP;

class VendaPAPTest extends DuskTestCase
{
    protected $Venda;
    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * VendaPAPTest constructor.
     */
    public function __construct()
    {
        $this->Venda = new VendaPAP();
    }

    public function getVenda(){
        return $this->Venda;
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function inicioVenda(){

        new VendaElementsPAP();
        new VendaPAP();

        $this->browse(function (Browser $browser){

            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal, $this->Venda->getUsuarioLogin());

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $alertaIntervaloVenda = $browser->element(CampoVenda::AlertaIntervaloInicioVenda);
            if(isset($alertaIntervaloVenda)){
                $browser->press(CampoVenda::BotaoVoltarAlertaIntervaloInicioVenda);
                $browser->pause(20000);

                self::inicioVenda();
            }
        });
    }

    /**
     * Verifica se os dados para escolher o Serviço Movel estão corretos.
     * @throws \Exception
     * @throws \Throwable
     * @Test EscolherVendaMovel
     * @group EscolherVendaMovel
     * @return void
     */
    public function testEscolherVendaMovel(){

        $this->inicioVenda();
        $this->Venda->setVendaMovel(true);

        $this->browse(function (Browser $browser){
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::LoadCarregando);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $browser->type(CampoVenda::CampoVendaCPFCliente, $this->Venda->getClienteCPF());
            $browser->click(TipoServicos::BotaoMovel);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
        });
    }

    /**
     * Verifica se os dados para escolher o Serviço Fixa estão corretos.
     * @throws \Exception
     * @throws \Throwable
     * @Test escolherVendaFixa
     * @group escolherVendaFixa
     * @return void
     */
    public function testEscolherVendaFixa(){

        $this->inicioVenda();
        $this->Venda->setVendaFixa(true);

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $browser->type(CampoVenda::CampoVendaCPFCliente, $this->Venda->getClienteCPF());

            $browser->click(TipoServicos::BotaoFixa);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
        });
    }

    /**
     * Verifica se os dados para escolher os Serviços Movel e fixa estão corretos.
     * @throws \Exception
     * @throws \Throwable
     * @Test EsolherVendaMovelFixa
     * @group EsolherVendaMovelFixa
     * @return void
     */
    public function testEsolherVendaMovelFixa(){

        $this->inicioVenda();
        $this->Venda->setVendaMovel(true);
        $this->Venda->setVendaFixa(true);

        $this->browse(function (Browser $browser){
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $browser->type(CampoVenda::CampoVendaCPFCliente, $this->Venda->getClienteCPF());

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

            $this->preencherCamposDadosCliente($browser);

            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);

            if($this->Venda->isVendaFixa()) {
                $this->fluxoVendaFixa($browser);
            }else{
                $this->fluxoVendaMovel($browser);
            }

        });
    }

    /**
     * @param Browser $browser
     */
    public function preencherCamposDadosCliente(Browser $browser)
    {
        if ($browser->value(CampoVenda::CampoClienteNomeCompleto) == "") {
            $browser->type(CampoVenda::CampoClienteNomeCompleto, $this->Venda->getClienteNome());
        }elseif (!$browser->element(CampoVenda::CampoClienteNomeCompleto)->isEnabled()){
            $this->Venda->setClienteCadastroWebVendas(true);
        }

        $campoDataNascimento = $browser->value(CampoVenda::CampoClienteDataNascimento);
        if ($campoDataNascimento == "") {
            $browser->type(CampoVenda::CampoClienteDataNascimento, $this->Venda->getClienteDataNascimento());
        }else{
            if(strripos($campoDataNascimento, '/')) {
                $dataAtual = Carbon::now();
                $dataNascimesmo = Carbon::createFromFormat('d/m/Y', $campoDataNascimento);
                $intervalo = $dataAtual->diffInYears($dataNascimesmo);
            }else{
                $intervalo = 0;
            }

            if($intervalo <= 16){
                $browser->value(CampoVenda::CampoClienteDataNascimento, '');
                $browser->type(CampoVenda::CampoClienteDataNascimento, $this->Venda->getClienteDataNascimento());
            }
        }

        if ($browser->value(CampoVenda::CampoClienteNomeMae) == "") {
            $browser->type(CampoVenda::CampoClienteNomeMae, $this->Venda->getClienteNomeMae());
        }
        if ($browser->value(CampoVenda::BotaoClienteSexoMasculino) == "") {
            $browser->click(CampoVenda::BotaoClienteSexoMasculino);
        }
        if ($browser->value(CampoVenda::CampoClienteEmail) == "") {
            $browser->type(CampoVenda::CampoClienteEmail, $this->Venda->getClienteEmail());
        }
        if ($browser->value(CampoVenda::CampoClienteTelefoneCelular) == "") {
            $browser->type(CampoVenda::CampoClienteTelefoneCelular, $this->Venda->getClienteTelefoneCelular());
        }
        if ($browser->value(CampoVenda::CampoClienteTelefoneFixo) == "" || strlen($browser->value(CampoVenda::CampoClienteTelefoneFixo)) != 10) {
            $browser->type(CampoVenda::CampoClienteTelefoneFixo, $this->Venda->getClienteTelefoneFixo());
        }
    }

    /**
     * @param Browser $browser
     */
    public function fluxoVendaMovel(Browser $browser)
    {
        $this->cadastroEnderecoVenda($browser);
    }

    /**
     * @param Browser $browser
     */
    public function fluxoVendaFixa(Browser $browser){
        $funcoes = new FuncoesGerais();

        if(!$this->Venda->isClienteCadastroWebVendas()) {
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCarregandoDados);
            $this->cadastroEnderecoVenda($browser);
            $this->escolhaEndereco($browser);
        }else {
            $this->escolhaEndereco($browser);
        }

        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAguardeRealizandoAnalise);

//        $facilidadeIndisponivel = $browser->element(CampoVenda::AlertaFacilidadeIndisponivel);
//        if(!isset($facilidadeIndisponivel)) {
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaBuscandoGruposOferta);

            $browser->waitForText('Grupo de Oferta');
            $browser->elements(CampoVenda::RadioGrupoOferta)[0]->click();

            $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
//        }
    }

    /**
     * @param Browser $browser
     */
    public function cadastroEnderecoVenda(Browser $browser){
        $funcoes = new FuncoesGerais();

        $browser->waitForText('Cadastro de Endereço');
        $browser->value(CampoVenda::CampoEnderecoCep, '');
        $browser->value(CampoVenda::CampoEnderecoNumero, '');

        $browser->type(CampoVenda::CampoEnderecoCep, $this->Venda->getEnderecoCEP());
        $browser->type(CampoVenda::CampoEnderecoNumero, $this->Venda->getEnderecoNumero());
        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaEnderecoCarregandoCidade);

        $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
        $browser->press(CampoVenda::BotaoContinuar);

        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaVerificando);
    }

    /**
     * @param Browser $browser
     */
    public function escolhaEndereco(Browser $browser){
        $achouEndereco = false;

        $funcoes = new FuncoesGerais();
        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAguardandoWebVendas);

        $enderecosEscolha = $browser->elements(CampoVenda::RadioEscolhaEndereco);

        foreach ($enderecosEscolha as $id => $itemEndereco){
            if ( strpos(str_replace('-', '', $itemEndereco->getText()), str_replace('-','', $this->Venda->getEnderecoCEP())) !== false){
                $browser->elements(CampoVenda::RadioEscolhaEndereco)[$id]->click();
                $achouEndereco = true;
                $browser->pause(200);
                $browser->press(CampoVenda::BotaoContinuar);
                break;
            }
        }

        if(!$achouEndereco){
            $browser->press(CampoVenda::BotaoCadastrarOutroEndereco);
            $this->cadastroEnderecoVenda($browser);
            $this->escolhaEndereco($browser);
        }

        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaCadastrandoEndereco, 240);
    }
}
