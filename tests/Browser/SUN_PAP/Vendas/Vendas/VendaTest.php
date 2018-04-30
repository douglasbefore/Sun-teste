<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;


use Tests\Browser\Pages\VendaPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * @throws \Exception
     * @throws \Throwable
     * @Test InserirVendaVendedor
     * @group InserirVendaVendedor
     */
    public function testInserirVendaVendedor()
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new VendaPage);
            $acaoMenu = 'InserirVendas';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal, '02717678123');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $browser->on(new FuncoesGerais);
            $browser->loadCarregando('@AlertaRequisicaoToken');

            $this->assertCampoDisable($browser, '@BotaoContinuar');
            $browser->value('@InputCPF', '1234567891');
            $this->assertCampoDisable($browser, '@BotaoContinuar');
            $browser->press('@BotaoServicoMovel');
            $browser->assertVisible('@LabelInformativoCPF');
            $this->assertCampoDisable($browser, '@BotaoContinuar');

            $browser->value('@InputCPF', FuncoesPhp::cpfRandom());

            $browser->pause(5000);
            $browser->press('@BotaoContinuar');
            $browser->pause(2000);
        });
    }
}
