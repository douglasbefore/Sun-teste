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
    public function PreencherCamposDadosCliente(Browser $browser)
    {
        $clienteCadastroWebVendas = false;

        if ($browser->value(CampoVenda::CampoClienteNomeCompleto) == "") {
            $browser->type(CampoVenda::CampoClienteNomeCompleto, 'Teste Teste Teste');
        }elseif (!$browser->element(CampoVenda::CampoClienteNomeCompleto)->isEnabled()){
            $clienteCadastroWebVendas = true;
        }

        if ($browser->value(CampoVenda::CampoClienteDataNascimento) == "") {
            $browser->type(CampoVenda::CampoClienteDataNascimento, '11111946');
        }
        if ($browser->value(CampoVenda::CampoClienteNomeMae) == "") {
            $browser->type(CampoVenda::CampoClienteNomeMae, 'Mae Teste Teste');
        }
        if ($browser->value(CampoVenda::BotaoClienteSexoMasculino) == "") {
            $browser->click(CampoVenda::BotaoClienteSexoMasculino);
        }
        if ($browser->value(CampoVenda::CampoClienteEmail) == "") {
            $browser->type(CampoVenda::CampoClienteEmail, 'testeteste@teste.com.br');
        }
        if ($browser->value(CampoVenda::CampoClienteTelefoneCelular) == "") {
            $browser->type(CampoVenda::CampoClienteTelefoneCelular, '67985856498');
        }
        if ($browser->value(CampoVenda::CampoClienteTelefoneFixo) == "" || strlen($browser->value(CampoVenda::CampoClienteTelefoneFixo)) != 10) {
            $browser->type(CampoVenda::CampoClienteTelefoneFixo, '6733331111');
        }

        return $clienteCadastroWebVendas;
    }

    public function possuiServicoFixa()
    {

    }
}