<?php

namespace Tests\Browser\Pages\SUN_PAP\Vendas\Vendas;

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
     * @param  Browser $browser
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
            /* Geral da Venda */
            '@BotaoContinuar' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn',
            '@BotaoVoltar' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn.btn-link.secondary-actions',
            '@BotaoRecolherAnalise' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.sidebar-container > div.sidebar > span',
            '@BotaoEnviarPedido' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn.btn-success.ml-auto',

            // Alertas e informativos
            '@AlertaRequisicaoToken' => '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span',
            '@AlertaCarregandoDados' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.transition-container > div.loading-wrapper > div > span',
            '@AlertaCadastroCPF360' => '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span',
            '@AlertaEnderecoCarregandoCidade' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(6) > div > div.loading-wrapper > div > span',
            '@AlertaAgurdeRealizandoAnalise' => '> div:nth-child(6) > div.module-container > div.pagina-erro > div.mensagem > div.titulo',
            '@AlertaAgurdeCarregandoDados' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div.loading-wrapper > div > span',
            '@MensagemPedidoConcluidoSucesso' => '> div:nth-child(6) > div.module-container > div.container.venda-finalizada > div.container.venda-finalizada > div > div.message',


            /* Atribua a venda a um vendedor */
            '@CampoVendedorEstado' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(1) > div > div > select',
            '@CampoVendedorPontoVenda' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(2) > div > div > div.field-group > input',
            '@CampoVendedorVendedor' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(3) > div > div > div.field-group > input',

            /* Campos Nova Venda */
            '@CampoVendaCPFCliente' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.field-group > input',
            '@Validar_CampoVendaCPFCliente' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.form-control-feedback',
            '@SelectDDD' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(2) > div > div > select',
            '@BotaoServicoMovel' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.movel.web',
            '@BotaoServicoFixa' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.fixa.web > div',
            /* ** VALIDACOES ** */

            /* Dados do Cliente */
            '@CampoClienteCPF' => '#cpf > div.form-control-feedback',
            '@Validar_CampoClienteCPF' => '#cpf > div.form-control-feedback',
            '@CampoClienteNomeCompleto' => '#nome > div.field-group > input',
            '@Validar_CampoClienteNomeCompleto' => '#nome > div.form-control-feedback',
            '@CampoClienteDataNascimento' => '#dataNascimento > div.field-group > input',
            '@Validar_CampoClienteDataNascimento' => '#dataNascimento > div.form-control-feedback',
            '@CampoClienteNomeMae' => '#nomeMae > div.field-group > input',
            '@Validar_CampoClienteNomeMae' => '#nomeMae > div.form-control-feedback',
            '@BotaoClienteSexoMasculino' => '#sexo > div > div:nth-child(1)',
            '@BotaoClienteSexoFeminino' => '#sexo > div > div:nth-child(2)',
            '@Validar_BotaoClienteSexo' => '#sexo > div.form-control-feedback',
            '@CampoClienteEmail' => '#email > div.field-group > input',
            '@Validar_CampoClienteEmail' => '#email > div.form-control-feedback',
            '@CampoClienteTelefoneCelular' => '#celular > div.field-group > input',
            '@Validar_CampoClienteTelefoneCelular' => '#celular > div.form-control-feedback',
            '@CampoClienteTelefoneFixo' => '#fixo > div.field-group > input',
            '@Validar_CampoClienteTelefoneFixo' => '#fixo > div.form-control-feedback',
            '@CampoClienteOutroContato' => '#celular > div.field-group > input',
            '@BotaoAnexarDocumento' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div:nth-child(1) > div > div.panel > div > div.col-12.mt-3 > button',
            /* ** VALIDACOES ** */

            /* Endereco do cliente */
            '@CampoEnderecoCep' => '#cep > div.field-group > input',
            '@Validar_CampoEnderecoCep' => '#cep > div.form-control-feedback',
            '@CampoEnderecoNumero' => '#numero > div.field-group > input',
            '@Validar_CampoEnderecoNumero' => '#numero > div.form-control-feedback',
            '@CampoEnderecoRua' => '#rua > div.field-group > input',
            '@CampoEnderecoBairro' => '#bairro > div.field-group > input',
            '@SelectEnderecoUF' => '#estado > div > select',
            '@SelectEnderecoCidade' => '#cidade > div > select',
            '@SelectEnderecoTipoComplemento' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div:nth-child(1) > div > select',
            '@CampoEnderecoComplemento' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div.form-group.input-field.col-6 > div.field-group > input',
            '@Validar_CampoEnderecoComplemento' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div.form-group.input-field.has-danger.col-6 > div.form-control-feedback',
            /* ** VALIDACOES ** */

            /* incluir serviço */
            '@BotaoServicoIncluirServico' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div:nth-child(1) > div:nth-child(1) > button',
            '@BotaoServicoMovelMovelControleFatura' => '.icon-card.controleFatura',
            '@BotaoServicoMovelMovelControleFaturaDesabilitado' => '.icon-card.disabled.controleFatura',
            '@BotaoServicoMovelFixoFWT' => '.icon-card.fixoFWT',
            '@BotaoServicoMovelFixoFWTDesabilitado' => '.icon-card.disabled.fixoFWT',
            '@BotaoServicoMovelControleCartao' => '.icon-card.controleCartao',
            '@BotaoServicoMovelControleCartaoDesabilitado' => '.icon-card.disabled.controleCartao',
            '@BotaoServicoMovelControlePassDigital' => '.icon-card.controlePassDigital',
            '@BotaoServicoMovelControlePassDigitalDesabilitado' => '.icon-card.disabled.controlePassDigital',

            /* Servico Controle Fatura */
            '@AlertaServicoControleFaturaCarregandoPlanos' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > div.loading-wrapper > div > span',
            '@BotaoServicoControleFaturaRemoverServico' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.remove > span',
            '@SelectServicoControleFaturaPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > [id^="plano_"] > div > select',
            '@Validar_SelectServicoControleFaturaPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback',
            '@RadioServicoControleFaturaTipoClienteAlta' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)',
            '@RadioServicoControleFaturaTipoClienteMigracao' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)',
            '@RadioServicoControleFaturaTipoClienteUpgrade' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)',
            '@Validar_RadioServicoControleFaturaTipoCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback',
            '@RadioServicoControleFaturaPortabilidadeSim' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div > div:nth-child(1) > span',
            '@RadioServicoControleFaturaPortabilidadeNao' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div > div:nth-child(2) > span',
