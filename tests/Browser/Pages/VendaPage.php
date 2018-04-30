<?php

namespace Tests\Browser\Pages;

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
//
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            // Campos
            '@InputCPF' => '> div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.field-group > input',

            // Botoes
            '@BotaoContinuar' => '> div.module-container > div:nth-child(3) > div.fixed-footer > button.btn.btn-primary.primary-actions',
            '@BotaoServicoMovel' => '> div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.movel.web',
            '@BotaoServicoFixa' => '> div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.fixa.web > span',

            // Label informativo de erros
            '@LabelInformativoCPF' => '> div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.form-control-feedback',
            '' => 'body > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(3) > div > div > div.field-group > input',

            // Alertas e informativos
            '@AlertaRequisicaoToken' => 'body > div.module-container > span > span',

        ];
    }
}
