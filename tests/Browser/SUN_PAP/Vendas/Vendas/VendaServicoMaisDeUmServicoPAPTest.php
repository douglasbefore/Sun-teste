<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

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
            $dadosVenda->getVenda()->setClienteCPF('85788830206');
//            $dadosVenda->getVenda()->setClienteCPF('58248048187');

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
}
