<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

use App\consultaCliente;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VendaServicoMaisDeUmServicoPAPTest extends DuskTestCase
{
    /**
     * Verifica todos os campos obrigatorios do serviço telefonia Fixa.
     * @throws \Exception
     * @throws \Throwable
     * @Test ServicoFixaTelefoniaFixa
     * @group ServicoFixaTelefoniaFixa
     * @return void
     */
    public function testServicoControleFatura_TelefoniaFixa_BandaLarga()
    {
        $this->browse(function (Browser $browser) {
            $dadosVenda = new VendaPAPTest();
            $dadosVenda->getVenda()->setClienteCPF(consultaCliente::buscaClienteFixa());

            $dadosVenda->testEsolherVendaMovelFixa();
            $dadosVenda->dadosCliente();

            $servicoControleFatura = new VendaServicoMovelControleFaturaPAPTest();
            $servicoControleFatura->ServicoMovelControleFaturaClienteAltaPortabilidadeOutros($browser, $dadosVenda);

            $servicoTelefoniaFixa = new VendaServicoFixaTelefoniaFixaPAPTest();
            $servicoTelefoniaFixa->ServicoFixaTelefoniaFixa($browser, $dadosVenda);

            $servicoBandaLarga = new VendaServicoFixaBandaLargaPAPTest();
            $servicoBandaLarga->ServicoFixaBandaLarga($browser, $dadosVenda);

            $dadosVenda->trataRodapeValoresVenda();
            $dadosVenda->faturaFixa();
            $dadosVenda->validarResumoVenda();
        });
    }

//    public function testVariasVezesBandaLarga()
//    {
//        for($i=0; $i<5; $i++){
//            $this->testServicoControleFatura_TelefoniaFixa_BandaLarga();
//        }
//    }

}
