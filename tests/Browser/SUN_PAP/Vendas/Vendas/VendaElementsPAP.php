<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 26/05/18
 * Time: 10:39
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaElementsPAP{}

class TipoServicos extends VendaElementsPAP
{
    const BotaoMovel = '.module-container .container .icon-card-item.movel.web';
    const BotaoFixa = '.module-container .container .icon-card-item.fixa.web';
}

class CampoVenda extends VendaElementsPAP
{
    /* Geral da Venda */
    const BotaoContinuar = '.module-container .fixed-footer > button.btn';
    const BotaoVoltar = '.module-container .fixed-footer > button.btn.btn-link.secondary-actions';
    const BotaoEnviarPedido = '.module-container .fixed-footer > button.btn.btn-success.ml-auto';
    const BotaoVoltarAlertaIntervaloInicioVenda = '.swal2-container.swal2-fade.swal2-shown .swal2-buttonswrapper > button.swal2-confirm.btn.btn-primary.btn-block.swal2-styled';

    // Alertas e informativos
    const AlertaIntervaloInicioVenda = '.swal2-modal.swal2-show';
    const LoadCarregando = '.module-container .container .loading-wrapper i';
    const AlertaRequisicaoToken = '.module-container > span > div > div:nth-child(2) > span';
    const AlertaCarregandoDados = '.module-container .transition-container .loading-wrapper span';
    const AlertaCadastroCPF360 = '.module-container > span > div > div:nth-child(2) > span';
    const AlertaEnderecoCarregandoCidade = '.module-container .container .loading-wrapper span';
    const AlertaAgurdeRealizandoAnalise = '.module-container .pagina-erro .mensagem .titulo';
    const AlertaAgurdeCarregandoDados = '.module-container .container .loading-wrapper span';
    const AlertaCadastrandoCliente = '.module-container .container .loading-wrapper span';
    const AlertaCadastrandoEndereco = '.module-container .container .loading-wrapper span';
    const MensagemPedidoConcluidoSucesso = '.module-container .container.venda-finalizada .container.venda-finalizada .message';
    const AlertaVerificando = '.module-container .transition-container span';
    const AlertaFacilidadeIndisponivel = '.module-container .pagina-erro .mensagem .titulo';
    const AlertaAguardandoWebVendas = '.module-container .container .loading-wrapper span';
    const AlertaAguardeRealizandoAnalise = '.module-container .pagina-erro .mensagem .titulo';
    const AlertaBuscandoGruposOferta = '.module-container .container .loading-wrapper';

    const RadioEscolhaEndereco = '.item';
    const BotaoCadastrarOutroEndereco = '.module-container .container button';
    const RadioGrupoOferta = '#gruposDeOferta > div > div';

    /* Atribua a venda a um vendedor */
    const CampoVendedorEstado = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(1) > div > div > select';
    const CampoVendedorPontoVenda = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(2) > div > div > div.field-group > input';
    const CampoVendedorVendedor = '.module-container .container .col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(3) > div > div > div.field-group > input';

    /* Campos Nova Venda */
    const CampoVendaCPFCliente = '.module-container .container .field-group > input';
    const Validar_CampoVendaCPFCliente = '.module-container .container .form-control-feedback';
    const SelectDDD = '.module-container .container .form-control.custom-select';

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
    const BotaoClienteSexoMasculinoActive = '#sexo > div > div:nth-child(1).radio-options.active';
    const BotaoClienteSexoFeminino = '#sexo > div > div:nth-child(2)';
    const BotaoClienteSexoFemininoActive = '#sexo > div > div:nth-child(2).radio-options.active';
    const Validar_BotaoClienteSexo = '#sexo > div.form-control-feedback';
    const CampoClienteEmail = '#email > div.field-group > input';
    const Validar_CampoClienteEmail = '#email > div.form-control-feedback';
    const CampoClienteTelefoneCelular = '#celular > div.field-group > input';
    const Validar_CampoClienteTelefoneCelular = '#celular > div.form-control-feedback';
    const CampoClienteTelefoneFixo = '#fixo > div.field-group > input';
    const Validar_CampoClienteTelefoneFixo = '#fixo > div.form-control-feedback';
    const CampoClienteOutroContato = '#celular > div.field-group > input';
    const BotaoAnexarDocumento = '.module-container .panel .col-12.mt-3 > button';
    const CheckboxReceberSMS = '.module-container .core-checkbox .checkbox-icon';

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

