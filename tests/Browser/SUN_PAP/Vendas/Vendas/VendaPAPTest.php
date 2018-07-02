<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

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
    protected $VendaServico;
    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * VendaPAPTest constructor.
     */
    public function __construct()
    {
        $this->Venda = new VendaPAP();
//        $this->Venda->setVendaServicos() = new VendaServicoPAP();
    }

    public function getVenda(){
        return $this->Venda;
    }

    public function VendaServico($dadosVendaServico){
        $this->getVenda()->setVendaServicos($dadosVendaServico);
        $this->VendaServico = new VendaServicoPAP();
    }
//    public function getVendaServico(){
//        return $this->getVenda()->getVendaServicos();
//    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function inicioVenda($primeirVez = true){

        if($primeirVez){
            new VendaElementsPAP();
            new VendaServicosElementsPAP();
            new VendaPAP();
        }

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

                self::inicioVenda(false);
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

            $browser->click(CampoVenda::BotaoRecolherAnalise);
            $browser->pause(500);
        });
    }

    /**
     * @param Browser $browser
     */
    public function preencherCamposDadosCliente(Browser $browser)
    {
        $clienteNome = $browser->value(CampoVenda::CampoClienteNomeCompleto);
        if ($clienteNome == "") {
            $browser->type(CampoVenda::CampoClienteNomeCompleto, $this->Venda->getClienteNome());
        }else{
            $this->Venda->setClienteNome($clienteNome);
            if (!$browser->element(CampoVenda::CampoClienteNomeCompleto)->isEnabled()){
                $this->Venda->setClienteCadastroWebVendas(true);
            }
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

            if($intervalo <= 16 || $intervalo >= 100){
                $browser->value(CampoVenda::CampoClienteDataNascimento, '');
                $browser->type(CampoVenda::CampoClienteDataNascimento, $this->Venda->getClienteDataNascimento());
            }else{
                $this->Venda->setClienteDataNascimento($campoDataNascimento);
            }
        }

        $clienteNomeMae = $browser->value(CampoVenda::CampoClienteNomeMae);
        if ($clienteNomeMae == "") {
            $browser->type(CampoVenda::CampoClienteNomeMae, $this->Venda->getClienteNomeMae());
        }else{
            $this->Venda->setClienteNomeMae($clienteNomeMae);
        }

        $botaoSexoMasculino = $browser->element(CampoVenda::BotaoClienteSexoMasculinoActive);
        $botaoSexoFeminino = $browser->element(CampoVenda::BotaoClienteSexoFemininoActive);
        if (!isset($botaoSexoMasculino) && !isset($botaoSexoFeminino) ) {
            $browser->click($this->Venda->getClienteSexo());
            $this->Venda->setClienteSexo($browser->element($this->Venda->getClienteSexo())->getText());
        }else{
            if(isset($botaoSexoMasculino)){
                $this->Venda->setClienteSexo($browser->element(CampoVenda::BotaoClienteSexoMasculino)->getText());
            }
            if(isset($botaoSexoFeminino)){
                $this->Venda->setClienteSexo($browser->element(CampoVenda::BotaoClienteSexoFeminino)->getText());
            }
        }

        $clienteEmail = $browser->value(CampoVenda::CampoClienteEmail);
        if ($clienteEmail == "") {
            $browser->type(CampoVenda::CampoClienteEmail, $this->Venda->getClienteEmail());
        }else{
            $this->Venda->setClienteEmail($clienteEmail);
        }

        $clienteTelefoneCelular = $browser->value(CampoVenda::CampoClienteTelefoneCelular);
        if ($clienteTelefoneCelular == "") {
            $browser->type(CampoVenda::CampoClienteTelefoneCelular, $this->Venda->getClienteTelefoneCelular());
        }else{
            $this->Venda->setClienteTelefoneCelular($clienteTelefoneCelular);
        }

        $clienteTelefoneFixo = $browser->value(CampoVenda::CampoClienteTelefoneFixo);
        if ($clienteTelefoneFixo == "" || strlen($clienteTelefoneFixo) != 10) {
            $browser->type(CampoVenda::CampoClienteTelefoneFixo, $this->Venda->getClienteTelefoneFixo());
        }else{
            $this->Venda->setClienteTelefoneFixo($clienteTelefoneFixo);
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

    /**
     * @param Browser $browser
     */
    public function faturaFixa(Browser $browser)
    {
        $browser->press(FaturaFixa::RadioFormatoEnvioPapel);
        $browser->elements(FaturaFixa::RadioDataVencimento)[1]->click();

        $browser->press(FaturaFixa::RadioFormaPagamentoBoleto);
    }

}