//            '@Validar_RadioServicoControleFaturaPortabilidade' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback',
            '@CampoServicoControleFaturaICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input',
            '@Validar_CampoServicoControleFaturaICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback',
            '@CampoServicoControleFaturaNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input',
            '@Validar_CampoServicoControleFaturaNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback',
            '@SelectServicoControleFaturaOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select',
            '@Validar_SelectServicoControleFaturaOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback',
            '@SelectServicoControleFaturaOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input',
            '@Validar_SelectServicoControleFaturaOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback',
            '@RadioServicoControleFaturaFaturaEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)',
            '@RadioServicoControleFaturaFaturaViaPostal' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)',
            '@Validar_RadioServicoControleFaturaFatura' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback',
            '@CampoServicoControleFaturaEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input',
            '@Validar_CampoServicoControleEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback',
            '@RadioServicoControleFaturaDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div',
            '@Validar_RadioServicoControleFaturaDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback',

            /* Servico Fixo FWT */
            '@AlertaServicoFixoFWTCarregandoPlanos' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > div.loading-wrapper > div > span',
            '@BotaoServicoFixoFWTRemoverServico' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.remove > span',
            '@SelectServicoFixoFWTPlano' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > [id^="plano_"] > div > select',
            '@Validar_SelectServicoFixoFWTPlano' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback',
            '@RadioServicoFixoFWTPortabilidadeSim' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)',
            '@RadioServicoFixoFWTPortabilidadeNao' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)',
