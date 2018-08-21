<?php
/**
 * Created by PhpStorm.
 * User: douglascolussi
 * Date: 21/05/18
 * Time: 11:46
 */

namespace Tests\Browser\SUN_PAP\Vendas\Vendas;

class VendaElementsServicosPAP{}

class IncluirServicos extends VendaElementsServicosPAP
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
    const BotaoMovelPosFatura = '.icon-card.posFatura';
    const BotaoMovelPosFaturaDesabilitado = '.icon-card.disabled.posFatura';
    const BotaoFixaTelefoniaFixa = '.icon-card.telefoniaFixa';
    const BotaoFixaBandaLarga = '.icon-card.bandaLarga';
    const BotaoFixaTVPorAssinatura = '.icon-card.tvPorAssinatura';

}

class ControleFatura extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Controle Fatura';
    const LabelServicoResumo = '.controleFatura';
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

class FixoFWT extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Fixo FWT';
    const LabelServicoResumo = '.fixoFWT';
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
    const OptionOperadora = '.fixoFWT [id^="operadora_"] option';
    const Validar_SelectOperadora = '.fixoFWT [id^="operadora_"] .form-control-feedback';
    const CampoOutraOperadora = '.fixoFWT [id^="outraOperadora_"] input';
    const Validar_CampoOutraOperadora = '.fixoFWT [id^="outraOperadora_"] .form-control-feedback';
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

class ControleCartao extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Controle Cartão';
    const LabelServicoResumo = '.controleCartao';
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

class ControlePassDigital extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Controle Pass Digital';
    const LabelServicoResumo = '.controlePassDigital';
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
    const OptionOperadora = '.controlePassDigital [id^="operadora_"] option';
    const Validar_SelectOperadora = '.controlePassDigital [id^="operadora_"] .form-control-feedback';
    const SelectOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] input';
    const Validar_SelectOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] .form-control-feedback';
    const CampoOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] input';
    const Validar_CampoOutraOperadora = '.controlePassDigital [id^="outraOperadora_"] .form-control-feedback';
    const CampoICCID = '.controlePassDigital [id^="iccid_"] input';
    const Validar_CampoICCID = '.controlePassDigital [id^="iccid_"] .form-control-feedback';
    const RadioFaturaEmail = '.controlePassDigital [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.controlePassDigital [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.controlePassDigital [id^="tipoFatura_"] .form-control-feedback';
    const CampoEmail = '.controlePassDigital [id^="email_"] input';
    const Validar_CampoEmail = '.controlePassDigital [id^="email_"] .form-control-feedback';
    const RadioDataVencimento = '.controlePassDigital [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.controlePassDigital [id^="dataVencimento_"] .form-control-feedback';
}

class PosFatura extends VendaElementsServicosPAP
{
    const PosicaoIncluirServicoExiste = '#iconCardListServicos [data-name="posFatura"]';
    const NomeDoServico = 'Pós Fatura';
    const LabelServicoResumo = '.posFatura';
    const SeletorNomeServico = '.posFatura .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.posFatura .loading-wrapper > div > span';
    const BotaoRemoverServico = '.posFatura > div.remove > span';
    const SelectPlano = '.posFatura [id^="plano_"] select';
    const OptionPlano = '.posFatura [id^="plano_"] option';
    const Validar_SelectPlano = '.posFatura [id^="plano_"] .form-control-feedback';
    const RadioTipoClienteAlta = '.posFatura [id^="tipoCliente_"] > div > div:nth-child(1)';
    const RadioTipoClienteMigracao = '.posFatura [id^="tipoCliente_"] > div > div:nth-child(2)';
    const RadioTipoClienteUpgrade = '.posFatura [id^="tipoCliente_"] > div > div:nth-child(3)';
    const Validar_RadioTipoCliente = '.posFatura [id^="tipoCliente_"] .form-control-feedback';
    const RadioPortabilidadeSim = '.posFatura [id^="portabilidade_"] > div.radio-group.block > div:nth-child(1)';
    const RadioPortabilidadeNao = '.posFatura [id^="portabilidade_"] > div.radio-group.block > div:nth-child(2)';
//    const Validar_RadioPortabilidade = '.posFatura [id^="portabilidade_"] .form-control-feedback';
    const CampoNumeroCliente = '.posFatura [id^="numeroCliente_"] input';
    const Validar_CampoNumeroCliente = '.posFatura [id^="numeroCliente_"] .form-control-feedback';
    const SelectOperadora = '.posFatura [id^="operadora_"] select';
    const OptionOperadora = '.posFatura [id^="operadora_"] option';
    const Validar_SelectOperadora = '.posFatura [id^="operadora_"] .form-control-feedback';
    const SelectOutraOperadora = '.posFatura [id^="outraOperadora_"] input';
    const Validar_SelectOutraOperadora = '.posFatura [id^="outraOperadora_"] .form-control-feedback';
    const CampoICCID = '.posFatura [id^="iccid_"] input';
    const Validar_CampoICCID = '.posFatura [id^="iccid_"] .form-control-feedback';
    const RadioFaturaEmail = '.posFatura [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(1)';
    const RadioFaturaViaPostal = '.posFatura [id^="tipoFatura_"] > div.radio-group.block > div:nth-child(2)';
    const Validar_RadioFatura = '.posFatura [id^="tipoFatura_"] .form-control-feedback';
    const CampoEmail = '.posFatura [id^="email_"] input';
    const Validar_CampoEmail = '.posFatura [id^="email_"] .form-control-feedback';
    const RadioDataVencimento = '.posFatura [id^="dataVencimento_"] > div.radio-group.circle > div';
    const Validar_RadioDataVencimento = '.posFatura [id^="dataVencimento_"] .form-control-feedback';
    const BotaoAdicionarDependentes = '.posFatura .field-center-wrapper .btn.btn-block.btn-dashed-primary';

