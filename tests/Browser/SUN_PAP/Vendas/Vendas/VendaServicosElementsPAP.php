<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaServicosElementsPAP{}

class IncluirServicos extends VendaServicosElementsPAP
{
    const BotaoIncluirServico = '.module-container .container .btn-incluir-servico';
    const BotaoMovelControleFatura = '.icon-card.controleFatura';
    const BotaoMovelControleFaturaDesabilitado = '.icon-card.disabled.controleFatura';
    const BotaoMovelFixoFWT = '.icon-card.fixoFWT';
    const BotaoMovelFixoFWTDesabilitado = '.icon-card.disabled.fixoFWT';
    const BotaoMovelControleCartao = '.icon-card.controleCartao';
    const BotaoMovelControleCartaoDesabilitado = '.icon-card.disabled.controleCartao';
    const BotaoMovelControlePassDigital = '.icon-card.controlePassDigital';
    const BotaoMovelControlePassDigitalDesabilitado = '.icon-card.disabled.controlePassDigital';
    const BotaoFixaTelefoniaFixa = '.icon-card.telefoniaFixa';
    const BotaoFixaBandaLarga = 'icon-card.bandaLarga';
    const BotaoFixaTVPorAssinatura = 'icon-card.tvPorAssinatura';

}

class ControleFatura extends VendaServicosElementsPAP
{
    const NomeDoServico = 'Controle Fatura';
    const SeletorNomeServico = '.controleFatura .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.controleFatura div.loading-wrapper > div > span';
    const BotaoRemoverServico = '.controleFatura > div.remove > span';
    const SelectPlano = '.controleFatura [id^="plano_"] select';
    const OptionPlano = '.controleFatura [id^="plano_"] option';
    const Validar_SelectPlano = '.controleFatura [id^="plano_"] div.form-control-feedback';
    const RadioTipoClienteAlta = '.controleFatura [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.controleFatura [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.controleFatura [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.controleFatura [id^="tipoCliente_"] .form-control-feedback';
    const RadioPortabilidadeSim = '.controleFatura [id^="portabilidade_"] > div > div:nth-child(1) > span';
    const RadioPortabilidadeNao = '.controleFatura [id^="portabilidade_"] > div > div:nth-child(2) > span';
//    const Validar_RadioPortabilidade = '.controleFatura [id^="portabilidade_"] .form-control-feedback';
    const CampoICCID = '.controleFatura [id^="iccid_"] input';
    const Validar_CampoICCID = '.controleFatura [id^="iccid_"] .form-control-feedback';
    const CampoNumeroCliente = '.controleFatura [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.controleFatura [id^="numeroCliente_"] .form-control-feedback';
    const SelectOperadora = '.controleFatura [id^="operadora_"] select';
    const OptionOperadora = '.controleFatura [id^="operadora_"] option';
    const Validar_SelectOperadora = '.controleFatura [id^="operadora_"] .form-control-feedback';
    const CampoOutraOperadora = '.controleFatura [id^="outraOperadora_"] input';
    const Validar_CampoOutraOperadora = '.controleFatura [id^="outraOperadora_"] .form-control-feedback';
    const RadioFaturaEmail = '.controleFatura [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.controleFatura [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.controleFatura [id^="tipoFatura_"] .form-control-feedback';
    const CampoEmail = '.controleFatura [id^="email_"] input';
    const Validar_CampoEmail = '.controleFatura [id^="email_"] .form-control-feedback';
    const RadioDataVencimento = '.controleFatura [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.controleFatura [id^="dataVencimento_"] .form-control-feedback';
}

class FixoFWT extends VendaServicosElementsPAP
{
    const NomeDoServico = 'Fixo FWT';
    const SeletorNomeServico = '.fixoFWT .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.fixoFWT .loading-wrapper > div > span';
    const BotaoRemoverServico = '.fixoFWT > div.remove > span';
    const SelectPlano = '.fixoFWT [id^="plano_"] select';
    const OptionPlano = '.fixoFWT [id^="plano_"] option';
    const Validar_SelectPlano = '.fixoFWT [id^="plano_"] .form-control-feedback';
    const RadioPortabilidadeSim = '.fixoFWT [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.fixoFWT [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioPortabilidade = '.fixoFWT [id^="portabilidade_"] .form-control-feedback';
    const CampoNumeroCliente = '.fixoFWT [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.fixoFWT [id^="numeroCliente_"] .form-control-feedback';
    const SelectOperadora = '.fixoFWT [id^="operadora_"] select';
    const Validar_SelectOperadora = '.fixoFWT [id^="operadora_"] .form-control-feedback';
    const SelectOutraOperadora = '.fixoFWT [id^="outraOperadora_"] input';
    const Validar_SelectOutraOperadora = '.fixoFWT [id^="outraOperadora_"] .form-control-feedback';
    const CampoICCID = '.fixoFWT [id^="iccid_"] input';
    const Validar_CampoICCID = '.fixoFWT [id^="iccid_"] .form-control-feedback';
    const RadioFaturaEmail = '.fixoFWT [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.fixoFWT [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.fixoFWT [id^="tipoFatura_"] .form-control-feedback';
    const CampoEmail = '.fixoFWT [id^="email_"] input';
    const Validar_CampoEmail = '.fixoFWT [id^="email_"] .form-control-feedback';
    const RadioDataVencimento = '.fixoFWT [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.fixoFWT [id^="dataVencimento_"] .form-control-feedback';
}

