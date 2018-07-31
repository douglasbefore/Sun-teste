<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 24/07/18
 * Time: 15:11
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;


use Tests\Feature\Funcoes\funcoesPHP;

class VendaServicoDependentesPAP
{
    private $dependenteid;
    private $dependenteDDD;
    private $dependentePlano;
    private $dependenteNumero;
    private $dependenteIccid;
    private $dependentePortabilidade;
    private $dependenteNumeroAtual;
    private $dependenteOperadora;
    private $dependenteOutraOperadora;

    /**
     * @return mixed
     */
    public function getDependenteid()
    {
        return $this->dependenteid;
    }

    /**
     * @param mixed $dependenteid
     */
    public function setDependenteid($dependenteid): void
    {
        $this->dependenteid = $dependenteid;
    }

    /**
     * @return mixed
     */
    public function getDependenteDDD()
    {
        return $this->dependenteDDD;
    }

    /**
     * @param mixed $dependenteDDD
     */
    public function setDependenteDDD($dependenteDDD): void
    {
        $this->dependenteDDD = $dependenteDDD;
    }

    /**
     * @return mixed
     */
    public function getDependentePlano()
    {
        return $this->dependentePlano;
    }

    /**
     * @param mixed $dependentePlano
     */
    public function setDependentePlano($dependentePlano): void
    {
        $this->dependentePlano = $dependentePlano;
    }

    /**
     * @return mixed
     */
    public function getDependenteNumero()
    {
        return $this->dependenteNumero;
    }

    /**
     * @param mixed $dependenteNumero
     */
    public function setDependenteNumero($dependenteNumero): void
    {
        $dependenteNumero = preg_replace("/[^0-9]/", "", $dependenteNumero);
        $dependenteNumero = $this->dependenteDDD . $dependenteNumero;

        // Tratativa de campo telefone para os serviço pelo motivo que no serviço da Fixa são 8 digitos e no movel são 9.
        // Precisa do tratamento para que seja validado no resumo da venda com mais de um servico.
        if(strlen($dependenteNumero) == 10 ) {
            $this->dependenteNumero = FuncoesPHP::mascara($dependenteNumero, '(##) ####-####');
        } elseif (strlen($dependenteNumero) == 11 ){
            $this->dependenteNumero = FuncoesPHP::mascara($dependenteNumero, '(##) #####-####');
        } else{
            $this->dependenteNumero = $dependenteNumero;
        }
    }

    /**
     * @return mixed
     */
    public function getDependenteIccid()
    {
        return $this->dependenteIccid;
    }

    /**
     * @param mixed $dependenteIccid
     */
    public function setDependenteIccid($dependenteIccid): void
    {
        $this->dependenteIccid = $dependenteIccid;
    }

    /**
     * @return mixed
     */
    public function getDependentePortabilidade()
    {
        return $this->dependentePortabilidade;
    }

    /**
     * @param mixed $dependentePortabilidade
     */
    public function setDependentePortabilidade($dependentePortabilidade): void
    {
        $this->dependentePortabilidade = $dependentePortabilidade;
    }

    /**
     * @return mixed
     */
    public function getDependenteNumeroAtual()
    {
        return $this->dependenteNumeroAtual;
    }

    /**
     * @param mixed $dependenteNumeroAtual
     */
    public function setDependenteNumeroAtual($dependenteNumeroAtual): void
    {
        $this->dependenteNumeroAtual = $dependenteNumeroAtual;
        $dependenteNumeroAtual = preg_replace("/[^0-9]/", "", $dependenteNumeroAtual);
        $dependenteNumeroAtual = $this->dependenteDDD . $dependenteNumeroAtual;

        // Tratativa de campo telefone para os serviço pelo motivo que no serviço da Fixa são 8 digitos e no movel são 9.
        // Precisa do tratamento para que seja validado no resumo da venda com mais de um servico.
        if(strlen($dependenteNumeroAtual) == 10 ) {
            $this->dependenteNumeroAtual = FuncoesPHP::mascara($dependenteNumeroAtual, '(##) ####-####');
        } elseif (strlen($dependenteNumeroAtual) == 11 ){
            $this->dependenteNumeroAtual = FuncoesPHP::mascara($dependenteNumeroAtual, '(##) #####-####');
        } else{
            $this->dependenteNumeroAtual = $dependenteNumeroAtual;
        }
    }

    /**
     * @return mixed
     */
    public function getDependenteOperadora()
    {
        return $this->dependenteOperadora;
    }

    /**
     * @param mixed $dependenteOperadora
     */
    public function setDependenteOperadora($dependenteOperadora): void
    {
        $this->dependenteOperadora = $dependenteOperadora;
    }

    /**
     * @return mixed
     */
    public function getDependenteOutraOperadora()
    {
        return $this->dependenteOutraOperadora;
    }

    /**
     * @param mixed $dependenteOutraOperadora
     */
    public function setDependenteOutraOperadora($dependenteOutraOperadora): void
    {
        $this->dependenteOutraOperadora = $dependenteOutraOperadora;
    }
}