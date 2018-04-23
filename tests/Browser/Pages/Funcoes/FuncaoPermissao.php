<?php
/**
 * Created by PhpStorm.
 * User: douglas
 * Date: 30/01/18
 * Time: 13:10
 */

namespace Tests\Browser\Pages\Funcoes;


use App\Permissoes;
use Tests\Browser\Pages\Elementos\CaminhoMenu as Caminho;

class FuncaoPermissao
{

    private static $PermissoesUsuario;

    public  static function ExecutaPermissao($Canal, $Cpf){
        $pegarPermissoes = new Permissoes();
        self::$PermissoesUsuario = $pegarPermissoes->getPermissoesUsuario($Canal, $Cpf);
    }

    public static function UsuarioTemPermissao($VerificarPermissaoUsuario)
    {
        if (array_key_exists($VerificarPermissaoUsuario, Caminho::ListagemMenu(FuncaoLogin::getCanalUsuario()))) {
            $VerificarPermissaoUsuario = Caminho::ListagemMenu(FuncaoLogin::getCanalUsuario())[$VerificarPermissaoUsuario]['PermissaoMenu'];
        }

        foreach (self::$PermissoesUsuario as $permissao) {
            if ($permissao->mod_nome == $VerificarPermissaoUsuario) {
                return true;
            }
        }
        return false;
    }

    public static function FuncaoTemPermissao($VerificarPermissaoFuncao)
    {
        if (array_key_exists($VerificarPermissaoFuncao, Caminho::ListagemMenu(self::$CanalUsuario))) {
            $VerificarPermissaoFuncao = Caminho::ListagemMenu(self::$CanalUsuario)[$VerificarPermissaoFuncao]['PermissaoMenu'];
        }

        foreach (self::$PermissoesUsuario as $permissao) {
            if ($permissao->mod_nome == $VerificarPermissaoFuncao) {
                return true;
            }
        }
        return false;
    }
}