class ControleCartao extends VendaServicosElementsPAP
{
    const NomeDoServico = 'Controle Cartão';
    const SeletorNomeServico = '.controleCartao .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.controleCartao .loading-wrapper > div > span';
    const BotaoRemoverServico = '.controleCartao > div.remove > span';
    const SelectPlano = '.controleCartao [id^="plano_"] select';
    const OptionPlano = '.controleCartao [id^="plano_"] option';
    const Validar_SelectPlano = '.controleCartao [id^="plano_"] .form-control-feedback';
    const RadioTipoClienteAlta = '.controleCartao [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.controleCartao [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.controleCartao [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.controleCartao [id^="tipoCliente_"] .form-control-feedback';
    const CampoNumeroCliente = '.controleCartao [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.controleCartao [id^="numeroCliente_"] .form-control-feedback';
    const CampoICCID = '.controleCartao [id^="iccid_"] input';
    const Validar_CampoICCID = '.controleCartao [id^="iccid_"] .form-control-feedback';
}

class ControlePassDigital extends VendaServicosElementsPAP
{
    const NomeDoServico = 'Controle Pass Digital';
    const SeletorNomeServico = '.controlePassDigital .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.controlePassDigital .loading-wrapper > div > span';
    const BotaoRemoverServico = '.controlePassDigital > div.remove > span';
    const SelectPlano = '.controlePassDigital [id^="plano_"] select';
    const OptionPlano = '.controlePassDigital [id^="plano_"] option';
    const Validar_SelectPlano = '.controlePassDigital [id^="plano_"] .form-control-feedback';
    const RadioTipoClienteAlta = '.controlePassDigital [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.controlePassDigital [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.controlePassDigital [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.controlePassDigital [id^="tipoCliente_"] .form-control-feedback';
    const RadioPortabilidadeSim = '.controlePassDigital [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.controlePassDigital [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
//    const Validar_RadioPortabilidade = '.controlePassDigital [id^="portabilidade_"] .form-control-feedback';
    const CampoNumeroCliente = '.controlePassDigital [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.controlePassDigital [id^="numeroCliente_"] .form-control-feedback';
    const SelectOperadora = '.controlePassDigital [id^="operadora_"] select';
    const Validar_SelectOperadora = '.controlePassDigital [id^="operadora_"] .form-control-feedback';
    const SelectOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] input';
    const Validar_SelectOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] .form-control-feedback';
    const CampoICCID = '.controlePassDigital [id^="iccid_"] input';
    const Validar_CampoICCID = '.controlePassDigital [id^="iccid_"] .form-control-feedback';
    const RadioFaturaEmail = '.controlePassDigital [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.controlePassDigital [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.controlePassDigital [id^="tipoFatura_"] .form-control-feedback';
    const CampoEmail = '.controleFatura [id^="email_"] input';
    const Validar_CampoEmail = '.controleFatura [id^="email_"] .form-control-feedback';
    const RadioDataVencimento = '.controlePassDigital [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.controlePassDigital [id^="dataVencimento_"] .form-control-feedback';
}

class FixaTelefoniaFixa extends VendaServicosElementsPAP
{
    const NomeDoServico = '';
    const SeletorNomeServico = '.telefoniaFixa .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.telefoniaFixa .loading-wrapper > div > span';
    const BotaoRemoverServico = '.telefoniaFixa > div.remove > span';
    const SelectPlano = '.telefoniaFixa [id^="plano_"] select';
    const OptionPlano = '.telefoniaFixa [id^="plano_"] option';
    const Validar_SelectPlano = '.telefoniaFixa [id^="plano_"] .form-control-feedback';
    const RadioPortabilidadeSim = '.telefoniaFixa [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.telefoniaFixa [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioPortabilidade = '.telefoniaFixa [id^="portabilidade_"] .form-control-feedback';
    const CampoNumeroCliente = '.telefoniaFixa [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.telefoniaFixa [id^="numeroCliente_"] .form-control-feedback';
}

class FixaBandaLarga extends VendaServicosElementsPAP
{
    const SeletorNomeServico = '.bandaLarga .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.bandaLarga .loading-wrapper > div > span';
    const BotaoRemoverServico = '.bandaLarga > div.remove > span';
    const SelectPlano = '.bandaLarga [id^="plano_"] select';
    const OptionPlano = '.bandaLarga [id^="plano_"] option';
    const AlertaCarregandoServicosAdicionais = '.bandaLarga .field-wrapper.servicos-adicionais .loading-wrapper';
    const CheckboxServicosAdicionais_ProtegeVoce = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="1"]';
    const CheckboxServicosAdicionais_ProtegeVoceMais = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="2"]';
    const CheckboxServicosAdicionais_ProtegeFamilia = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="3"]';
    const CheckboxServicosAdicionais_ProtegeFamiliaMais = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="4"]';
    const CheckboxServicosAdicionais_HBOGo = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="16"]';
    const CheckboxServicosAdicionais_ESPNPlay = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="17"]';
    const CheckboxServicosAdicionais_FOXPremium = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="18"]';
}