//            '@Validar_RadioServicoFixoFWTPortabilidade' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback',
            '@CampoServicoFixoFWTNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input',
            '@Validar_CampoServicoFixoFWTNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback',
            '@SelectServicoFixoFWTOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select',
            '@Validar_SelectServicoFixoFWTOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback',
            '@SelectServicoFixoFWTOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input',
            '@Validar_SelectServicoFixoFWTOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback',
            '@CampoServicoFixoFWTICCID' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input',
            '@Validar_CampoServicoFixoFWTICCID' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback',
            '@RadioServicoFixoFWTFaturaEmail' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)',
            '@RadioServicoFixoFWTFaturaViaPostal' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)',
            '@Validar_RadioServicoFixoFWTFatura' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback',
            '@CampoServicoFixoFWTEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input',
            '@Validar_CampoServicoFixoFWTEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback',
            '@RadioServicoFixoFWTDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div',
            '@Validar_RadioServicoFixoFWTDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback',

            /* Servico Controle Cartao */
            '@AlertaServicoControleCartaoTipoCarregandoPlanos' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > div.loading-wrapper > div > span',
            '@BotaoServicoControleCartaoRemoverServico' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.remove > span',
            '@SelectServicoControleCartaoPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > [id^="plano_"] > div > select',
            '@Validar_SelectServicoControleCartaoPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback',
            '@BotaoServicoControleCartaoTipoClienteAlta' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)',
            '@BotaoServicoControleCartaoTipoClienteMigracao' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)',
            '@BotaoServicoControleCartaoTipoClienteUpgrade' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)',
            '@Validar_BotaoServicoControleCartaoTipoCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback',
            '@CampoServicoControleCartaoNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input',
            '@Validar_CampoServicoControleCartaoNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback',
            '@CampoServicoControleCartaoICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input',
            '@Validar_CampoServicoControleCartaoICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback',

            /* Controle Pass Digital */
            '@AlertaServicoPassDigitalCarregandoPlanos' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > div.loading-wrapper > div > span',
            '@BotaoServicoPassDigitalRemoverServico' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.remove > span',
            '@SelectServicoPassDigitalPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > [id^="plano_"] > div > select',
            '@Validar_SelectServicoPassDigitalPlano' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback',
            '@RadioServicoPassDigitalTipoClienteAlta' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)',
            '@RadioServicoPassDigitalTipoClienteMigracao' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)',
            '@RadioServicoPassDigitalTipoClienteUpgrade' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)',
            '@Validar_RadioServicoPassDigitalTipoCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback',
            '@RadioServicoPassDigitalPortabilidadeSim' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)',
            '@RadioServicoPassDigitalPortabilidadeNao' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)',
//            '@Validar_RadioServicoPassDigitalPortabilidade' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback',
            '@CampoServicoPassDigitalNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input',
            '@Validar_CampoServicoPassDigitalNumeroCliente' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback',
            '@SelectServicoPassDigitalOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select',
            '@Validar_SelectServicoPassDigitalOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback',
            '@SelectServicoPassDigitalOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input',
            '@Validar_SelectServicoPassDigitalOutraOperadora' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback',
            '@CampoServicoPassDigitalICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input',
            '@Validar_CampoServicoPassDigitalICCID' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback',
            '@RadioServicoPassDigitalFaturaEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)',
            '@RadioServicoPassDigitalFaturaViaPostal' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)',
            '@Validar_RadioServicoPassDigitalFatura' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback',
            '@CampoServicoPassDigitalEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input',
            '@Validar_CampoServicoPassDigitalEmail' => '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback',
            '@RadioServicoPassDigitalDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div',
            '@Validar_RadioServicoPassDigitalDataVencimento' => '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback',
        ];
    }
}
