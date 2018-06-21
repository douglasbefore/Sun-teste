<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 26/05/18
 * Time: 10:39
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaElementsPAP{}

class TipoServicos extends VendaServicosElementsPAP
{
    const BotaoMovel = '.module-container .container .icon-card-item.movel.web';
    const BotaoFixa = '.module-container .container .icon-card-item.fixa.web';
}

class CampoVenda extends VendaElementsPAP{

    /* Geral da Venda */
    const BotaoContinuar = '.module-container .fixed-footer > button.btn';
    const BotaoVoltar = '.module-container .fixed-footer > button.btn.btn-link.secondary-actions';
    const BotaoRecolherAnalise = '.module-container .sidebar-container .sidebar > span';
    const BotaoEnviarPedido = '.module-container .fixed-footer > button.btn.btn-success.ml-auto';
    const BotaoVoltarAlertaIntervaloInicioVenda = '.swal2-container.swal2-fade.swal2-shown .swal2-buttonswrapper > button.swal2-confirm.btn.btn-primary.btn-block.swal2-styled';

    // Alertas e informativos
    const AlertaIntervaloInicioVenda = '.swal2-modal.swal2-show';
    const LoadCarregando = '.module-container .container .loading-wrapper i';
    const AlertaRequisicaoToken = '.module-container > span > div > div:nth-child(2) > span';
    const AlertaCarregandoDados = '.module-container .transition-container .loading-wrapper span';
    const AlertaCadastroCPF360  = '.module-container > span > div > div:nth-child(2) > span';
    const AlertaEnderecoCarregandoCidade = '.module-container .container .loading-wrapper span';
    const AlertaAgurdeRealizandoAnalise = '.module-container .pagina-erro .mensagem .titulo';
    const AlertaAgurdeCarregandoDados = '.module-container .container .loading-wrapper span';
    const AlertaCadastrandoCliente = ' .module-container .container .loading-wrapper span';
    const MensagemPedidoConcluidoSucesso = '.module-container .container.venda-finalizada .container.venda-finalizada .message';
    const AlertaVerificando = '.module-container .transition-container span';

    const AlertaAguardandoWebVendas = '.module-container .container .loading-wrapper span';
    const AlertaAguardeRealizandoAnalise = '.module-container .pagina-erro .mensagem .titulo';
    const AlertaBuscandoGruposOferta = '.module-container .container .loading-wrapper';


    const RadioEscolhaEndereco = '.item';
    const RadioGrupoOferta = '#gruposDeOferta > div > div';

    /* Atribua a venda a um vendedor */
    const CampoVendedorEstado       = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(1) > div > div > select';
    const CampoVendedorPontoVenda   = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(2) > div > div > div.field-group > input';
    const CampoVendedorVendedor     = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(3) > div > div > div.field-group > input';

    /* Campos Nova Venda */
    const CampoVendaCPFCliente = '.module-container .container .field-group > input';
    const Validar_CampoVendaCPFCliente = '.module-container .container .form-control-feedback';
    const SelectDDD = '.module-container .container > div > div > div:nth-child(2) > div > div > select';

    /* Dados do Cliente */
    const CampoClienteCPF = '#cpf > div.form-control-feedback';
    const Validar_CampoClienteCPF = '#cpf > div.form-control-feedback';
    const CampoClienteNomeCompleto = '#nome > div.field-group > input';
    const Validar_CampoClienteNomeCompleto = '#nome > div.form-control-feedback';
    const CampoClienteDataNascimento = '#dataNascimento > div.field-group > input';
    const Validar_CampoClienteDataNascimento = '#dataNascimento > div.form-control-feedback';
    const CampoClienteNomeMae = '#nomeMae > div.field-group > input';
    const Validar_CampoClienteNomeMae = '#nomeMae > div.form-control-feedback';
    const BotaoClienteSexoMasculino = '#sexo > div > div:nth-child(1)';
    const BotaoClienteSexoFeminino = '#sexo > div > div:nth-child(2)';
    const Validar_BotaoClienteSexo = '#sexo > div.form-control-feedback';
    const CampoClienteEmail = '#email > div.field-group > input';
    const Validar_CampoClienteEmail = '#email > div.form-control-feedback';
    const CampoClienteTelefoneCelular = '#celular > div.field-group > input';
    const Validar_CampoClienteTelefoneCelular = '#celular > div.form-control-feedback';
    const CampoClienteTelefoneFixo = '#fixo > div.field-group > input';
    const Validar_CampoClienteTelefoneFixo = '#fixo > div.form-control-feedback';
    const CampoClienteOutroContato = '#celular > div.field-group > input';
    const BotaoAnexarDocumento = '.module-container .panel .col-12.mt-3 > button';

    /* Endereco do cliente */
    const CampoEnderecoCep = '#cep > div.field-group > input';
    const Validar_CampoEnderecoCep = '#cep > div.form-control-feedback';
    const CampoEnderecoNumero = '#numero > div.field-group > input';
    const Validar_CampoEnderecoNumero = '#numero > div.form-control-feedback';
    const CampoEnderecoRua = '#rua > div.field-group > input';
    const CampoEnderecoBairro = '#bairro > div.field-group > input';
    const SelectEnderecoUF = '#estado > div > select';
    const SelectEnderecoCidade = '#cidade > div > select';
    const SelectEnderecoTipoComplemento = '.module-container .container > div > div > div:nth-child(7) > div > div:nth-child(1) > div > select';
    const CampoEnderecoComplemento = '.module-container .container > div > div > div:nth-child(7) > div > div.form-group.input-field.col-6 > div.field-group > input';
    const Validar_CampoEnderecoComplemento = '.module-container .container > div > div > div:nth-child(7) > div > div.form-group.input-field.has-danger.col-6 > div.form-control-feedback';
}

class ResumoVenda extends VendaElementsPAP{


}