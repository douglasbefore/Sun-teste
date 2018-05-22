<?php
/**
 * Created by PhpStorm.
 * User: b4_erickson
 * Date: 21/05/18
 * Time: 10:07
 */

namespace Tests\Browser\Pages\SUN_PDR\vendas\vendas;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;


class VendaPage extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return env('URL_PADRAO');
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */

    public function elements()
    {
        return [
            /* Geral da venda*/

            '@BotaoAvancarDadosVenda' => '#step-dados-venda > div.ml-auto.nextBtnVenda.botoesListaItem.botoesItem.corBotaoOk > span',
            '@step1' => '#containerVenda > div.stepwizard.col-sm-8.col-sm-offset-2 > div > div:nth-child(1) > a',
            '@step2' => '#containerVenda > div.stepwizard.col-sm-8.col-sm-offset-2 > div > div:nth-child(2) > a',
            '@step3' => '#containerVenda > div.stepwizard.col-sm-8.col-sm-offset-2 > div > div:nth-child(3) > a',
            '@step4' => '#containerVenda > div.stepwizard.col-sm-8.col-sm-offset-2 > div > div:nth-child(4) > a',
            '@BotaoAvancarServico' => '#step-servicos > div.previousBtnVenda.botoesListaItem.botoesItem > span',
            '@BotaoEfetuarAnalise' => '#efetuar_analise',
            '@BotaoContinuarSemAnalise' => '#continuar_sem_analise > a',
            '@BotaoVoltarAnaliseCredito' => '#step-analise-credito > div.mr-auto.previousBtnVenda.botoesListaItem.botoesItem > span',
            '@BotaoVoltarServico' => '#step-servicos > div.previousBtnVenda.botoesListaItem.botoesItem > span',
            '@BotaoVoltarResumoVenda'=>'#step-resumo-venda > div.mr-auto.previousBtnVenda.botoesListaItem.botoesItem > span',
            '@BotaoFinalizaVenda' => '#btnFinalizaVenda > span',
            '@BotaoSairSistema' => '#menu > div > div:nth-child(10) > div > span',

            /*Alertas e  Informativos*/

            '@AlertCPFSemCadastro360' => '> div.sweet-alert.showSweetAlert.visible > div.sa-button-container > div > button',
            '@AlertExcluirServico'=>'> div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable > div.ui-dialog-titlebar.ui-corner-all.ui-widget-header.ui-helper-clearfix.ui-draggable-handle',

            /* Dados da venda*/

            '@SelectEstado' =>'#ufVenda',
            '@CampoPDV' =>'#fpdr_id_aux',
            '@CampoVendedor' =>'#us_id_aux',

            /*Campos Dados Cliente*/

            '@CampoClienteCPF' => '#pess_cpf',
            '@CampoClienteCarregarCPF' => '#id-usuario-cpf > div.divLeft > div.botoesListaItem.botoesItem.fa.fa-search',
            '@CampoClienteNome' => '#pess_nome',
            '@CampoClienteDataNascimento' => '#pess_data_nasc',
            '@CampoClienteNomeMae' => '#pess_filiacao',
            '@BotaoClienteSexoMasculino' => '#pess_sexo1',
            '@BotaoClienteSexoFeminino' => '#pess_sexo0',
            '@CampoClienteCEP' => '#pess_cep',
            '@CampoClienteCarregarCEP' => '#id-usuario-cep > div:nth-child(2) > div.botoesListaItem.botoesItem.fa.fa-search',
            '@CampoClienteUF' => '#uf_id',
            '@CampoClienteCidade' => 'cid_id',
            '@CampoClienteRua' =>'pess_rua',
            '@BotaoClienteNumero' => '#pess_num',
            '@BotaoClienteSemNumero' => '#id-usuario-num > div.subItem > div.checkBox > label',
            '@CampoClienteBairro' => 'pess_bairro',
            '@CampoClienteCompl' => 'pess_compl',
            '@CampoClienteEmail' => '#pess_email',
            '@CampoClienteTelefone' => '#pess_tel',
            '@CampoClienteTelefone2' => '#pess_tel2',
            '@BotaoVerMaisDadosCliente' => '#spanVerMaisDadosCliente',

            /* Dados do Serviço*/

            '@SelectServicoDDD'=> '#ddd_id_servico',
            '@BotaoServicoFatura' =>'#botao_tipo_plano_1',
            '@BotaoServicoCartao' =>'#botao_tipo_plano_6',
            '@BotaoServicoPassDigital' =>'#botao_tipo_plano_8',
            '@BotaofinalizarVendaImprodutiva' =>'#dadosAdicionaisMensagemServico > button',
            '@SelectServicoTipoVenda' =>'#se_id1',
            '@SelectServicoPlano' =>'#pl_id1',
            '@RadioServicoPortabilidadeNao' =>'#vese_portabilidade10',
            '@RadioServicoPortabilidadeSim' =>'#vese_portabilidade11',
            '@CampoServicoICCID' =>'#vese_iccid1',
            '@CampoServicoNumeroAcesso' =>'#vese_num1',
            '@RadioServicoFaturaPostal' =>'#fatr_id11',
            '@RadioServicoFaturaEmail' =>'##fatr_id12',
            '@RadioServicoVencimentoDia1' =>'#vese_fatura_vencimento11',
            '@RadioServicoVencimentoDia6' =>'#vese_fatura_vencimento16',
            '@RadioServicoVencimentoDia17' =>'#vese_fatura_vencimento117',
            '@RadioServicoVencimentoDia21' =>'#vese_fatura_vencimento121',
            '@RadioServicoVencimentoDia26' =>'#vese_fatura_vencimento126',
            '@BotaoRemoverServico' =>'#vese1 > div.formItemCabecalho > a > label',
            '@BotaoRemoverServicoSim' =>'> div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable > div.ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix > div > button:nth-child(1)',
            '@BotaoRemoverServicoNao' =>'> div.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable > div.ui-dialog-buttonpane.ui-widget-content.ui-helper-clearfix > div > button:nth-child(2)',
            '' =>'',

        ]; // TODO: Change the autogenerated stub
    }

}