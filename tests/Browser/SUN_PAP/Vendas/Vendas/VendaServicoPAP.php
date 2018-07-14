<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 28/06/18
 * Time: 14:08
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use Tests\Feature\Funcoes\funcoesPHP;

class VendaServicoPAP
{
    private $servicoVendaDDD;
    private $servicoNome;
    private $servicoElementoPlanoResumo;
    private $servicoDescricaoPlano;
    private $servicoValor;
    private $servicoTipoCliente;
    private $servicoTrocaChip;
    private $servicoPortabilidade;
    private $servicoNumeroCliente;
    private $servicoOperadora;
    private $servicoOutraOperadora;
    private $servicoICCID;
    private $servicoFatura;
    private $servicoEmail;
    private $servicoDataVencimento;
    private $servicoAdicionais = array();

    /**
     * @return mixed
     */
    public function getServicoVendaDDD()
    {
        return $this->servicoVendaDDD;
    }

    /**
     * @param mixed $servicoVendaDDD
     */
    public function setServicoVendaDDD($servicoVendaDDD): void
    {
        $this->servicoVendaDDD = $servicoVendaDDD;
    }

    /**
     * @return mixed
     */
    public function getServicoNome()
    {
        return $this->servicoNome;
    }

    /**
     * @param mixed $servicoNome
     */
    public function setServicoNome($servicoNome): void
    {
        $this->servicoNome = $servicoNome;
    }
    /**
     * @return mixed
     */
    public function getServicoElementoPlanoResumo()
    {
        return $this->servicoElementoPlanoResumo;
    }

    /**
     * @param mixed $servicoElementoPlanoResumo
     */
    public function setServicoElementoPlanoResumo($servicoElementoPlanoResumo): void
    {
        $this->servicoElementoPlanoResumo = $servicoElementoPlanoResumo;
    }

    /**
     * @return mixed
     */
    public function getServicoValor()
    {
        return $this->servicoValor;
    }

    /**
     * @return mixed
     */
    public function getServicoDescricaoPlano()
    {
        return $this->servicoDescricaoPlano;
    }

    /**
     * @param mixed $servicoDescricaoPlano
     */
    public function setServicoDescricaoPlano($servicoDescricaoPlano): void
    {
        $this->servicoDescricaoPlano = $servicoDescricaoPlano;

        // Caso tenha o valor no final do plano, seta o valor da class vendaServico.
        if(strripos($servicoDescricaoPlano, 'R$')){
            $this->setServicoValor('R$ ' . str_replace('.', ',', explode('R$', $servicoDescricaoPlano)[1]));
        }
    }

    /**
     * @param mixed $servicoValor
     */
    public function setServicoValor($servicoValor): void
    {
        $this->servicoValor = $servicoValor;
    }

    /**
     * @return mixed
     */
    public function getServicoTipoCliente()
    {
        return $this->servicoTipoCliente;
    }

    /**
     * @param mixed $servicoTipoCliente
     */
    public function setServicoTipoCliente($servicoTipoCliente): void
    {
        $this->servicoTipoCliente = $servicoTipoCliente;
    }

    /**
     * @return mixed
     */
    public function getServicoTrocaChip()
    {
        return $this->servicoTrocaChip;
    }

    /**
     * @param mixed $servicoTrocaChip
     */
    public function setServicoTrocaChip($servicoTrocaChip): void
    {
        $this->servicoTrocaChip = $servicoTrocaChip;
    }

    /**
     * @return mixed
     */
    public function getServicoPortabilidade()
    {
        return $this->servicoPortabilidade;
    }

    /**
     * @param mixed $servicoPortabilidade
     */
    public function setServicoPortabilidade($servicoPortabilidade): void
    {
        $this->servicoPortabilidade = $servicoPortabilidade;
    }

    /**
     * @return mixed
     */
    public function getServicoNumeroCliente()
    {
        return $this->servicoNumeroCliente;
    }

    /**
     * @param mixed $servicoNumeroCliente
     */
    public function setServicoNumeroCliente($servicoNumeroCliente): void
    {
        $servicoNumeroCliente = preg_replace("/[^0-9]/", "", $servicoNumeroCliente);
        $servicoNumeroCliente = $this->servicoVendaDDD . $servicoNumeroCliente;

        // Tratativa de campo telefone para os serviço pelo motivo que no serviço da Fixa são 8 digitos e no movel são 9.
        // Precisa do tratamento para que seja validado no resumo da venda com mais de um servico.
        if(strlen($servicoNumeroCliente) == 10 ) {
            $this->servicoNumeroCliente = FuncoesPHP::mascara($servicoNumeroCliente, '(##) ####-####');
        } elseif (strlen($servicoNumeroCliente) == 11 ){
            $this->servicoNumeroCliente = FuncoesPHP::mascara($servicoNumeroCliente, '(##) #####-####');
        } else{
            $this->servicoNumeroCliente = $servicoNumeroCliente;
        }
    }

    /**
     * @return mixed
     */
    public function getServicoOperadora()
    {
        return $this->servicoOperadora;
    }

    /**
     * @param mixed $servicoOperadora
     */
    public function setServicoOperadora($servicoOperadora): void
    {
        $this->servicoOperadora = $servicoOperadora;
    }

    /**
     * @return mixed
     */
    public function getServicoOutraOperadora()
    {
        return $this->servicoOutraOperadora;
    }

    /**
     * @param mixed $servicoOutraOperadora
     */
    public function setServicoOutraOperadora($servicoOutraOperadora): void
    {
        $this->servicoOutraOperadora = $servicoOutraOperadora;
    }

    /**
     * @return mixed
     */
    public function getServicoICCID()
    {
        return $this->servicoICCID;
    }

    /**
     * @param mixed $servicoICCID
     */
    public function setServicoICCID($servicoICCID): void
    {
        $this->servicoICCID = $servicoICCID;
    }

    /**
     * @return mixed
     */
    public function getServicoFatura()
    {
        return $this->servicoFatura;
    }

    /**
     * @param mixed $servicoFatura
     */
    public function setServicoFatura($servicoFatura): void
    {
        $this->servicoFatura = $servicoFatura;
    }

    /**
     * @return mixed
     */
    public function getServicoEmail()
    {
        return $this->servicoEmail;
    }

    /**
     * @param mixed $servicoEmail
     */
    public function setServicoEmail($servicoEmail): void
    {
        $this->servicoEmail = $servicoEmail;
    }

    /**
     * @return mixed
     */
    public function getServicoDataVencimento()
    {
        return $this->servicoDataVencimento;
    }

    /**
     * @param mixed $servicoDataVencimento
     */
    public function setServicoDataVencimento($servicoDataVencimento): void
    {
        $this->servicoDataVencimento = $servicoDataVencimento;
    }

    /**
     * @return array
     */
    public function getServicoAdicionais(): array
    {
        return $this->servicoAdicionais;
    }

    /**
     * @param $servicoAdicionais
     */
    public function setServicoAdicionais($servicoAdicionais): void
    {
        $this->servicoAdicionais[] = $servicoAdicionais;
    }
}