    const Modal_DependentesTitulo = '.module-container .modal-wrapper .v-modal.center .modal-header .title';
    const Modal_DependentesGratuitoPago = '.module-container .modal-wrapper .v-modal.center .dependentes-item > .title-wrapper .name-wrapper .title';
    const Modal_BotaoAdicionarDependente = '.module-container .modal-wrapper .v-modal.center .dependentes-item .btn.btn-dashed-primary.btn-block';
    const Modal_BotaoContinuarDependentes = '.module-container .modal-wrapper .v-modal.center .modal-footer .btn.btn-success.btn-block';
    const Modal_PanelTitelDependentes = '.dependente-selecionado .title-wrapper .name-wrapper .title';
    const Modal_LabelPlanoDependente = ' [data-test="Plano"] .value';
    const Modal_InputNumeroLinhaDependente = ' [id^="numeroLinha_"] input';
    const Modal_InputIccIdDependente = ' [id^="iccidDependente_"] input';
    const Modal_BotaoPortabilidadeSimDependente = ' [id^="portabilidade_"] [data-value="1"]';
    const Modal_BotaoPortabilidadeNaoDependente = ' [id^="portabilidade_"] [data-value="0"]';
    const Modal_InputNumeroAtualPortabilidadeDependente = ' [id^="numeroPortabilidade_"] input';
    const Modal_SelectOperadoraPortabilidadeDependente = ' [id^="operadora_"] select';
    const Modal_OptionOperadoraPortabilidadeDependente = ' [id^="operadora_"] option';
}

class FixaTelefoniaFixa extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Telefonia Fixa';
    const LabelServicoResumo = '.telefoniaFixa';
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

class FixaBandaLarga extends VendaElementsServicosPAP
{
    const NomeDoServico = 'Banda Larga';
    const LabelServicoResumo = '.bandaLarga';
    const SeletorNomeServico = '.bandaLarga .toggle-form .text-wrapper';
    const AlertaCarregandoPlanos = '.bandaLarga .loading-wrapper > div > span';
    const BotaoRemoverServico = '.bandaLarga > div.remove > span';
    const SelectPlano = '.bandaLarga [id^="plano_"] select';
    const OptionPlano = '.bandaLarga [id^="plano_"] option';
    const Validar_SelectPlano = '.bandaLarga [id^="plano_"] .form-control-feedback';
    const AlertaCarregandoServicosAdicionais = '.bandaLarga .field-wrapper.servicos-adicionais .loading-wrapper';
    const CheckboxServicosAdicionais_ProtegeVoce = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="1"]';
    const CheckboxServicosAdicionais_ProtegeVoceMais = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="2"]';
    const CheckboxServicosAdicionais_ProtegeFamilia = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="3"]';
    const CheckboxServicosAdicionais_ProtegeFamiliaMais = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="4"]';
    const CheckboxServicosAdicionais_HBOGo = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="16"]';
    const CheckboxServicosAdicionais_ESPNPlay = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="17"]';
    const CheckboxServicosAdicionais_FOXPremium = '.bandaLarga .form-wrapper .field-wrapper.servicos-adicionais .form-group [id="18"]';
}

class FixaTVAssinatura extends VendaElementsServicosPAP
{
    const NomeDoServico = 'TV por Assinatura';
    const LabelServicoResumo = '.tvPorAssinatura';


}