    const BotaoRecolherAnalise = '.module-container .sidebar-container .sidebar > span';

}

class FaturaFixa extends VendaElementsPAP{
    const RadioFormatoEnvioEmail = '.module-container .container > div > div > div:nth-child(1) > div > div > div:nth-child(1)';
    const Validar_RadioFormatoEnvioEmail = '.module-container .container > div > div > div:nth-child(1) .form-control-feedback';
    const RadioFormatoEnvioPapel = '.module-container .container > div > div > div:nth-child(1) > div > div > div:nth-child(2)';
    const CampoEmail = '#email input';
    const Validar_CampoEmail = '#email .form-control-feedback';
    const RadioDataVencimento = '.module-container .container > div > div > div:nth-child(2) .radio-options';
    const RadioFormaPagamentoBoleto = '.module-container .container > div > div > div:nth-child(3) > div > div > div:nth-child(1)';
    const RadioFormaPagamentoDebitoAuto = '.module-container .container > div > div > div:nth-child(3) > div > div > div:nth-child(2)';
    const Validar_RadioFormaPagamentoDebitoAuto = '.module-container .container > div > div > div:nth-child(3) .form-control-feedback';
    const SelectFaturaBanco = '.module-container .container > div > div > div:nth-child(4) .field-group > select';
    const Validar_SelectFaturaBanco = '.module-container .container > div > div > div:nth-child(4) .form-control-feedback';
    const CampoFaturaAgencia = '.module-container .container > div > div > div:nth-child(5) .field-group > input';
    const Validar_CampoFaturaAgencia = '.module-container .container > div > div > div:nth-child(5) .form-control-feedback';
    const CampoFaturaConta = '.module-container .container > div > div > div:nth-child(6) .field-group > input';
    const Validar_CampoFaturaConta = '.module-container .container > div > div > div:nth-child(6) .form-control-feedback';

}

class ReservaVenda extends VendaElementsPAP
{
    const TituloReservaVenda = '.module-container .pagina-reserva > div:nth-child(1) > div.mensagem > div.titulo';
    const BotaoContinuarSemReserva = '.module-container .pagina-reserva button.btn.btn-primary.primary-actions';
}

class RodapeVenda extends VendaElementsPAP{
    const LabelTaxaInstalacaoFixa = '.module-container .total-container [data-test="Taxa de Instalação Fixa"] .label';
    const ValueTaxaInstalacaoFixa = '.module-container .total-container [data-test="Taxa de Instalação Fixa"] .value';
    const RadioFormaPagamentoAVista = '#formaPagamento .radio-group.block > div:nth-child(1)';
    const RadioFormaPagamento10Vezes = '#formaPagamento .radio-group.block > div:nth-child(2)';
    const Validar_RadioFormaPagamento = '#formaPagamento .form-control-feedback';
    const LabelTotalPlanoFixa = '.module-container .total-container [data-test="Total Plano Fixa"] .label';
    const ValueTotalPlanoFixa = '.module-container .total-container [data-test="Total Plano Fixa"] .value';
    const LabelFixaAposMeses = '.module-container .total-container [data-test="Fixa após 12 meses"] .label';
    const ValueFixaAposMeses = '.module-container .total-container [data-test="Fixa após 12 meses"] .value';
    const LabelTotalPlanoMovel = '.module-container .total-container [data-test="Plano Móvel"] .label';
    const ValueTotalPlanoMovel = '.module-container .total-container [data-test="Plano Móvel"] .value';

}

class ResumoVenda extends VendaElementsPAP{
    const PanelServicoTopo = '.text-wrapper';
    const LabelPanelServicoServicosAdicionais = '.summary-field-list label';
    const PanelServicoServicosAdicionais = '.summary-field-list ul';

