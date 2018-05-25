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

        ];
    }
}
