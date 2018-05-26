<?php

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaServicosElementsPAP{}


class ControleFatura extends VendaServicosElementsPAP
{
    const AlertaCarregandoPlanos = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > div.loading-wrapper > div > span';
    const BotaoRemoverServico = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.remove > span';
    const SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > [id^="plano_"] > div > select';
    const Validar_SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback';
    const RadioTipoClienteAlta = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback';
    const RadioPortabilidadeSim = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div > div:nth-child(1) > span';
    const RadioPortabilidadeNao = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div > div:nth-child(2) > span';
//    const Validar_RadioPortabilidade = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback';
    const CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input';
    const Validar_CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback';
    const CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input';
    const Validar_CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback';
    const SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select';
    const Validar_SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback';
    const SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input';
    const Validar_SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback';
    const RadioFaturaEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback';
    const CampoEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input';
    const Validar_CampoServicoControleEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback';
    const RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback';
}

class FixoFWT extends VendaServicosElementsPAP {
    const AlertaCarregandoPlanos = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > div.loading-wrapper > div > span';
    const BotaoRemoverServico = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.remove > span';
    const SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > [id^="plano_"] > div > select';
    const Validar_SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback';
    const RadioPortabilidadeSim = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
//    const Validar_RadioPortabilidade = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback';
    const CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input';
    const Validar_CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback';
    const SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select';
    const Validar_SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback';
    const SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input';
    const Validar_SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback';
    const CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input';
    const Validar_CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback';
    const RadioFaturaEmail = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback';
    const CampoEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input';
    const Validar_CampoEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback';
    const RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.fixoFWT > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback';
}

class ControleCartao extends VendaServicosElementsPAP{
    const AlertaCarregandoPlanos = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > div.loading-wrapper > div > span';
    const BotaoRemoverServico = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.remove > span';
    const SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > [id^="plano_"] > div > select';
    const Validar_SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback';
    const BotaoTipoClienteAlta = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)';
    const BotaoTipoClienteMigracao = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)';
    const BotaoTipoClienteUpgrade = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_BotaoTipoCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback';
    const CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input';
    const Validar_CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback';
    const CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input';
    const Validar_CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controleCartao > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback';
}

class ControlePassDigital  extends VendaServicosElementsPAP{
    const AlertaCarregandoPlanos = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > div.loading-wrapper > div > span';
    const BotaoRemoverServico = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.remove > span';
    const SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > [id^="plano_"] > div > select';
    const Validar_SelectPlano = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > div > [id^="plano_"] > div.form-control-feedback';
    const RadioTipoClienteAlta = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoCliente_"] > div.form-control-feedback';
    const RadioPortabilidadeSim = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
//    const Validar_RadioPortabilidade = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="portabilidade_"] > div.form-control-feedback';
    const CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.field-group > input';
    const Validar_CampoNumeroCliente = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="numeroCliente_"] > div.form-control-feedback';
    const SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="operadora_"] > div.field-group > select';
    const Validar_SelectOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="operadora_"] > div.form-control-feedback';
    const SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.field-group > input';
    const Validar_SelectOutraOperadora = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="outraOperadora_"] > div.form-control-feedback';
    const CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="iccid_"] > div.field-group > input';
    const Validar_CampoICCID = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="iccid_"] > div.form-control-feedback';
    const RadioFaturaEmail = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="tipoFatura_"] > div.form-control-feedback';
    const CampoEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.field-group > input';
    const Validar_CampoEmail = '.lista-servico-selecionados > span > div.icon-card-form.controleFatura > div.form-wrapper > div > div > [id^="email_"] > div.form-control-feedback';
    const RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.lista-servico-selecionados > span > div.icon-card-form.controlePassDigital > div.form-wrapper > div > div > [id^="dataVencimento_"] > div.form-control-feedback';
}