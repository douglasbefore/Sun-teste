<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use App\consultaCliente;
use App\consultaUF;
use Carbon\Carbon;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP as funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsServicosPAP;

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
        parent::__construct();
        $this->Venda = new VendaPAP();
    }

    public function getVenda(){
        return $this->Venda;
    }

    public function VendaServico($dadosVendaServico){
        $this->getVenda()->setVendaServicos($dadosVendaServico);
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function inicioVenda($primeirVez = true){

        if($primeirVez){
            new VendaElementsPAP();
            new VendaElementsServicosPAP();
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
    public function testEscolherVendaMovel()
    {
        $this->inicioVenda();
        $this->Venda->setVendaMovel(true);

        $this->browse(function (Browser $browser){
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::LoadCarregando);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $pegarDDDVenda = $browser->resolver->driver->executeScript('return $("'.CampoVenda::SelectDDD.'  option:selected").text();');
            $this->getVenda()->setVendaDDD(preg_replace("/[^0-9]/", "", $pegarDDDVenda));

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
    public function testEscolherVendaFixa()
    {
        $this->inicioVenda();
        $this->Venda->setVendaFixa(true);

        $this->browse(function (Browser $browser) {
            $funcoes = new FuncoesGerais();
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaRequisicaoToken);

            $pegarDDDVenda = $browser->resolver->driver->executeScript('return $("'.CampoVenda::SelectDDD.'  option:selected").text();');
            $this->getVenda()->setVendaDDD(preg_replace("/[^0-9]/", "", $pegarDDDVenda));

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

            $pegarDDDVenda = $browser->resolver->driver->executeScript('return $("'.CampoVenda::SelectDDD.'  option:selected").text();');
            $this->getVenda()->setVendaDDD(preg_replace("/[^0-9]/", "", $pegarDDDVenda));

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

            $browser->pause(500);
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
        } else {
            $this->Venda->setClienteNome($clienteNome);
            if (!$browser->element(CampoVenda::CampoClienteNomeCompleto)->isEnabled()) {
                $this->Venda->setClienteCadastroWebVendas(true);
            }
        }

        $campoDataNascimento = $browser->value(CampoVenda::CampoClienteDataNascimento);
        if ($campoDataNascimento == "") {
            $browser->type(CampoVenda::CampoClienteDataNascimento, $this->Venda->getClienteDataNascimento());
        } else {
            if (count(explode('/', $campoDataNascimento)) == 3) {
                $dataAtual = Carbon::now();
                $dataNascimesmo = Carbon::createFromFormat('d/m/Y', $campoDataNascimento);
                $intervalo = $dataAtual->diffInYears($dataNascimesmo);
            } else {
                $intervalo = 0;
            }

            if ($intervalo <= 16 || $intervalo >= 100) {
                $browser->value(CampoVenda::CampoClienteDataNascimento, '');
                $browser->type(CampoVenda::CampoClienteDataNascimento, $this->Venda->getClienteDataNascimento());
            } else {
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
        if ($clienteTelefoneFixo == "" && strlen($clienteTelefoneFixo) != 10) {
            $browser->type(CampoVenda::CampoClienteTelefoneFixo, $this->Venda->getClienteTelefoneFixo());
        }else{
            $this->Venda->setClienteTelefoneFixo($clienteTelefoneFixo);
        }

        $checkbox = $browser->element(CampoVenda::CheckboxReceberSMS);
        if (isset($checkbox)) {
            if (strpos($checkbox->getAttribute('class'), 'selected') !== false) {
                $this->Venda->setClienteReceberSMS('Sim');
            } else {
                $this->Venda->setClienteReceberSMS('Não');
            }
        }

        // Validação para avisar erros nos dados do cliente no dusk.
        $this->assertNotNull($this->Venda->getClienteCPF());
        $this->assertNotNull($this->Venda->getClienteNome());
        $this->assertNotNull($this->Venda->getClienteDataNascimento());
        $this->assertNotNull($this->Venda->getClienteNomeMae());
        $this->assertNotNull($this->Venda->getClienteSexo());
        $this->assertNotNull($this->Venda->getClienteEmail());
        $this->assertNotNull($this->Venda->getClienteTelefoneCelular());
        $this->assertNotNull($this->Venda->getClienteTelefoneFixo());
        $this->assertNotNull($this->Venda->getClienteReceberSMS());
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
//        $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAguardeRealizandoAnalise, null, false);
//        $enderecoSemReserva = $browser->element(CampoVenda::AlertaAguardeRealizandoAnalise);
//        if(isset($enderecoSemReserva)){
//            if($enderecoSemReserva->getText() != 'Facilidade indisponÃ­vel'){
//                echo 'entrou';
//            }
//            if($enderecoSemReserva->getText() != 'EndereÃ§o sem Cobertura'){
//                echo 'entrou';
//            }
//        }

        $fazReserva = $browser->element(ReservaVenda::TituloReservaVenda);
        if(isset($fazReserva)){
            $browser->press(ReservaVenda::BotaoContinuarSemReserva);
        }

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

        $browser->waitUntil('$("'.CampoVenda::CampoEnderecoRua.'").val()!=""', 15);

        $this->Venda->setEnderecoRua($browser->value(CampoVenda::CampoEnderecoRua));
        $this->Venda->setEnderecoBairro($browser->value(CampoVenda::CampoEnderecoBairro));
        $pegarEnderecoUf = $browser->element(CampoVenda::SelectEnderecoUF)->getAttribute('value');
        $this->Venda->setEnderecoEstado($pegarEnderecoUf);
        $pegarEnderecoCidade = $browser->resolver->driver->executeScript('return $("'.CampoVenda::SelectEnderecoCidade.'  option:selected").text();');
        $this->Venda->setEnderecoCidade(trim($pegarEnderecoCidade));

        // Validação para avisar erros nos dados do endereço no dusk.
        $this->assertNotNull($this->Venda->getEnderecoCEP());
        $this->assertNotNull($this->Venda->getEnderecoNumero());
        $this->assertNotNull($this->Venda->getEnderecoRua());
        $this->assertNotNull($this->Venda->getEnderecoBairro());
        $this->assertNotNull($this->Venda->getEnderecoEstado());
        $this->assertNotNull($this->Venda->getEnderecoCidade());

        $funcoes->elementsIsEnabled($browser, CampoVenda::BotaoContinuar);
        $browser->press(CampoVenda::BotaoContinuar);
        $browser->pause(500);
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
            $funcoes->barraRolagemElemento($browser, CampoVenda::RadioEscolhaEndereco, $id);

            if ( strpos(str_replace('-', '', $itemEndereco->getText()), str_replace('-','', $this->Venda->getEnderecoCEP())) !== false
                or $this->Venda->getEnderecoPrimeiroEndereco()){

                $browser->elements(CampoVenda::RadioEscolhaEndereco)[$id]->click();
                $this->getVenda()->setEnderecoRua($browser->elements(CampoVenda::RadioEscolhaEndereco . ' .title')[$id]->getText());
                $achouEndereco = true;

                $browser->pause(200);
                $browser->press(CampoVenda::BotaoContinuar);
                break;
            }
        }

        if(!$achouEndereco){
            $funcoes->barraRolagemElemento($browser,CampoVenda::BotaoCadastrarOutroEndereco);
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
            $this->Venda->setFixaFormatoEnvio($browser->element(FaturaFixa::RadioFormatoEnvioPapel)->getText());

            $random = rand(0, count($browser->elements(FaturaFixa::RadioDataVencimento)) - 1);
            $this->Venda->setFixaDataVencimento($browser->elements(FaturaFixa::RadioDataVencimento)[$random]->getText());
            $browser->elements(FaturaFixa::RadioDataVencimento)[$random]->click();

            $browser->press(FaturaFixa::RadioFormaPagamentoBoleto);
            $this->Venda->setFixaFormaPagamento($browser->element(FaturaFixa::RadioFormaPagamentoBoleto)->getText());
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function trataRodapeValoresVenda()
    {
        $this->browse(function (Browser $browser) {
            $browser->pause(500);
            if($this->getVenda()->isVendaFixa()) {
                $this->getVenda()->setTaxaHabilitacao($browser->element(RodapeVenda::ValueTaxaHabilitacaoFixa)->getText());
                if ($this->getVenda()->getTaxaHabilitacao() != 'Gratuita') {
                    $this->getVenda()->setFormaPagamentoTaxaHabilitacao($browser->element(RodapeVenda::RadioFormaPagamentoAVista)->getText());
                    $browser->press(RodapeVenda::RadioFormaPagamentoAVista);
                } else {
                    $this->getVenda()->setFormaPagamentoTaxaHabilitacao(null);
                }

                $this->getVenda()->setTotalPlanoFixa($browser->element(RodapeVenda::ValueTotalPlanoFixa)->getText());
                $this->getVenda()->setTotalFixaAposMeses($browser->element(RodapeVenda::ValueFixaAposMeses)->getText());
            }

            if($this->getVenda()->isVendaMovel()){
                $this->getVenda()->setTotalPlanoMovel($browser->element(RodapeVenda::ValueTotalPlanoMovel)->getText());
            }
        });
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

            /**
             * @var $vendaServico VendaServicoPAP
             */
            foreach ($this->Venda->getVendaServicos() as $elementServico => $vendaServico) {
                $elementServico.=' ';

                $selectorPanelServicoTopo = $elementServico.ResumoVenda::PanelServicoTopo;
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

                if(!empty($vendaServico->getServicoAdicionais())){
                    $selectorPanelServicoServicosAdicionaisLabel   = $elementServico.ResumoVenda::LabelPanelServicoServicosAdicionais;
                    $selectorPanelServicoServicosAdicionais        = $elementServico.ResumoVenda::PanelServicoServicosAdicionais;
                    $labelResumoServicoAdicionais = $browser->element($selectorPanelServicoServicosAdicionaisLabel);
                    if(isset($labelResumoServicoAdicionais)){
                        foreach ($vendaServico->getServicoAdicionais() as $servicoAdicionais) {
                            $browser->with($selectorPanelServicoServicosAdicionais, function (Browser $panelAdicionais) use ($servicoAdicionais){
                               $panelAdicionais->assertSee($servicoAdicionais);
                            });
                        }
                    }
                }
            }

            // Validar Dados do Cliente
            $browser->assertSeeIn(ResumoVenda::ValueClienteCPF, FuncoesPHP::mascara($this->Venda->getClienteCPF(), '###.###.###-##'));
            $browser->assertSeeIn(ResumoVenda::ValueClienteNome, $this->Venda->getClienteNome());
            $browser->assertSeeIn(ResumoVenda::ValueClienteNomeMae, $this->Venda->getClienteNomeMae());
            // não validar o sexo do cliente pois, caso o usuário ja tenha cadastro no nosso banco de dados, não esta mostrando o sexo do mesmos mo resumo da venda.
            ///$browser->assertSeeIn(ResumoVenda::ValueClienteSexo, $this->Venda->getClienteSexo());
            $browser->assertSeeIn(ResumoVenda::ValueClienteDataNascimento, FuncoesPHP::mascara($this->Venda->getClienteDataNascimento(), '##/##/####'));
            $browser->assertSeeIn(ResumoVenda::ValueClienteTelefoneCelular, FuncoesPHP::mascara($this->Venda->getClienteTelefoneCelular(), '(##) #####-####'));
            $browser->assertSeeIn(ResumoVenda::ValueClienteTelefoneFixo, FuncoesPHP::mascara($this->Venda->getClienteTelefoneFixo(), '(##) ####-####'));
            $browser->assertSeeIn(ResumoVenda::ValueClienteEmail, $this->Venda->getClienteEmail());
            $browser->assertSeeIn(ResumoVenda::ValueClienteReceberSMS, $this->Venda->getClienteReceberSMS());

            // Validar Endereco do Cliente
            $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteRua, $this->Venda->getEnderecoRua());
            if(!$this->Venda->getEnderecoPrimeiroEndereco()) {
                $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteNumero, $this->Venda->getEnderecoNumero());
                $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteCEP, str_replace('-', '', $this->Venda->getEnderecoCEP()));
            }
            if (!is_null($this->Venda->getEnderecoCidade())) {
                $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteCidade, $this->Venda->getEnderecoCidade());
            }
            if (!is_null($this->Venda->getEnderecoEstado())) {
                $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteEstado, consultaUF::retornaUfSigla()[$this->Venda->getEnderecoEstado()]);
            }
            if(!is_null($this->Venda->getEnderecoBairro())) {
                $browser->assertSeeIn(ResumoVenda::ValueEnderecoClienteBairro, $this->Venda->getEnderecoBairro());
            }
            // Validar Fatura Cliente
            if($this->Venda->isVendaFixa()){
                $browser->assertSeeIn(ResumoVenda::ValueFaturaClienteDataVencimento, $this->Venda->getFixaDataVencimento());
                $browser->assertSeeIn(ResumoVenda::ValueFaturaClienteFormatoEnvio, $this->Venda->getFixaFormatoEnvio());
                $browser->assertSeeIn(ResumoVenda::ValueFaturaClienteFormatoPagamento, $this->Venda->getFixaFormaPagamento());
            }

            // Validar Total
            if($this->Venda->isVendaFixa()){
                $browser->assertSeeIn(ResumoVenda::ValueTotalFixa, $this->Venda->getTotalPlanoFixa());
                $browser->assertSeeIn(ResumoVenda::ValueTotalTaxaHabilitacao, $this->Venda->getTaxaHabilitacao());
            }
            if($this->Venda->isVendaMovel()){
                $browser->assertSeeIn(ResumoVenda::ValueTotalMovel, $this->Venda->getTotalPlanoMovel());
            }

            $browser->press(CampoVenda::BotaoEnviarPedido);
            $funcoes->loadCarregandoCampoNull($browser, CampoVenda::AlertaAgurdeCarregandoDados);
            $browser->assertVisible(CampoVenda::MensagemPedidoConcluidoSucesso);
        });
    }

}
