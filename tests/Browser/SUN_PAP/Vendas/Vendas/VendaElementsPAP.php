<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 26/05/18
 * Time: 10:39
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaElementsPAP{}

class CampoVenda extends VendaElementsPAP{

    /* Geral da Venda */
    const BotaoContinuar = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn';
    const BotaoVoltar = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn.btn-link.secondary-actions';
    const BotaoRecolherAnalise = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.sidebar-container > div.sidebar > span';
    const BotaoEnviarPedido = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.fixed-footer > button.btn.btn-success.ml-auto';

    // Alertas e informativos
    const AlertaRequisicaoToken = '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span';
    const AlertaCarregandoDados = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.transition-container > div.loading-wrapper > div > span';
    const AlertaCadastroCPF360 = '> div:nth-child(6) > div.module-container > span > div > div:nth-child(2) > span';
    const AlertaEnderecoCarregandoCidade = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(6) > div > div.loading-wrapper > div > span';
    const AlertaAgurdeRealizandoAnalise = '> div:nth-child(6) > div.module-container > div.pagina-erro > div.mensagem > div.titulo';
    const AlertaAgurdeCarregandoDados = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div.loading-wrapper > div > span';
    const MensagemPedidoConcluidoSucesso = '> div:nth-child(6) > div.module-container > div.container.venda-finalizada > div.container.venda-finalizada > div > div.message';

    /* Atribua a venda a um vendedor */
    const CampoVendedorEstado = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(1) > div > div > select';
    const CampoVendedorPontoVenda = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(2) > div > div > div.field-group > input';
    const CampoVendedorVendedor = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div > div.col-12.col-sm-8.col-lg-6.col-xl-4 > div:nth-child(3) > div > div > div.field-group > input';

    /* Campos Nova Venda */
    const CampoVendaCPFCliente = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.field-group > input';
    const Validar_CampoVendaCPFCliente = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(1) > div > div.form-control-feedback';
    const SelectDDD = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(2) > div > div > select';
    const BotaoServicoMovel = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.movel.web';
    const BotaoServicoFixa = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(3) > div > div.icon-card-item.fixa.web > div';

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
    const BotaoAnexarDocumento = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div:nth-child(1) > div > div.panel > div > div.col-12.mt-3 > button';

    /* Endereco do cliente */
    const CampoEnderecoCep = '#cep > div.field-group > input';
    const Validar_CampoEnderecoCep = '#cep > div.form-control-feedback';
    const CampoEnderecoNumero = '#numero > div.field-group > input';
    const Validar_CampoEnderecoNumero = '#numero > div.form-control-feedback';
    const CampoEnderecoRua = '#rua > div.field-group > input';
    const CampoEnderecoBairro = '#bairro > div.field-group > input';
    const SelectEnderecoUF = '#estado > div > select';
    const SelectEnderecoCidade = '#cidade > div > select';
    const SelectEnderecoTipoComplemento = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div:nth-child(1) > div > select';
    const CampoEnderecoComplemento = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div.form-group.input-field.col-6 > div.field-group > input';
    const Validar_CampoEnderecoComplemento = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div > div:nth-child(7) > div > div.form-group.input-field.has-danger.col-6 > div.form-control-feedback';

    /* incluir serviço */
    const BotaoServicoIncluirServico = '> div:nth-child(6) > div.module-container > div:nth-child(3) > div.container > div > div:nth-child(1) > div:nth-child(1) > button';
    const BotaoServicoMovelMovelControleFatura = '.icon-card.controleFatura';
    const BotaoServicoMovelMovelControleFaturaDesabilitado = '.icon-card.disabled.controleFatura';
    const BotaoServicoMovelFixoFWT = '.icon-card.fixoFWT';
    const BotaoServicoMovelFixoFWTDesabilitado = '.icon-card.disabled.fixoFWT';
    const BotaoServicoMovelControleCartao = '.icon-card.controleCartao';
    const BotaoServicoMovelControleCartaoDesabilitado = '.icon-card.disabled.controleCartao';
    const BotaoServicoMovelControlePassDigital = '.icon-card.controlePassDigital';
    const BotaoServicoMovelControlePassDigitalDesabilitado = '.icon-card.disabled.controlePassDigital';

}