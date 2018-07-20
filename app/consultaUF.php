<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 20/07/18
 * Time: 16:09
 */

namespace App;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class consultaUF extends Model
{
    public static function retornaUfSigla() {

        return array(
            1 => 'AC',
            2 => 'AL',
            3 => 'AM',
            4 => 'AP',
            5 => 'BA',
            6 => 'CE',
            7 => 'DF',
            8 => 'ES',
            9 => 'GO',
            10 => 'MA',
            11 => 'MG',
            12 => 'MS',
            13 => 'MT',
            14 => 'PA',
            15 => 'PB',
            16 => 'PE',
            17 => 'PI',
            18 => 'PR',
            19 => 'RJ',
            20 => 'RN',
            21 => 'RO',
            22 => 'RR',
            23 => 'RS',
            24 => 'SC',
            25 => 'SE',
            26 => 'SP',
            27 => 'TO',
        );
    }
}