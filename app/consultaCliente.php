<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 17/07/18
 * Time: 16:58
 */

namespace App;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class consultaCliente extends Model
{
    public static function buscaClienteFixa(){

        $resultado = DB::select("select distinct cliente_cpf
                                from sun_relatorios.venda_fixa
                                where status_analise_credito = 8
                                and status_analise_disponibilidade = 11
                                ORDER BY RAND()
                                limit 1");

        return $resultado[0]->cliente_cpf;

    }
}