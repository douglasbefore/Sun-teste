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
        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaBuscandoGruposOferta);

        $browser->waitForText('Grupo de Oferta');
        $browser->elements(CampoVenda::RadioGrupoOferta)[0]->click();

        $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
        $browser->press(CampoVenda::BotaoContinuar);
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
        $this->getVenda()->setEnderecoRua($browser->value(CampoVenda::CampoEnderecoRua));

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
                $this->getVenda()->setEnderecoRua($browser->elements(CampoVenda::RadioEscolhaEndereco . ' .title')[$id]->getText());
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
     * @throws \Exception
     * @throws \Throwable
     */
    public function faturaFixa()
    {
        $this->browse(function (Browser $browser) {
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->pause(500);

            $browser->press(FaturaFixa::RadioFormatoEnvioPapel);
            $browser->elements(FaturaFixa::RadioDataVencimento)[1]->click();

            $browser->press(FaturaFixa::RadioFormaPagamentoBoleto);
        });
    }

    /**
     * @param Browser $browser
     */
    public function trataRodapeValoresVenda(Browser $browser)
    {
        $browser->pause(500);
        if($this->getVenda()->isVendaFixa()) {
            $this->getVenda()->setTaxaInstalacao($browser->element(RodapeVenda::ValueTaxaInstalacaoFixa)->getText());
            if ($this->getVenda()->getTaxaInstalacao() != 'Gratuita') {
                $this->getVenda()->setFormaPagamentoTaxaInstalacao($browser->element(RodapeVenda::RadioFormaPagamentoAVista)->getText());
                $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
            } else {
                $this->getVenda()->setFormaPagamentoTaxaInstalacao(null);
            }

            $this->getVenda()->setTotalPlanoFixa($browser->element(RodapeVenda::ValueTotalPlanoFixa)->getText());
            $this->getVenda()->setTotalFixaAposMeses($browser->element(RodapeVenda::ValueFixaAposMeses)->getText());
        }

        if($this->getVenda()->isVendaMovel()){
            $this->getVenda()->setTotalPlanoMovel($browser->element(RodapeVenda::ValueTotalPlanoMovel)->getText());
        }
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function validarResumoVenda(){

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $funcoes->elementsIsEnabled($browser,CampoVenda::BotaoContinuar);
            $browser->press(CampoVenda::BotaoContinuar);
            $browser->waitFor(CampoVenda::BotaoEnviarPedido);

            foreach ($this->Venda->getVendaServicos() as $vendaServico) {

                $elementServico = $vendaServico->getServicoElementoPlanoResumo().' ';

                $selectorPanelServicoTopo                      = $elementServico.ResumoVenda::PanelServicoTopo;
                $selectorPanelServicoServicosAdicionaisLabel   = $elementServico.ResumoVenda::LabelPanelServicoServicosAdicionais;
                $selectorPanelServicoServicosAdicionais        = $elementServico.ResumoVenda::PanelServicoServicosAdicionais;

                $nomeServico = $vendaServico->getServicoNome().' - '.$vendaServico->getServicoDescricaoPlano();
                $browser->assertSeeIn($selectorPanelServicoTopo, $nomeServico);

                if (!is_null($vendaServico->getServicoValor())) {
                    $labelResumoServicoValor = $browser->element($elementServico . ResumoVenda::LabelPanelServicoValor);
                    if (isset($labelResumoServicoValor)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoValor, $vendaServico->getServicoValor());
                    }
                }

                if (!is_null($vendaServico->getServicoTipoCliente())) {
                    $labelResumoServicoTipoCliente = $browser->element($elementServico . ResumoVenda::LabelPanelServicoTipoCliente);
                    if (isset($labelResumoServicoTipoCliente)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoTipoCliente, $vendaServico->getServicoTipoCliente());
                    }
                }

//                if (!is_null($vendaServico->getServicoTrocaChip())) {
//                    $labelResumoServicoTrocaChip = $browser->element($elementServico . ResumoVenda::LabelPanelServicoTrocaChip);
//                    if (isset($labelResumoServicoTrocaChip)) {
//                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoTrocaChip, $vendaServico->getServicoTrocaChip());
//                    }
//                }

                if (!is_null($vendaServico->getServicoOperadora())) {
                    $labelResumoServicoOperadora = $browser->element($elementServico . ResumoVenda::LabelPanelServicoOperadora);
                    if (isset($labelResumoServicoOperadora)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoOperadora, $vendaServico->getServicoOperadora());
                    }
                }

                if (!is_null($vendaServico->getServicoNumeroCliente())) {
                    $labelResumoServicoNumeroCliente = $browser->element($elementServico . ResumoVenda::LabelPanelServicoNumeroCliente);
                    if (isset($labelResumoServicoNumeroCliente)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoNumeroCliente, $vendaServico->getServicoNumeroCliente());
                    }
                }

                if (!is_null($vendaServico->getServicoPortabilidade())) {
                    $labelResumoServicoPortabilidade = $browser->element($elementServico . ResumoVenda::LabelPanelServicoPortabilidade);
                    if (isset($labelResumoServicoPortabilidade)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoPortabilidade, $vendaServico->getServicoPortabilidade());
                    }
                }

                if (!is_null($vendaServico->getServicoICCID())) {
                    $labelResumoServicoICCID = $browser->element($elementServico . ResumoVenda::LabelPanelServicoICCID);
                    if (isset($labelResumoServicoICCID)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoICCID, $vendaServico->getServicoICCID());
                    }
                }

                if (!is_null($vendaServico->getServicoFatura())) {
                    $labelResumoServicoFatura = $browser->element($elementServico . ResumoVenda::LabelPanelServicoFatura);
                    if (isset($labelResumoServicoFatura)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoFatura, $vendaServico->getServicoFatura());
                    }
                }

                if (!is_null($vendaServico->getServicoDataVencimento())) {
                    $labelResumoServicoDataVencimento = $browser->element($elementServico . ResumoVenda::LabelPanelServicoDataVencimento);
                    if (isset($labelResumoServicoDataVencimento)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoDataVencimento, $vendaServico->getServicoDataVencimento());
                    }
                }

                if (!is_null($vendaServico->getServicoOutraOperadora())) {
                    $labelResumoServicoOutraOperadora = $browser->element($elementServico . ResumoVenda::LabelPanelServicoOutraOperadora);
                    if (isset($labelResumoServicoOutraOperadora)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoOutraOperadora, $vendaServico->getServicoOutraOperadora());
                    }
                }

                if (!is_null($vendaServico->getServicoEmail())) {
                    $labelResumoServicoEmail = $browser->element($elementServico . ResumoVenda::LabelPanelServicoEmail);
                    if (isset($labelResumoServicoEmail)) {
                        $browser->assertSeeIn($elementServico . ResumoVenda::ValuePanelServicoEmail, $vendaServico->getServicoEmail());
                    }
                }

            }

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

}
