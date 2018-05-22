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
            /* Geral da Venda */
            '@BotaoContinuar' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn',

            // Alertas e informativos
            '@AlertaRequisicaoToken' => '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span',
            '@AlertaCarregandoDados' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.transition-container > div.loading-wrapper > div > span',
            '@AlertaCadastroCPF360' => '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span',

            /* Campos Nova Venda */
            '@CampoClienteCPF' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.field-group > input',
            '@SelectDDD' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(2) > div > div > select',
            '@BotaoServicoMovel' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.movel.web',
            '@BotaoServicoFixa' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.fixa.web > div',
            /* ** VALIDACOES ** */
            '@ValidarCampoClienteCPF' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.form-control-feedback',

            /* Dados do Cliente */
            '@CampoClienteNomeCompleto' => '#nome > div.field-group > input',
            '@CampoClienteDataNascimento' => '#dataNascimento > div.field-group > input',
            '@CampoClienteNomeMae' => '#nomeMae > div.field-group > input',
            '@BotaoSexoMasculino' => '#sexo > div > div:nth-child(1)',
            '@BotaoSexoFeminino' => '#sexo > div > div:nth-child(2)',
            '@CampoClienteEmail' => '#email > div.field-group > input',
            '@CampoClienteTelefoneCelular' => '#celular > div.field-group > input',
            '@CampoClienteTelefoneFixo' => '#fixo > div.field-group > input',
            '@CampoClienteOutroContato' => '#celular > div.field-group > input',
            '@BotaoAnexarDocumento' => '> div:nth-child(6) > div.module-container > div:nth-child(3) > div:nth-child(1) > div > div.panel > div > div.col-12.mt-3 > button',
            /* ** VALIDACOES ** */
            '@ValidarClienteCPF' => '#cpf > div.form-control-feedback',
            '@ValidarClienteNome' => '#nome > div.form-control-feedback',
            '@ValidarClienteDataNascimento' => '#dataNascimento > div.form-control-feedback',
            '@ValidarClienteNomeMae' => '#nomeMae > div.form-control-feedback',
            '@ValidarClienteSexo' => '#sexo > div.form-control-feedback',
            '@ValidarClienteEmail' => '#email > div.form-control-feedback',
            '@ValidarClienteTelefoneCelular' => '#celular > div.form-control-feedback',
            '@ValidarClienteTelefoneFixo' => '#fixo > div.form-control-feedback',

            /* Endereco do cliente */
            '@CampoEnderecoCep' => '#cep > div.field-group > input',
            '@CampoEnderecoNumero' => '#numero > div.field-group > input',
            '@CampoEnderecoRua' => '#rua > div.field-group > input',
            '@CampoEnderecoBairro' => '#bairro > div.field-group > input',
            '@CampoEnderecoComplemento' => 'body > div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div.form-group.input-field.col-6 > div.field-group > input',
            /* ** VALIDACOES ** */


            // Select
            '@SelectEnderecoUF' => '#estado > div > select',
            '@SelectEnderecoCidade' => '#cidade > div > select',
            '@SelectEnderecoTipoComplemento' => 'body > div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div:nth-child(1) > div > select',

        ];
    }
}


