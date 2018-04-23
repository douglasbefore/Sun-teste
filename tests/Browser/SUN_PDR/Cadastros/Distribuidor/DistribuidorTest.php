<?php

namespace Tests\Feature\SUN_PAP\Cadastros\Distribuidor;


use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncaoPermissao;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Feature\Funcoes\funcoesTeste;

class DistribuidorTestTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_PDR;

    private static $acao;
    private static $primeiraVez;
    private static $nomeDistribuidorCadastrado;
    private static $nomeDistribuidorListado;
    private static $nomeDistribuidorAlterado;
    private static $nomeDistribuidorPesquisado;

    /**
     * Validar os campos obrigatórios do cadastro da Distribuidor.
     *$VerificarPermissao
     * @return void
     */
    public function testInserirCadastroDistribuidor()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirDistribuidor';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $browser->pause(1000);

                $browser->assertVisibleAlerta('#reag_nomeAviso');

                $nomeDistribuidor = 'Distribuidor Teste ' . funcoesPHP::geraNomeRandomico();
                $browser->value('#reag_nome', $nomeDistribuidor);

                $browser->radio('reag_acesso_bko', '2');        // Utiliza BKO? - BKO Pr�prio
                $browser->radio('reag_efetua_analise', '1');    // Efetuar Analise? - sim

                //Verifica Permissão: O campo IMEI é preciso premição na função.
                if (FuncaoPermissao::UsuarioTemPermissao('PDV > Distribuidores > Habilitar campo IMEI')) {
                    $browser->assertSee('Cadastra IMEI do aparelho?');
                    $browser->radio('reag_imei', '1');              // Cadastra IMEI do aparelho? - Sim
                } else {
                    $browser->assertDontSee('Cadastra IMEI do aparelho?');
                }

                $browser->click('#botaoInserirClone');
                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');

                $browser->assertMissing('#reag_nomeAviso');
                $browser->waitFor('#reag_contato_nome1');
                $browser->assertVisibleAlerta('#reag_contato_nome1Info');
                $browser->assertVisibleAlerta('#reag_contato_tel1Aviso');
                $browser->assertVisibleAlerta('#reag_contato_email1Aviso');

                $browser->value('#reag_contato_nome1', 'Nome Contato Distribuidor Teste');
                $browser->value('#reag_contato_tel1', '6731313131');
                $browser->value('#reag_contato_email1', 'contatoDistribuidorteste@teste.com');

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Cadastrado realizado com sucesso!');

                self::$nomeDistribuidorCadastrado = $nomeDistribuidor;
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste Listagem de venda.
     *
     * @return void
     */
    public function testListagemDistribuidor()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'ListagemDistribuidor';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->with('#pag', function (Browser $pag) {
                    $pag->assertSee(', visualizando de 1 até ');
                });

                $browser->with('.item', function (Browser $itens) {
                    self::$nomeDistribuidorListado = $itens->element('.col.selec.showMobileCol')->getText();
                });
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste Listagem de venda.
     *
     * @return void
     */
    public function testBuscarDistribuidor()
    {
        $this->browse(function (Browser $browser) {

            self::$nomeDistribuidorPesquisado = self::nomeDistribuidorPesquisar();

            $acaoMenu = 'BuscarDistribuidor';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->pause(500);
                $browser->value('#reag_nome', self::$nomeDistribuidorPesquisado);
                $browser->pause(500);

                $browser->element('#btnSalvar')->click();
                $browser->waitFor('#pag', 20);

                $browser->with('.item', function (Browser $itens) {
                    $itens->assertSee(self::$nomeDistribuidorPesquisado);
                });
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste Buscar e editar Distribuidor.
     *
     * @return void
     */
    public function testEditarCadastroDistribuidor()
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao('PDV > Distribuidores > Acesso')) {
                self::$acao = 'editar';
                if (!self::$primeiraVez) {
                    self::$primeiraVez = 'sim';
                } else {
                    self::$primeiraVez = 'nao';
                }

                self::testBuscarDistribuidor();

                $browser->with('.item', function (Browser $itens) {
                    $itens->click('.botaoEdita');
                });
                $browser->waitFor('#form11');
                $browser->assertSee('Edição de Distribuidor');

                $browser->assertInputValue('#reag_nome', self::$nomeDistribuidorPesquisado);
                if (self::$primeiraVez == 'sim') {
                    self::$nomeDistribuidorAlterado = self::$nomeDistribuidorPesquisado . ' teste editar';
                } else {
                    self::$nomeDistribuidorAlterado = str_replace(' teste editar', '', self::$nomeDistribuidorPesquisado);
                }
                $browser->value('#reag_nome', self::$nomeDistribuidorAlterado);

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Edição realizada com sucesso');

                if (self::$primeiraVez == 'sim') {
                    self::testEditarCadastroDistribuidor();
                } else {
                    self::$primeiraVez = null;
                }
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste inativar e ativar uma Distribuidor.
     *
     * @return void
     */
    public function testInativarAtivarDistribuidor()
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);
            if (FuncaoPermissao::UsuarioTemPermissao('PDV > Distribuidores > Alterar Status')) {

                self::$acao = 'ativar';
                if (!self::$primeiraVez) {
                    self::$primeiraVez = 'sim';
                } else {
                    self::$primeiraVez = 'nao';
                }

                self::testBuscarDistribuidor();

                if (!empty($browser->elements('.botaoCancela'))) {
                    $browser->with('.item', function (Browser $itens) {
                        $itens->click('.botaoCancela');
                    });

                    $browser->waitFor('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable');

                    $browser->with('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable', function (Browser $itens) {
                        $itens->assertSee('Atenção! Ao inativar a rede os PDVs vinculados serão inativados também, deseja continuar?');
                        $itens->press('Sim');
                    });

                    $this->alertaErroSistema($browser, '#aviso_icone', 'Rede Atualizada com sucesso!');

                } else {
                    $browser->with('.item', function (Browser $itens) {
                        $itens->click('.botaoOk');
                    });

                    $browser->waitFor('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable');

                    $browser->with('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable', function (Browser $itens) {
                        $itens->assertSee('Deseja ativar esta Rede?');
                        $itens->press('Sim');
                    });

                    $this->alertaErroSistema($browser, '#aviso_icone', 'Rede Ativada com sucesso!');
                }

                if (self::$primeiraVez == 'sim') {
                    self::testInativarAtivarDistribuidor();
                } else {
                    self::$primeiraVez = null;
                }
            } else {
                self::testListagemDistribuidor();

                $browser->assertMissing('.botaoCancela');
                $browser->assertMissing('.botaoOk');
            }
        });
    }

    public function nomeDistribuidorPesquisar()
    {
        if (self::$acao == 'editar' or self::$acao == 'ativar') {
            if (self::$primeiraVez == 'sim') {
                if (!is_null(self::$nomeDistribuidorCadastrado)) {
                    return self::$nomeDistribuidorCadastrado;
                } else {
                    self::testListagemDistribuidor();
                    return self::$nomeDistribuidorListado;
                }
            } else {
                if (self::$acao == 'editar') {
                    return self::$nomeDistribuidorAlterado;
                }
                if (self::$acao == 'ativar') {
                    return self::$nomeDistribuidorPesquisado;
                }
            }
        } else {
            if (!self::$nomeDistribuidorListado) {
                self::testListagemDistribuidor();
                return self::$nomeDistribuidorListado;
            } else {
                return self::$nomeDistribuidorListado;
            }
        }
    }
}
