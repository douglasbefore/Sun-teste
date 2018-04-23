<?php

namespace Tests\Feature\SUN_VAREJO\Cadastros\PDV;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncaoLogin;
use Tests\Browser\Pages\Funcoes\FuncaoPermissao;
use Tests\Browser\Pages\Funcoes\FuncoesMenu;
use Tests\Feature\Funcoes\funcoesPHP;

class RedeTest extends DuskTestCase
{

    private static $canal = FuncaoLogin::CANAL_VAREJO;

    private static $acao;
    private static $primeiraVez;
    private static $nomeRedeCadastrado;
    private static $nomeRedeListado;
    private static $nomeRedeAlterado;
    private static $nomeRedePesquisado;

    /**
     * Validar os campos obrigatórios do cadastro da Rede.
     *
     * @return void
     */
    public function testInserirCadastroRede()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'InserirRede';

            $browser->on(new FuncaoLogin);
//            FuncaoLogin::setFecharComunicao(true);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $browser->pause(1000);

                $browser->assertVisibleAlerta('#reag_nomeAviso');

                $nomeRede = 'Rede Teste ' . funcoesPHP::geraNomeRandomico();
                $browser->value('#reag_nome', $nomeRede);

                $browser->radio('reag_acesso_bko', '2');        // Utiliza BKO? - BKO Proprio
                $browser->radio('reag_outra_campanha', '0');    // Participa de outras Campanhas: Nao

                //Verifica Permissão: O campo Participa de outras Campanhas
                if (FuncaoPermissao::UsuarioTemPermissao('PDV > Rede > Mostrar Campanha TSV')) {
                    $browser->assertSee('Participa do TSV:');
                    $browser->radio('reag_tsv', 1);             //Participa do TSV: Sim

                    $browser->assertSee('Mostra campanha TSV:');
                    $browser->radio('reag_mostrar_tsv', 1);     //Mostra campanha TSV: Sim
                }
                else {
                    $browser->assertSee('Participa do TSV:');
                    $browser->radio('reag_tsv', 1);

                    $browser->assertDontSee('Mostra campanha TSV:');
                }

                //Verifica Permissão: O campo IMEI é preciso premissão na função.
                if (FuncaoPermissao::UsuarioTemPermissao('PDV > Rede > Habilitar campo IMEI')) {
                    $browser->assertSee('Cadastra IMEI do aparelho?');
                    $browser->radio('reag_imei', '1');          // Cadastra IMEI do aparelho? - Sim
                } else {
                    $browser->assertDontSee('Cadastra IMEI do aparelho?');
                }

                $browser->radio('reag_efetua_analise', '1');    // Efetuar Analise? - sim

                $browser->click('#botaoInserirClone');
                $browser->waitFor('#reag_contato_nome1');
                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');

                $browser->assertMissing('#reag_nomeAviso');
                $browser->assertVisibleAlerta('#reag_contato_nome1Info');
                $browser->assertVisibleAlerta('#reag_contato_tel1Aviso');

                $browser->value('#reag_contato_nome1', 'Nome Contato Rede Teste');
                $browser->value('#reag_contato_tel1', '6731313131');

                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');

                $this->alertaErroSistema($browser, '#aviso_icone', 'Cadastrado realizado com sucesso!');

