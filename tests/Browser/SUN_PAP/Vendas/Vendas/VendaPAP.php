<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use ArrayObject;
use Carbon\Carbon;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Funcoes\FuncoesGerais;
use Tests\Feature\Funcoes\funcoesPHP;
use Tests\Browser\SUN_PAP\Vendas\Vendas\VendaElementsPAP;

class VendaPAP
{
    private $usuarioLogin;
    private $vendaDDD;
    private $vendaFixa;
    private $vendaMovel;
    private $vendaServicos = array();
    private $clienteCadastroWebVendas;
    private $clienteCPF;
    private $clienteNome;
    private $clienteDataNascimento;
    private $clienteNomeMae;
    private $clienteSexo;
    private $clienteEmail;
    private $clienteTelefoneCelular;
    private $clienteTelefoneFixo;
    private $clienteReceberSMS;
    private $enderecoCEP;
    private $enderecoNumero;
    private $enderecoRua;
    private $taxaInstalacao;
    private $formaPagamentoTaxaInstalacao;
    private $fixaFormatoEnvio;
    private $fixaDataVencimento;
    private $fixaFormaPagamento;
    private $totalPlanoFixa;
    private $totalFixaAposMeses;
    private $totalPlanoMovel;


    public function __construct()
    {
        new VendaElementsPAP();
        $this->usuarioLogin = '12270707729';  // Usuario Vendedor

        $this->vendaFixa = false;
        $this->vendaMovel = false;

        $this->clienteCadastroWebVendas = false;
        $this->clienteCPF = FuncoesPhp::gerarCPF(1);
        $this->clienteNome = 'Teste Teste Teste';
        $this->clienteDataNascimento = '11/11/1946';
        $this->clienteNomeMae = 'Mae Teste Teste';
        $this->clienteSexo = CampoVenda::BotaoClienteSexoMasculino;
        $this->clienteEmail = 'testeteste@teste.com.br';
        $this->clienteTelefoneCelular = '(67) 98585-6498';
        $this->clienteTelefoneFixo = '(67) 3333-1111';
        $this->clienteReceberSMS = 'Não';

        $this->enderecoCEP = '79020-250';
        $this->enderecoNumero = '780';
    }

    /**
     * @return array
     */
    public function getVendaServicos()
    {
        return $this->vendaServicos;
    }

    /**
     * @param $vendaServicos
     */
    public function setVendaServicos(VendaServicoPAP $vendaServicos): void
    {
        $this->vendaServicos[$vendaServicos->getServicoElementoPlanoResumo()] = $vendaServicos;
    }

    /**
     * @return string
     */
    public function getUsuarioLogin(): string
    {
        return $this->usuarioLogin;
    }

    /**
     * @param string $usuarioLogin
     */
    public function setUsuarioLogin(string $usuarioLogin): void
    {
        $this->usuarioLogin = $usuarioLogin;
    }

    /**
     * @return mixed
     */
    public function getVendaDDD()
    {
        return $this->vendaDDD;
    }

    /**
     * @param mixed $vendaDDD
     */
    public function setVendaDDD($vendaDDD): void
    {
        $this->vendaDDD = $vendaDDD;
    }

    /**
     * @return bool
     */
    public function isVendaFixa(): bool
    {
        return $this->vendaFixa;
    }

    /**
     * @param bool $vendaFixa
     */
    public function setVendaFixa(bool $vendaFixa): void
    {
        $this->vendaFixa = $vendaFixa;
    }

    /**
     * @return bool
     */
    public function isVendaMovel(): bool
    {
        return $this->vendaMovel;
    }

    /**
     * @param bool $vendaMovel
     */
    public function setVendaMovel(bool $vendaMovel): void
    {
        $this->vendaMovel = $vendaMovel;
    }

    /**
     * @return bool
     */
    public function isClienteCadastroWebVendas(): bool
    {
        return $this->clienteCadastroWebVendas;
    }

    /**
     * @param bool $clienteCadastroWebVendas
     */
    public function setClienteCadastroWebVendas(bool $clienteCadastroWebVendas): void
    {
        $this->clienteCadastroWebVendas = $clienteCadastroWebVendas;
    }

    /**
     * @return mixed
     */
    public function getClienteCPF()
    {
        return $this->clienteCPF;
    }

    /**
     * @param mixed $clienteCPF
     */
    public function setClienteCPF($clienteCPF): void
    {
        $this->clienteCPF = $clienteCPF;
    }

    /**
     * @return mixed
     */
    public function getClienteNome()
    {
        return $this->clienteNome;
    }

    /**
     * @param mixed $clienteNome
     */
    public function setClienteNome($clienteNome): void
    {
        $this->clienteNome = $clienteNome;
    }

    /**
     * @return string
     */
    public function getClienteDataNascimento(): string
    {
        return $this->clienteDataNascimento;
    }

    /**
     * @param string $clienteDataNascimento
     */
    public function setClienteDataNascimento(string $clienteDataNascimento): void
    {
        $this->clienteDataNascimento = $clienteDataNascimento;
    }

    /**
     * @return string
     */
    public function getClienteNomeMae(): string
    {
        return $this->clienteNomeMae;
    }

    /**
     * @param string $clienteNomeMae
     */
    public function setClienteNomeMae(string $clienteNomeMae): void
    {
        $this->clienteNomeMae = $clienteNomeMae;
    }

    /**
     * @return string
     */
    public function getClienteSexo(): string
    {
        return $this->clienteSexo;
    }

