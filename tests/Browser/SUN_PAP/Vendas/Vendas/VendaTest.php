<?php

namespace Tests\Feature\SUN_PAP\Vendas\Vendas;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncaoPermissao;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Feature\Funcoes\funcoesPHP;

class VendaTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_PAP;

    /**
     * Validar os campos obrigatórios do cadastro da Rede.
     *
     * @return void
     */
    public function testInserirCadastroRede()
    {

        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirVendas';

            $browser->visit(new VendaPage);
            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal, '02717678123');

            $browser->on(new FuncoesMenu);
            $browser->EntrarMenu($acaoMenu);

            $browser->value('@InputCPF', '1234567891');

//            $browser->press('.btn.btn-primary.primary-actions');

            $browser->pause(2000);
        });
    }
}