<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 30/01/18
 * Time: 13:10
 */

namespace Tests\Browser\Pages\Elementos;


use App\Http\Controllers\PermissoesController;

class ElementosPermissoes
{
    /**
     * @return array
     */
    public static function Elementos($Canal = FuncaoLogin::CANAL_VAREJO){





        if($Canal == FuncaoLogin::CANAL_VAREJO){
            return [
                'funcoes' => [  'Administrador',
                                'Admin Vivo',
                                'Usuário Master',
                                'Admin Parceiro',
                                'Supervisor BKO Vivo',
                                'Supervisor BKO Vivo Fixa',
                                'Supervisor BKO Pós Fatura',
                                'Supervisor BKO Parceiro',
                                'Gestão Nacional',
                                'BKO Vivo',
                                'BKO Vivo Fixa',
                                'BKO Pós Fatura',
                                'Coordenador Nacional GNV',
                                'Coordenador Regional GNV',
                                'Gestão Regional',
                                'Gerente de Contas Sell Out',
                                'Gerente de Negócio Varejo',
                                'Gerente de Loja',
                                'Acesso Rede',
                                'Supervisor de Loja',
                                'Coordenador de Loja',
                                'BKO Parceiro',
                                'Vendedor',
                ]
            ];
        }

        if($Canal == FuncaoLogin::CANAL_PAP){
            return [
                'funcoes' => [  'Administrador PaP',
                                'Usuário Master',
                                'Gestão Nacional',
                                'Gestão Regional',
                                'Território',
                                'Administrativo',
                                'Gerente de Contas',
                                'Supervisor BKO',
                                'Supervisor BKO Parceiro',
                                'Supervisor BKO CD',
                                'Gerencia Parceiro',
                                'BKO Parceiro Fixa',
                                'BKO Móvel',
                                'BKO Parceiro Móvel',
                                'BKO Parceiro Fixa+Móvel',
                                'BKO CD Fixa',
                                'BKO Fixa',
                                'BKO CD Fixa+Móvel',
                                'BKO CD Móvel',
                                'BKO Fixa+Móvel',
                                'Coordenador CD',
                                'Supervisor de Venda',
                                'Supervisor CD',
                                'Parcerias',
                                'Vendedor',
                                'Vendedor CD',
                                'Vendedor TLV',
                                'Vendedor PAP',
                ]
            ];
        }
        if($Canal == FuncaoLogin::CANAL_PDR){
            return [
                'funcoes' => [  'Administrador PDR',
                                'Usuário Master',
                                'Supervisor BKO',
                                'Supervisor BKO TSA',
                                'Gestão Nacional',
                                'PDV BKO',
                                'BKO TSA',
                                'Gerente de Seção',
                                'Gerente de Divisão',
                                'Gestão Regional',
                                'Diretor Regional',
                                'Território',
                                'Distribuidor',
                                'Gerente de Contas Sell Out',
                                'Gerente Comercial',
                                'Multiplicador',
                                'Suporte Distribuidor',
                                'Supervisor',
                                'Vendedor',
                                'PDV Proprietário',
                                'PDV Venda',
                ]
            ];
        }
    }
}