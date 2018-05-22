<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Laravel\Dusk\Browser;

class VendaPAPFuncao
{
    public function PreencherCamposDadosCliente(Browser $browser){
        if($browser->value('@CampoClienteNomeCompleto') == "") {
            $browser->type('@CampoClienteNomeCompleto', 'Teste Teste Teste');
            $browser->type('@CampoClienteDataNascimento', '11111946');
            $browser->type('@CampoClienteNomeMae', 'Mae Teste Teste');
            $browser->click('@BotaoSexoMasculino');
            $browser->type('@CampoClienteEmail', 'testeteste@teste.com.br');
            $browser->type('@CampoClienteTelefoneCelular', '67985856498');
        }else{
            if($browser->value('@CampoClienteNomeCompleto') == ""){
                $browser->type('@CampoClienteNomeCompleto', 'Teste Teste Teste');
            }
            if($browser->value('@CampoClienteDataNascimento') == "") {
                $browser->type('@CampoClienteDataNascimento', '11111946');
            }
            if($browser->value('@CampoClienteNomeMae') == "") {
                $browser->type('@CampoClienteNomeMae', 'Mae Teste Teste');
            }
            if($browser->value('@BotaoSexoMasculino') == "") {
                $browser->click('@BotaoSexoMasculino');
            }
            if($browser->value('@CampoClienteEmail') == "") {
                $browser->type('@CampoClienteEmail', 'testeteste@teste.com.br');
            }
            if($browser->value('@CampoClienteTelefoneCelular') == "") {
                $browser->type('@CampoClienteTelefoneCelular', '67985856498');
            }
            if($browser->value('@CampoClienteTelefoneCelular') == "" || strlen($browser->value('@CampoClienteTelefoneCelular')) != 10) {
                $browser->type('@CampoClienteTelefoneFixo', '6733331111');
            }
        }
    }

    public function PreencherCamposEndereco(Browser $browser, $cep){

    }

}