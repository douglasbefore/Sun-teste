<?php

namespace Tests\Browser\Pages\Funcoes;


use Laravel\Dusk\Browser;
use League\Flysystem\Config;
use Tests\CreatesApplication;
use Tests\FuncoesAssert;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;

class FuncaoLogin extends Page
{
    use CreatesApplication;
    const CANAL_VAREJO  = 2;
    const CANAL_PAP     = 3;
    const CANAL_PDR     = 4;

    const SPAN_VAREJO   = 'SUN';
    const SPAN_PAP      = 'PAP Mobile';
    const SPAN_PDR      = 'Vivo Vendas';

    private static $CpfUltimoUsuarioLogado;
    private static $CanalUsuario;

    private static $LoginPage;
    public static $VerificarBrowserNovo;
    public static $FecharComunicao;

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     * @param string $Canal
     * @param string $Cpf
     * @param string $Senha
     * @return void
     */
    public function FazerLogin(Browser $browser, $Canal, $Cpf = null, $Senha = null){

        if (!$Cpf) {
            $Cpf = self::getCpfUsuario();
        }
        if(!$Senha){
            $Senha  = self::getSenhaUsuario();
        }

        if ($browser->driver != self::$VerificarBrowserNovo) {

            self::$LoginPage = new UrlPage();
            self::$VerificarBrowserNovo = $browser->driver;
            self::$CpfUltimoUsuarioLogado = $Cpf;

            $browser->visit(self::$LoginPage);
            $browser->maximize();

            self::Logar($browser, $Canal, $Cpf, $Senha);
        }
        elseif ($Cpf != self::$CpfUltimoUsuarioLogado){

            $browser->script("$('.menuAbrir.open').click();");
            $browser->pause(500);

            $browser->press('.fa.fa-power-off');

            $browser->driver->switchTo()->alert()->accept();

            self::Logar($browser, $Canal, $Cpf, $Senha);
            self::$CpfUltimoUsuarioLogado = $Cpf;
        }

    }

    public static function Logar(Browser $browser, $Canal, $Cpf, $Senha){

        self::$CanalUsuario = $Canal;

        $browser->waitFor('#us_login_icone');
        $browser->select('can_id', $Canal);

        $browser->type('us_re', $Cpf);
        $browser->type('us_senha', $Senha);

        $browser->press('Entrar');

        $browser->on(new FuncoesGerais);
        $browser->loadCarregando();

        if(!self::$FecharComunicao) {
            self::VerificarComunicado($browser);
        }

        $browser->waitFor('.tool-logo');
        $browser->assertSee(self::spanCanal($Canal));
    }

    public static function VerificarComunicado(Browser $browser){
        if($browser->element('#janela')->isDisplayed()){
            $browser->waitFor('#muralRecadosConteudo', 20);
            if($browser->element('.x')->isDisplayed()){
                $browser->press('.x');
            }else{
                $browser->press('.botoesListaItem.botoesItem.corBotaoFechar');
            }
        }
    }

    public static function spanCanal($canal){
        if($canal == self::CANAL_VAREJO){
            return self::SPAN_VAREJO;
        }
        if($canal == self::CANAL_PAP){
            return self::SPAN_PAP;
        }
        if($canal == self::CANAL_PDR){
            return self::SPAN_PDR;
        }
    }

    /**
     * @return mixed
     */
    public static function getCpfUsuario()
    {
//        if(env('APP_AMBIENTE') == 'beta') {
//            return env('LOGIN_USUARIO_BETA');
//        }else{
            return env('LOGIN_USUARIO_LOCAL');
//        }
    }

    /**
     * @return mixed
     */
    public static function getSenhaUsuario()
    {
//        if(env('APP_AMBIENTE') == 'beta') {
//            return env('SENHA_USUARIO_BETA');
//        }else{
            return env('SENHA_USUARIO_LOCAL');
//        }
    }

    /**
     * Foi criada essa nova variavel, para verificar se o Browser foi
     * fechado, pois verfica toda vez que � selecionado para fazer o login.
     *
     * @return mixed
     */
    public static function getVerificarBrowserNovo()
    {
        return self::$VerificarBrowserNovo;
    }

    /**
     * @param mixed $VerificarBrowserNovo
     */
    public static function setVerificarBrowserNovo($VerificarBrowserNovo)
    {
        self::$VerificarBrowserNovo = $VerificarBrowserNovo;
    }

    /**
     * @return mixed
     */
    public static function getCanalUsuario()
    {
        return self::$CanalUsuario;
    }

    /**
     * @param bool $FecharComunicao
     */
    public static function setFecharComunicao(bool $FecharComunicao)
    {
        self::$FecharComunicao = $FecharComunicao;
    }
}