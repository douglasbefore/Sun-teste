<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 30/01/18
 * Time: 13:26
 */

namespace Tests\Feature\SUN_PAP\Cadastros\Usuarios;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;

class UsuarioTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_PAP;

    private static $acao;
    private static $primeiraVez;
    private static $nomeRedeCadastrado;
    private static $nomeRedeListado;
    private static $nomeRedeAlterado;
    private static $nomeRedePesquisado;


    public function testInserirUsuario()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirUsuario';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->select('#fun_id', '10');

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Selecione pelo menos uma Regional');

                $browser->click('#liAbaInfoUsuarioInformacoesAcesso');

                $this->assertCampoDisable($browser,'#uf_all1');
                $this->assertCampoDisable($browser, '#reag_all1');
                $this->assertCampoNotDisable($browser, '#reg_id0');

                $browser->check('reg_id[]', 2);
                $browser->radio('reg_all', 0); // Acesso a isEnabledtodos os Estados das Regionais? - N?o

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Selecione pelo menos uma UF');

                $browser->check('uf[]', 12);
                $browser->radio('terr_all', 0); // Acesso a todos os Territ?rios? - N?o

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Selecione pelo menos um Território');

                $browser->check('terr_id[]', 18);
                $browser->radio('ddd_all', 0); // Acesso a todos os DDDs? - N?o

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Selecione pelo menos um DDD');

                $browser->check('ddd_id[]', 42);

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Escolha pelo menos uma Rede');

                $browser->click('#abaInfoUsuarioRedes');

                $browser->value('#reag_nome_busca', 'info');
                $browser->press('#buttonBuscaItemredes');

        });
    }

}