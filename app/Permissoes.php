<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Permissoes extends Model
{
    private static $conecao;

    public function __construct()
    {
        if(env('APP_AMBIENTE') == 'beta'){
            self::$conecao = env('DB_CONNECTION_BETA');
        }else{
            self::$conecao = env('DB_CONNECTION');
        }
    }

    public function getPermissoesUsuario($canal ,$cpfUsuario) {

        $resultado = DB::connection(self::$conecao)
            ->select("SELECT DISTINCT
                                    CONCAT( '', menu_sub.sub_nome, '', ' > ', COALESCE( mcv.mvc_nome, modulo.mod_nome ), ' > ',  modulo_permissao.mp_nome) AS mod_nome
                            FROM modulo
                            INNER JOIN menu_sub
                                    ON menu_sub.sub_id = modulo.sub_id
                            inner join menu
                                    on menu_sub.me_id = menu.me_id
                            INNER JOIN modulo_vivo_canal mcv
                                    ON mcv.mod_id = modulo.mod_id AND mcv.can_id = {$canal}
                            INNER JOIN modulo_permissao
                                    ON modulo_permissao.mod_id = modulo.mod_id
                            INNER JOIN (select ufm.fun_id, ufm.mp_id
                                                 from usuario_funcao_modulo ufm
                                                 inner join usuario us
                                                    on us.fun_id = ufm.fun_id
                                                    and us.us_cpf = {$cpfUsuario}
                                                    and us.can_id = {$canal}) as t
                                    ON t.mp_id = modulo_permissao.mp_id
                            WHERE modulo_permissao.mp_ativo = 1
                            ORDER BY menu.me_nome, menu_sub.sub_nome ASC, modulo.mod_nome ASC");

        return $resultado;
    }

    public function getPermissoesFuncao($canal ,$funcao) {

        $resultado = DB::connection(self::$conecao)
            ->select("SELECT DISTINCT
                                    CONCAT( '', menu_sub.sub_nome, '', ' > ', COALESCE( mcv.mvc_nome, modulo.mod_nome ), ' > ',  modulo_permissao.mp_nome) AS mod_nome
                            FROM modulo
                            INNER JOIN menu_sub
                                    ON menu_sub.sub_id = modulo.sub_id
                            inner join menu
                                    on menu_sub.me_id = menu.me_id
                            INNER JOIN modulo_vivo_canal mcv
                                    ON mcv.mod_id = modulo.mod_id AND mcv.can_id = {$canal}
                            INNER JOIN modulo_permissao
                                    ON modulo_permissao.mod_id = modulo.mod_id
                            INNER JOIN (select ufm.mp_id
                                        from usuario_funcao_modulo ufm
                                        inner join funcao f
                                                 ON ufm.fun_id = f.fun_id
                                        where f.fun_nome like '{$funcao}'
                                          and f.can_id = {$canal} ) as t
                                    ON t.mp_id = modulo_permissao.mp_id
                            WHERE modulo_permissao.mp_ativo = 1
                            ORDER BY menu.me_nome, menu_sub.sub_nome ASC, modulo.mod_nome ASC");

        return $resultado;
    }
}
