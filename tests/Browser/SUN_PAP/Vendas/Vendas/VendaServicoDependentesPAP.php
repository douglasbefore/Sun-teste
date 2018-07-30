<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 24/07/18
 * Time: 15:11
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;


class VendaServicoDependentesPAP
{
    private $dependenteid;
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
        $this->dependenteNumero = $dependenteNumero;
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