    /**
     * @param string $clienteSexo
     */
    public function setClienteSexo(string $clienteSexo): void
    {
        $this->clienteSexo = $clienteSexo;
    }

    /**
     * @return string
     */
    public function getClienteEmail(): string
    {
        return $this->clienteEmail;
    }

    /**
     * @param string $clienteEmail
     */
    public function setClienteEmail(string $clienteEmail): void
    {
        $this->clienteEmail = $clienteEmail;
    }

    /**
     * @return string
     */
    public function getClienteTelefoneCelular(): string
    {
        return $this->clienteTelefoneCelular;
    }

    /**
     * @param string $clienteTelefoneCelular
     */
    public function setClienteTelefoneCelular(string $clienteTelefoneCelular): void
    {
        $this->clienteTelefoneCelular = $clienteTelefoneCelular;
    }

    /**
     * @return string
     */
    public function getClienteTelefoneFixo(): string
    {
        return $this->clienteTelefoneFixo;
    }

    /**
     * @param string $clienteTelefoneFixo
     */
    public function setClienteTelefoneFixo(string $clienteTelefoneFixo): void
    {
        $this->clienteTelefoneFixo = $clienteTelefoneFixo;
    }

    /**
     * @return mixed
     */
    public function getClienteReceberSMS()
    {
        return $this->clienteReceberSMS;
    }

    /**
     * @param mixed $clienteReceberSMS
     */
    public function setClienteReceberSMS($clienteReceberSMS): void
    {
        $this->clienteReceberSMS = $clienteReceberSMS;
    }

    /**
     * @return mixed
     */
    public function getEnderecoCEP()
    {
        return $this->enderecoCEP;
    }

    /**
     * @param mixed $enderecoCEP
     */
    public function setEnderecoCEP($enderecoCEP): void
    {
        $this->enderecoCEP = $enderecoCEP;
    }

    /**
     * @return string
     */
    public function getEnderecoNumero(): string
    {
        return $this->enderecoNumero;
    }

    /**
     * @param string $enderecoNumero
     */
    public function setEnderecoNumero(string $enderecoNumero): void
    {
        $this->enderecoNumero = $enderecoNumero;
    }

    /**
     * @return mixed
     */
    public function getEnderecoRua()
    {
        return $this->enderecoRua;
    }

    /**
     * @param mixed $enderecoRua
     */
    public function setEnderecoRua($enderecoRua): void
    {
        $this->enderecoRua = $enderecoRua;
    }

    /**
     * @return mixed
     */
    public function getTaxaInstalacao()
    {
        return $this->taxaInstalacao;
    }

    /**
     * @param mixed $taxaInstalacao
     */
    public function setTaxaInstalacao($taxaInstalacao): void
    {
        $this->taxaInstalacao = $taxaInstalacao;
    }

    /**
     * @return mixed
     */
    public function getFormaPagamentoTaxaInstalacao()
    {
        return $this->formaPagamentoTaxaInstalacao;
    }

    /**
     * @param mixed $formaPagamentoTaxaInstalacao
     */
    public function setFormaPagamentoTaxaInstalacao($formaPagamentoTaxaInstalacao): void
    {
        $this->formaPagamentoTaxaInstalacao = $formaPagamentoTaxaInstalacao;
    }

    /**
     * @return mixed
     */
    public function getFixaFormatoEnvio()
    {
        return $this->fixaFormatoEnvio;
    }

    /**
     * @param mixed $fixaFormatoEnvio
     */
    public function setFixaFormatoEnvio($fixaFormatoEnvio): void
    {
        $this->fixaFormatoEnvio = $fixaFormatoEnvio;
    }

    /**
     * @return mixed
     */
    public function getFixaDataVencimento()
    {
        return $this->fixaDataVencimento;
    }

    /**
     * @param mixed $fixaDataVencimento
     */
    public function setFixaDataVencimento($fixaDataVencimento): void
    {
        $this->fixaDataVencimento = $fixaDataVencimento;
    }

    /**
     * @return mixed
     */
    public function getFixaFormaPagamento()
    {
        return $this->fixaFormaPagamento;
    }

    /**
     * @param mixed $fixaFormaPagamento
     */
    public function setFixaFormaPagamento($fixaFormaPagamento): void
    {
        $this->fixaFormaPagamento = $fixaFormaPagamento;
    }

    /**
     * @return mixed
     */
    public function getTotalPlanoFixa()
    {
        return $this->totalPlanoFixa;
    }

    /**
     * @param mixed $totalPlanoFixa
     */
    public function setTotalPlanoFixa($totalPlanoFixa): void
    {
        $this->totalPlanoFixa = $totalPlanoFixa;
    }

    /**
     * @return mixed
     */
    public function getTotalFixaAposMeses()
    {
        return $this->totalFixaAposMeses;
    }

    /**
     * @param mixed $totalFixaAposMeses
     */
    public function setTotalFixaAposMeses($totalFixaAposMeses): void
    {
        $this->totalFixaAposMeses = $totalFixaAposMeses;
    }

    /**
     * @return mixed
     */
    public function getTotalPlanoMovel()
    {
        return $this->totalPlanoMovel;
    }

    /**
     * @param mixed $totalPlanoMovel
     */
    public function setTotalPlanoMovel($totalPlanoMovel): void
    {
        $this->totalPlanoMovel = $totalPlanoMovel;
    }
}