    const LabelPanelServicoValor = '[data-test="Valor"] .label';
    const ValuePanelServicoValor = '[data-test="Valor"] .value';
    const LabelPanelServicoTipoCliente = '[data-test="Tipo de Cliente"] .label';
    const ValuePanelServicoTipoCliente = '[data-test="Tipo de Cliente"] .value';
    const LabelPanelServicoTrocaChip = '[data-test="Troca Chip"] .label';
    const ValuePanelServicoTrocaChip = '[data-test="Troca Chip"] .value';
    const LabelPanelServicoPortabilidade = '[data-test="Portabilidade"] .label';
    const ValuePanelServicoPortabilidade = '[data-test="Portabilidade"] .value';
    const LabelPanelServicoOperadora = '[data-test="Operadora"] .label';
    const ValuePanelServicoOperadora = '[data-test="Operadora"] .value';
    const LabelPanelServicoNumeroCliente = '[data-test="Número Cliente"] .label';
    const ValuePanelServicoNumeroCliente = '[data-test="Número Cliente"] .value';
    const LabelPanelServicoOutraOperadora = '[data-test="Outra Operadora"] .label';
    const ValuePanelServicoOutraOperadora = '[data-test="Outra Operadora"] .value';
    const LabelPanelServicoICCID = '[data-test="ICCID"] .label';
    const ValuePanelServicoICCID = '[data-test="ICCID"] .value';
    const LabelPanelServicoFatura = '[data-test="Fatura"] .label';
    const ValuePanelServicoFatura = '[data-test="Fatura"] .value';
    const LabelPanelServicoDataVencimento = '[data-test="Data Vencimento"] .label';
    const ValuePanelServicoDataVencimento = '[data-test="Data Vencimento"] .value';
    const LabelPanelServicoEmail = '[data-test="Email"] .label';
    const ValuePanelServicoEmail = '[data-test="Email"] .value';

    const ValueClienteCPF = '.info-section [data-test="CPF"] .value';
    const ValueClienteNome = '.info-section [data-test="Nome"] .value';
    const ValueClienteNomeMae = '.info-section [data-test="Nome da mãe"] .value';
    const ValueClienteSexo = '.info-section [data-test="Sexo"] .value';
    const ValueClienteDataNascimento = '.info-section [data-test="Data Nascimento"] .value';
    const ValueClienteTelefoneCelular = '.info-section [data-test="Telefone Celular"] .value';
    const ValueClienteTelefoneFixo = '.info-section [data-test="Telefone Fixo"] .value';
    const ValueClienteEmail = '.info-section [data-test="Email"] .value';
    const ValueClienteReceberSMS = '.info-section [data-test="Receber SMS"] .value';

    const ValueEnderecoClienteRua = '.info-section [data-test="Rua"] .value';
    const ValueEnderecoClienteNumero = '.info-section [data-test="Número"] .value';
    const ValueEnderecoClienteCEP = '.info-section [data-test="CEP"] .value';
    const ValueEnderecoClienteCidade = '.info-section [data-test="Cidade"] .value';
    const ValueEnderecoClienteEstado = '.info-section [data-test="Estado (UF)"] .value';
    const ValueEnderecoClienteBairro = '.info-section [data-test="Bairro"] .value';

    const ValueFaturaClienteDataVencimento = '.resumo-fatura [data-test="Data Vencimento"] .value';
    const ValueFaturaClienteFormatoEnvio = '.resumo-fatura [data-test="Formato de Envio"] .value';
    const ValueFaturaClienteFormatoPagamento = '.resumo-fatura [data-test="Formato de Pagamento"] .value';

    const ValueTotalFixa = '.resumo-total [data-test="Total Fixa"] .value';
    const ValueTotalTaxaInstalacao = '.resumo-total [data-test="Taxa de Instalação"] .value';
    const ValueTotalMovel = '.resumo-total [data-test="Total Móvel"] .value';

    const ValueDependentesPortabilidade = '[data-test="Portabilidade"]';
    const ValueDependentesNumeroPortabilidade = '[data-test="Número Portabilidade"]';
    const ValueDependentesOperadora = '[data-test="Operadora"]';
    const ValueDependentesOutraOperadora = '[data-test="Outra Operadora"]';
    const ValueDependentesICCID = '[data-test="ICCID"]';
    const ValueDependentesNumeroLinha = '[data-test="Número Linha"]';

}