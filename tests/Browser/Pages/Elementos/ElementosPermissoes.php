<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 30/01/18
 * Time: 13:10
 */

namespace Tests\Browser\Pages\Elementos;


class ElementosPermissoes
{
    /**
     * @return array
     */
    public static function Elementos(){

        return [
            'permissao' => [
                'fun_adicional' => [
                    'fun_venda'     			=> ['descricaoPermissao' => 'Permissão para realizar Venda?', 	                    'acaoPermissao' => ['']],
                    'fun_bko'   				=> ['descricaoPermissao' => 'É função BKO?',                                        'acaoPermissao' => ['']],
                    'fun_rota'  				=> ['descricaoPermissao' => 'Permissão para realizar Rota?',                        'acaoPermissao' => ['']],
                    'fun_horario_acesso'    	=> ['descricaoPermissao' => 'Controlar horário de acesso?',                         'acaoPermissao' => ['']],
                    'fun_log'   				=> ['descricaoPermissao' => 'Permissão para ver Log?',                              'acaoPermissao' => ['']],
                    'fun_acesso_todas_redes'	=> ['descricaoPermissao' => 'Permissão para acessar todas Redes?',                  'acaoPermissao' => ['']],
                    'fun_acesso_nacional'		=> ['descricaoPermissao' => 'Permissão para ter acesso Nacional?',                  'acaoPermissao' => ['']],
                    'fun_importar_venda'    	=> ['descricaoPermissao' => 'Permissão para importar Venda?',                       'acaoPermissao' => ['']],
                    'fun_tsv'					=> ['descricaoPermissao' => 'Permissão para participar do TSV?',                    'acaoPermissao' => ['']],
                ],
                'mp_id' => [
                    // Ajuda
                    '45'    => ['descricaoPermissao' => ' > Central do cliente > Acesso',                                            'acaoPermissao' => ['']],
                    '56'    => ['descricaoPermissao' => ' > Wiki > Acesso',                                                          'acaoPermissao' => ['']],
                    '118'   => ['descricaoPermissao' => ' > Suporte BKO > Acesso',                                                   'acaoPermissao' => ['']],
                    '46'    => ['descricaoPermissao' => ' > Suporte Sistema > Acesso',                                               'acaoPermissao' => ['']],
                    // Cadastros
                    '63'    => ['descricaoPermissao' => ' > Agenda (Rota) > Acesso',                                                 'acaoPermissao' => ['']],
                    '67'    => ['descricaoPermissao' => ' > Agenda (Rota) > Importar',                                               'acaoPermissao' => ['']],
                    '113'   => ['descricaoPermissao' => ' > Banner (Fixa) > Acesso',                                                 'acaoPermissao' => ['']],
                    '41'    => ['descricaoPermissao' => ' > Importação de Vendas > Acesso',                                          'acaoPermissao' => ['']],
                    '35'    => ['descricaoPermissao' => ' > Meta > Acesso',                                                          'acaoPermissao' => ['']],
                    '38'    => ['descricaoPermissao' => ' > Meta > Enviar Mala Direta',                                              'acaoPermissao' => ['']],
                    '3'     => ['descricaoPermissao' => ' > PDV > Acesso',                                                           'acaoPermissao' => ['']],
                    '88'    => ['descricaoPermissao' => ' > PDV > Alterar Dados do PDV, exceto Status Cadastral',                    'acaoPermissao' => ['']],
                    '20'    => ['descricaoPermissao' => ' > PDV > Alterar Status Cadastral',                                         'acaoPermissao' => ['']],
                    '21'    => ['descricaoPermissao' => ' > PDV > Alterar todos os campos, exceto Dados do PDV e Status Cadastral',  'acaoPermissao' => ['']],
                    '44'    => ['descricaoPermissao' => ' > PDV > Importar PDVs',                                                    'acaoPermissao' => ['']],
                    '122'   => ['descricaoPermissao' => ' > PDV > Inserir',                                                          'acaoPermissao' => ['']],
                    '31'    => ['descricaoPermissao' => ' > PDV > Somente Visualizar',                                               'acaoPermissao' => ['']],
                    '4'     => ['descricaoPermissao' => ' > Rede > Acesso',                                                          'acaoPermissao' => ['BuscarRede', 'ListarRede']],
                    '124'   => ['descricaoPermissao' => ' > Rede > Inserir',                                                         'acaoPermissao' => ['inserirRede']],
                    '7'     => ['descricaoPermissao' => ' > Rota > Acesso',                                                          'acaoPermissao' => ['']],
                    '2'     => ['descricaoPermissao' => ' > Função > Acesso',                                                        'acaoPermissao' => ['']],
                    '115'   => ['descricaoPermissao' => ' > Função > Habilitar filtragem por líder',                                 'acaoPermissao' => ['']],
                    '1'     => ['descricaoPermissao' => ' > Usuário > Acesso',                                                       'acaoPermissao' => ['']],
                    '43'    => ['descricaoPermissao' => ' > Usuário > Importar usuários',                                            'acaoPermissao' => ['']],
                    '47'    => ['descricaoPermissao' => ' > Usuário > Inserir, Editar e Desativar',                                  'acaoPermissao' => ['']],
                    '117'   => ['descricaoPermissao' => ' > Usuário > Obrigar preenchimento do campo líder',                         'acaoPermissao' => ['']],
                    '141'   => ['descricaoPermissao' => ' > Usuário > Permitir cadastrar CPF/CNPJ',                                  'acaoPermissao' => ['']],
                    '30'    => ['descricaoPermissao' => ' > Usuário > Somente Visualizar',                                           'acaoPermissao' => ['']],
                    '132'   => ['descricaoPermissao' => ' > Usuário > Ver BKO online',                                               'acaoPermissao' => ['']],
                    '129'   => ['descricaoPermissao' => ' > Usuário > Ver funções online',                                           'acaoPermissao' => ['']],
                    '54'    => ['descricaoPermissao' => ' > Validação de visitas > Acesso',                                          'acaoPermissao' => ['']],
                    '55'    => ['descricaoPermissao' => ' > Validação de visitas > Qualquer usuário pode validar a Visita?',         'acaoPermissao' => ['']],
                    // Comunicação
                    '6'     => ['descricaoPermissao' => ' > Adm. de comunicados > Acesso', 	                                         'acaoPermissao' => ['']],
                    '90'    => ['descricaoPermissao' => ' > Adm. de comunicados > Excluir ou editar Comunicados de outros usuários', 'acaoPermissao' => ['']],
                    '5'     => ['descricaoPermissao' => ' > Categoria > Acesso',                                                     'acaoPermissao' => ['']],
                    '19'    => ['descricaoPermissao' => ' > Portal de Comunicados > Acesso',                                         'acaoPermissao' => ['']],
                    // Vendas
                    '8'     => ['descricaoPermissao' => ' > Backoffice > Acesso',                                                    'acaoPermissao' => ['']],
                    '39'    => ['descricaoPermissao' => ' > Backoffice > Alterar Status da Venda',                                   'acaoPermissao' => ['']],
                    '65'    => ['descricaoPermissao' => ' > Backoffice > Analisar Venda',                                            'acaoPermissao' => ['']],
                    '87'    => ['descricaoPermissao' => ' > Backoffice > Análise Automática',                                        'acaoPermissao' => ['']],
                    '134'   => ['descricaoPermissao' => ' > Backoffice > Editar Venda Finalizada',                                   'acaoPermissao' => ['']],
                    '136'   => ['descricaoPermissao' => ' > Backoffice > Log Venda Finalizada',                                      'acaoPermissao' => ['']],
                    '66'    => ['descricaoPermissao' => ' > Backoffice > Pegar Venda',                                               'acaoPermissao' => ['']],
                    '15'    => ['descricaoPermissao' => ' > Venda > Acesso',                                                         'acaoPermissao' => ['']],
                    '152'   => ['descricaoPermissao' => ' > Venda > Ativar Venda Controle Cartão',                                   'acaoPermissao' => ['']],
                    '17'    => ['descricaoPermissao' => ' > Venda > Cancelar Venda',                                                 'acaoPermissao' => ['']],
                    '133'   => ['descricaoPermissao' => ' > Venda > Editar Venda Finalizada',                                        'acaoPermissao' => ['']],
                    '16'    => ['descricaoPermissao' => ' > Venda > Editar Venda Pendente',                                          'acaoPermissao' => ['']],
                    '114'   => ['descricaoPermissao' => ' > Venda > Inserir Venda',                                                  'acaoPermissao' => ['']],
                    '137'   => ['descricaoPermissao' => ' > Venda > Log Venda Finalizada',                                           'acaoPermissao' => ['']],
                    '103'   => ['descricaoPermissao' => ' > Venda > Vender Apenas Vivo Fixa',                                        'acaoPermissao' => ['']],
                    '104'   => ['descricaoPermissao' => ' > Televendas Fixa > Acesso',                                               'acaoPermissao' => ['']],
                    '105'   => ['descricaoPermissao' => ' > Televendas Fixa > Alterar Status da Venda',                              'acaoPermissao' => ['']],
                    '106'   => ['descricaoPermissao' => ' > Televendas Fixa > Analisar Venda',                                       'acaoPermissao' => ['']],
                    '107'   => ['descricaoPermissao' => ' > Televendas Fixa > Análise Automática',                                   'acaoPermissao' => ['']],
                    '108'   => ['descricaoPermissao' => ' > Televendas Fixa > Pegar Venda',                                          'acaoPermissao' => ['']],
                    '111'   => ['descricaoPermissao' => ' > Vivo Fixa > Acesso',                                                     'acaoPermissao' => ['']],
                    '130'   => ['descricaoPermissao' => ' > Vivo Fixa > Permitir Duplicidade de Leads',                              'acaoPermissao' => ['']],
                    // TreinApp
                    '140'   => ['descricaoPermissao' => ' > TreinApp > Acesso',                                                      'acaoPermissao' => ['']],
                    // Relatórios
                    '42'    => ['descricaoPermissao' => ' > Flash > Acesso',                                                         'acaoPermissao' => ['']],
                    '40'    => ['descricaoPermissao' => ' > Meta > Acesso',                                                          'acaoPermissao' => ['']],
                    '18'    => ['descricaoPermissao' => ' > PDV > Acesso',                                                           'acaoPermissao' => ['']],
                    '79'    => ['descricaoPermissao' => ' > Redes > Acesso',                                                         'acaoPermissao' => ['']],
                    '73'    => ['descricaoPermissao' => ' > Analítico de Agenda > Acesso',                                           'acaoPermissao' => ['']],
                    '11'    => ['descricaoPermissao' => ' > Check-in > Acesso',                                                      'acaoPermissao' => ['']],
                    '71'    => ['descricaoPermissao' => ' > Gráfico de Visitas > Acesso',                                            'acaoPermissao' => ['']],
                    '10'    => ['descricaoPermissao' => ' > Rotas > Acesso',                                                         'acaoPermissao' => ['']],
                    '12'    => ['descricaoPermissao' => ' > Visitas > Acesso',                                                       'acaoPermissao' => ['']],
                    '99'    => ['descricaoPermissao' => ' > Relatório de Acessos > Acesso',                                          'acaoPermissao' => ['']],
                    '9'     => ['descricaoPermissao' => ' > Analítico de Vendas > Acesso',                                           'acaoPermissao' => ['']],
                    '135'   => ['descricaoPermissao' => ' > Analítico de Vendas > Mostrar Código IBGE',                              'acaoPermissao' => ['']],
                    '138'   => ['descricaoPermissao' => ' > Analítico de Vendas > Ver Venda Finalizada',                             'acaoPermissao' => ['']],
                    '69'    => ['descricaoPermissao' => ' > Exportar Planos > Acesso',                                               'acaoPermissao' => ['']],
                    '34'    => ['descricaoPermissao' => ' > Gráfico de Vendas > Acesso',                                             'acaoPermissao' => ['']],
                    '36'    => ['descricaoPermissao' => ' > Gráfico de Vendas Improdutivas > Acesso',                                'acaoPermissao' => ['']],
                    '142'   => ['descricaoPermissao' => ' > Gráfico de Vendas Vivo Fixa > Acesso',                                   'acaoPermissao' => ['']],
                    '61'    => ['descricaoPermissao' => ' > Mapa de Vendas > Acesso',                                                'acaoPermissao' => ['']],
                    '37'    => ['descricaoPermissao' => ' > Relatório Gerencial > Acesso',                                           'acaoPermissao' => ['']],
                    '109'   => ['descricaoPermissao' => ' > Relatório Televendas > Acesso',                                          'acaoPermissao' => ['']],
                    '102'   => ['descricaoPermissao' => ' > Resumo Analítico > Acesso',                                              'acaoPermissao' => ['']],
                    '101'   => ['descricaoPermissao' => ' > Vendas Time > Acesso',                                                   'acaoPermissao' => ['']],
                ],
                'amp_id' => [
                    // ArcGIS
                    '13'    => ['descricaoPermissao' => 'ArcGIS > Acesso',                                                           'acaoPermissao' => ['']],
                    // Atendimento Online
                    '8'     => ['descricaoPermissao' => 'Chat > Acesso',                                                             'acaoPermissao' => ['']],
                    // Check-in
                    '11'    => ['descricaoPermissao' => 'Check de Rota > Acesso',                                                    'acaoPermissao' => ['']],
                    '4'     => ['descricaoPermissao' => 'Check-In > Acesso',                                                         'acaoPermissao' => ['']],
                    // Comunicados
                    '7'     => ['descricaoPermissao' => 'Comunicados > Acesso',                                                      'acaoPermissao' => ['']],
                    // Home

                    // Nova Senha
                    '15'    => ['descricaoPermissao' => 'Nova Senha > Acesso',                                                       'acaoPermissao' => ['']],
                    // Nova Vendas Fixa
                    '21'    => ['descricaoPermissao' => 'Listar Venda Fixa > Acesso',                                                'acaoPermissao' => ['']],
                    '20'    => ['descricaoPermissao' => 'Nova Vendas Fixa > Acesso',                                                 'acaoPermissao' => ['']],
                    // Potêncial Vendas
                    '18'    => ['descricaoPermissao' => 'Potêncial Vendas > Acesso',                                                 'acaoPermissao' => ['']],
                    // Relatórios
                    '10'    => ['descricaoPermissao' => 'Relatorios > Acesso',                                                       'acaoPermissao' => ['']],
                    // Rota
                    '9'     => ['descricaoPermissao' => 'Lista de Rotas > Acesso',                                                   'acaoPermissao' => ['']],
                    // Suporte BKO
                    '19'    => ['descricaoPermissao' => 'Suporte BKO > Acesso',                                                      'acaoPermissao' => ['']],
                    // TreinaApp
                    '16'    => ['descricaoPermissao' => 'TreinaApp > Acesso',                                                        'acaoPermissao' => ['']],
                    // Venda
                    '12'    => ['descricaoPermissao' => 'Editar Venda Pendente > Acesso',                                            'acaoPermissao' => ['']],
                    '3'     => ['descricaoPermissao' => 'Lista de Vendas > Acesso',                                                  'acaoPermissao' => ['']],
                    '2'     => ['descricaoPermissao' => 'Nova Venda > Acesso',                                                       'acaoPermissao' => ['']],
                    // Visita
                    '5'     => ['descricaoPermissao' => 'Registrar Visita > Acesso',                                                 'acaoPermissao' => ['']],
                    // Visita Equipe de Rua
                    '17'    => ['descricaoPermissao' => 'Visita Equipe de Rua > Acesso',                                             'acaoPermissao' => ['']],
                ]
            ]
        ];
    }
}