                self::$nomeRedeCadastrado = $nomeRede;
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
    public function testListagemRede()
    {
        $this->browse(function (Browser $browser) {

            $acaoMenu = 'ListagemRede';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->with('#pag', function (Browser $pag) {
                    $pag->assertSee(', visualizando de 1 até ');
                });

                $browser->with('.item', function (Browser $itens) {
                    self::$nomeRedeListado = $itens->element('.col.selec.showMobileCol')->getText();
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
    public function testBuscarRede()
    {
        $this->browse(function (Browser $browser) {

            self::$nomeRedePesquisado = self::nomeRedePesquisar();

            $acaoMenu = 'BuscarRede';

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao($acaoMenu)) {

                $browser->on(new FuncoesMenu);
                $browser->EntrarMenu($acaoMenu);

                $browser->pause(500);
                $browser->value('#reag_nome', self::$nomeRedePesquisado);
                $browser->pause(500);

                $browser->element('#btnSalvar')->click();
                $browser->waitFor('#pag', 20);

                $browser->with('.item', function (Browser $itens) {
                    $itens->assertSee(self::$nomeRedePesquisado);
                });
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste Buscar e editar rede.
     *
     * @return void
     */
    public function testEditarCadastroRede()
    {
        $this->browse(function (Browser $browser) {
            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);

            if (FuncaoPermissao::UsuarioTemPermissao('PDV > Rede > Acesso')) {
                self::$acao = 'editar';
                if (!self::$primeiraVez) {
                    self::$primeiraVez = 'sim';
                } else {
                    self::$primeiraVez = 'nao';
                }

                self::testBuscarRede();

                $browser->waitFor('.item');
                $browser->with('.item', function (Browser $itens) {
                    $itens->click('.botaoEdita');
                });
                $browser->waitFor('#form11');
                $browser->assertSee('Edição de Rede');

                $browser->waitFor('#reag_nome');
                $browser->assertInputValue('#reag_nome', self::$nomeRedePesquisado);

                if (self::$primeiraVez == 'sim') {
                    self::$nomeRedeAlterado = self::$nomeRedePesquisado . ' teste editar';
                } else {
                    self::$nomeRedeAlterado = str_replace(' teste editar', '', self::$nomeRedePesquisado);
                }

                $browser->value('#reag_nome', self::$nomeRedeAlterado);
                $browser->press('.botoesListaItem.botoesItem.corBotaoOk');
                $this->alertaErroSistema($browser, '#aviso_icone', 'Edição realizada com sucesso');

                if (self::$primeiraVez == 'sim') {
                    self::testEditarCadastroRede();
                } else {
                    self::$primeiraVez = null;
                }
            } else {
                $browser->assert(true);
            }
        });
    }

    /**
     * Teste inativar e ativar uma rede.
     *
     * @return void
     */
    public function testInativarAtivarRede()
    {
        $this->browse(function (Browser $browser) {

            $browser->on(new FuncaoLogin);
            $browser->FazerLogin(self::$canal);
            if (FuncaoPermissao::UsuarioTemPermissao('PDV > Rede > Alterar Status')) {

                self::$acao = 'ativar';
                if (!self::$primeiraVez) {
                    self::$primeiraVez = 'sim';
                } else {
                    self::$primeiraVez = 'nao';
                }

                self::testBuscarRede();

                if (!empty($browser->elements('.botaoCancela'))) {
                    $browser->with('.item', function (Browser $itens) {
                        $itens->click('.botaoCancela');
                    });

                    $browser->waitFor('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable');

                    $browser->with('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable', function (Browser $itens) {
                        $itens->assertSee('Atenção! Ao inativar a rede os PDVs vinculados serão inativados também, deseja continuar?');
                        $itens->press('Sim');
                    });

                    $this->alertaErroSistema($browser, '#aviso_icone', 'Rede Atualizada com sucesso!', 60);

                } else {
                    $browser->with('.item', function (Browser $itens) {
                        $itens->click('.botaoOk');
                    });

                    $browser->waitFor('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable');

                    $browser->with('.ui-dialog.ui-corner-all.ui-widget.ui-widget-content.ui-front.ui-dialog-buttons.ui-draggable', function (Browser $itens) {
                        $itens->assertSee('Deseja ativar esta Rede?');
                        $itens->press('Sim');
                    });

                    $this->alertaErroSistema($browser, '#aviso_icone', 'Rede Ativada com sucesso!', 60);
                }

                if (self::$primeiraVez == 'sim') {
                    self::testInativarAtivarRede();
                } else {
                    self::$primeiraVez = null;
                }
            } else {
                self::testListagemRede();

                $browser->assertMissing('.botaoCancela');
                $browser->assertMissing('.botaoOk');
            }
        });
    }

    public function nomeRedePesquisar()
    {
        if (self::$acao == 'editar' or self::$acao == 'ativar') {
            if (self::$primeiraVez == 'sim') {
                if (!is_null(self::$nomeRedeCadastrado)) {
                    return self::$nomeRedeCadastrado;
                } else {
                    self::testListagemRede();
                    return self::$nomeRedeListado;
                }
            } else {
                if (self::$acao == 'editar') {
                    return self::$nomeRedeAlterado;
                }
                if (self::$acao == 'ativar') {
                    return self::$nomeRedePesquisado;
                }
            }
        } else {
            if (!self::$nomeRedeListado) {
                self::testListagemRede();
                return self::$nomeRedeListado;
            } else {
                return self::$nomeRedeListado;
            }
        }
    }
}