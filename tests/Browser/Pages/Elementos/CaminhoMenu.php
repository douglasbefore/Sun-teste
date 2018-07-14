<?php

namespace Tests\Browser\Pages\Elementos;

use Tests\Browser\Pages\Funcoes\FuncaoLogin;

class CaminhoMenu
{
    /**
     * @return array
     */
    public static function ListagemMenu($Canal = FuncaoLogin::CANAL_VAREJO)
    {
        if ($Canal == FuncaoLogin::CANAL_VAREJO) {
            return [
                'InserirRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Inserir',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#form11', 'Cadastro de Rede'],
                    ]
                ],
                'BuscarRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca11', 'Busca de Rede'],
                    ]
                ],
                'ListagemRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoVer', 'Ver todos'],
                        'FormTela' => ['#formRedeAgvivo', 'Listagem de Rede'],
                    ]
                ],
                'InserirUsuario' => [
                    'PermissaoMenu' => 'Usuários > Usuário > Inserir, Editar e Desativar',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Usuário'],
                        'BotaoItem' => ['#MenuModulo8', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formUsuario', 'Cadastro de Usuário'],
                    ],
                ],
                'InserirFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formFuncao', 'Cadastro de Função'],
                    ],
                ],
                'BuscarFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca9', 'Busca de Funções']
                    ],
                ],
                'InserirVenda' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_7'],
                        'SubMenu' => ['#submenu_7_6'],
                        'Grupo' => ['Venda'],
                        'BotaoItem' => ['#MenuModulo22', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#form22', 'Cadastro da Venda']
                    ],
                ],
            ];
        }

        if ($Canal == FuncaoLogin::CANAL_PAP) {
            return [
                'InserirRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Inserir',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#form11', 'Cadastro de Rede'],
                    ]
                ],
                'BuscarRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca11', 'Busca de Rede'],
                    ]
                ],
                'ListagemRede' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_4'],
                        'Grupo' => ['Rede'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoVer', 'Ver todos'],
                        'FormTela' => ['#formRedeAgvivo', 'Listagem de Rede'],
                    ]
                ],
                'InserirUsuario' => [
                    'PermissaoMenu' => 'Usuários > Usuário > Inserir, Editar e Desativar',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Usuário'],
                        'BotaoItem' => ['#MenuModulo8', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formUsuario', 'Cadastro de Usuário'],
                    ],
                ],
                'InserirFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formFuncao', 'Cadastro de Função'],
                    ],
                ],
                'BuscarFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca9', 'Busca de Funções']
                    ],
                ],
                'InserirVendas' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_7'],
                        'SubMenu' => ['#submenu_7_6'],
                        'Grupo' => ['Venda'],
                        'BotaoItem' => ['#MenuModulo22', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['.module-container .container', 'Nova Venda']
                    ],
                ],
            ];
        }

        if ($Canal == FuncaoLogin::CANAL_PDR) {
            return [
                'InserirDistribuidor' => [
                    'PermissaoMenu' => 'PDV > Distribuidores > Inserir',
                    'Caminho' => ['Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_39'],
                        'Grupo' => ['Distribuidores'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#form11', 'Cadastro de Distribuidor'],
                    ],
                ],
                'BuscarDistribuidor' => [
                    'PermissaoMenu' => 'PDV > Distribuidores > Acesso',
                    'Caminho' => ['Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_39'],
                        'Grupo' => ['Distribuidores'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca11', 'Busca de Distribuidor'],
                    ],
                ],
                'ListagemDistribuidor' => [
                    'PermissaoMenu' => 'PDV > Distribuidores > Acesso',
                    'Caminho' => ['Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_39'],
                        'Grupo' => ['Distribuidores'],
                        'BotaoItem' => ['#MenuModulo11', '.corBotaoVer', 'Ver todos'],
                        'FormTela' => ['#formRedeAgvivo', 'Listagem de Distribuidor'],
                    ],
                ],
                'InserirUsuario' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Usuário'],
                        'BotaoItem' => ['#MenuModulo8', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formUsuario', 'Cadastro de Usuário'],
                    ],
                ],
                'InserirFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#formFuncao', 'Cadastro de Função'],
                    ],
                ],
                'BuscarFuncao' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_6'],
                        'SubMenu' => ['#submenu_6_3'],
                        'Grupo' => ['Função'],
                        'BotaoItem' => ['#MenuModulo9', '.corBotaoBusca', 'Buscar Registro'],
                        'FormTela' => ['#busca9', 'Busca de Funções']
                    ],
                ],
                'InserirVenda' => [
                    'PermissaoMenu' => 'PDV > Rede > Acesso',
                    'Caminho' => [
                        'Menu' => ['#menu_7'],
                        'SubMenu' => ['#submenu_7_6'],
                        'Grupo' => ['Venda'],
                        'BotaoItem' => ['#MenuModulo22', '.corBotaoInsere', 'Inserir Registro'],
                        'FormTela' => ['#form22', 'Cadastro da Venda']
                    ],
                ],
            ];
        }
    }
}
