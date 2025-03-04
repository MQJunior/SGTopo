<?php
/**
 * @file padrao.consultar.layout.php
 * @name padrao.consultar
 * @desc
 *   Layout para o formul�rio de consulta
 *
 * @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, M�rcio Queiroz Jr.
 * @package    padrao
 * @subpackage Layout
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigat�rios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadePadraoCampos;

/* Captura as Variaveis que ser�o exibidas */
foreach ($EntidadeCampos as $tmpValor) {
  $tmpVar = "VAR_PADRAO_" . $tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'][$tmpValor['NOME']];
  $DATASET['FIELDS'][] = $tmpValor;
}
foreach ($DATASET['FIELDS'] as $tmpFields) {
  $data_[$tmpFields['NOME']] = $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'][$tmpFields['NOME']];
}

$DATASET_DATA[] = $data_;

//$this->SISTEMA_['SAIDA']['MODE'] = 'api';

if ($this->SISTEMA_['SAIDA']['MODE'] == 'html') {
  include_once ($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "padrao/padrao.consultar.layout.php");
} else {
  require ($this->SISTEMA_['LAYOUT'] . "../basic/componentes.layout.php");

  $this->SISTEMA_['SAIDA']['PAGINA'] = $tmpLayoutPagina;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['ID'] = "FrmPadraoConsultar";
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['TYPE'] = "FormPadrao";
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['TITLE'] = $SysRtl_Padrao_Consultar_Cabecalho_Titulo;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['SUBTITLE'] = $SysRtl_Padrao_Consultar_Cabecalho_Subtitulo;

  $PERMISSAO_ = new permissao($this->SISTEMA_);
  $tmpListaAcoesPermissaoPadrao = $PERMISSAO_->ListaAcaoPermissaoEntidade($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO');

  $PERMISSAO_LOGVER = ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER'));
  //die($PERMISSAO_LOGVER);
  $PERMISSAO_LOGINFORMACAO = ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'INFORMACAO'));

  $cmpPadraoConsultar_grpBotoesSuperior = $tmpLayoutComponentePadraoGroup;
  $cmpPadraoConsultar_grpBotoesSuperior['ID'] = "grpPadraoConsultarBotoes";
  $cmpPadraoConsultar_grpBotoesSuperior['LABEL'] = "";

  if (in_array('EXCLUIR', $tmpListaAcoesPermissaoPadrao)) {
    $cmpPadraoConsultar_btnBotoesSuperior_Excluir = $tmpLayoutComponentePadraoButton_Excluir;
    $cmpPadraoConsultar_btnBotoesSuperior_Excluir['ENTIDADE'] = "PADRAO";
    $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Excluir;
  }

  if ($VAR_PADRAO_REG_ATIVO == '1') {
    if (in_array('DESATIVAR', $tmpListaAcoesPermissaoPadrao)) {
      $cmpPadraoConsultar_btnBotoesSuperior_Desativar = $tmpLayoutComponentePadraoButton_Desativar;
      $cmpPadraoConsultar_btnBotoesSuperior_Desativar['ENTIDADE'] = "PADRAO";
      $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Desativar;
    }
  } else {
    if (in_array('ATIVAR', $tmpListaAcoesPermissaoPadrao)) {
      $cmpPadraoConsultar_btnBotoesSuperior_Ativar = $tmpLayoutComponentePadraoButton_Ativar;
      $cmpPadraoConsultar_btnBotoesSuperior_Ativar['ENTIDADE'] = "PADRAO";
      $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Ativar;
    }
  }

  if (in_array('ALTERAR', $tmpListaAcoesPermissaoPadrao)) {
    $cmpPadraoConsultar_btnBotoesSuperior_Alterar = $tmpLayoutComponentePadraoButton_Alterar;
    $cmpPadraoConsultar_btnBotoesSuperior_Alterar['ENTIDADE'] = "PADRAO";
    $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Alterar;

  }
  if (in_array('INCLUIR', $tmpListaAcoesPermissaoPadrao)) {
    $cmpPadraoConsultar_btnBotoesSuperior_Incluir = $tmpLayoutComponentePadraoButton_Incluir;
    $cmpPadraoConsultar_btnBotoesSuperior_Incluir['ENTIDADE'] = "PADRAO";
    $cmpPadraoConsultar_btnBotoesSuperior_Incluir['LABEL'] = $SysRtl_Btn_Novo;
    $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Incluir;

  }

  if (in_array('PESQUISAR', $tmpListaAcoesPermissaoPadrao)) {
    $cmpPadraoConsultar_btnBotoesSuperior_Pesquisar = $tmpLayoutComponentePadraoButton_Pesquisar;
    $cmpPadraoConsultar_btnBotoesSuperior_Pesquisar['ENTIDADE'] = "PADRAO";
    $cmpPadraoConsultar_grpBotoesSuperior['COMPONENTES'][] = $cmpPadraoConsultar_btnBotoesSuperior_Pesquisar;

  }

  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_grpBotoesSuperior;


  $cmpPadraoConsultar_Codigo = $tmpLayoutComponenteHidden;
  $cmpPadraoConsultar_Codigo['ID'] = "txtChaveRegistro";
  $cmpPadraoConsultar_Codigo['VALUE'] = $VAR_PADRAO_CODIGO;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_Codigo;

  $cmpPadraoConsultar_lblPadraoNome = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoNome['ID'] = "TXT_PADRAO_NOME";
  $cmpPadraoConsultar_lblPadraoNome['LABEL'] = $SysRtl_Padrao_Campos_NOME;
  $cmpPadraoConsultar_lblPadraoNome['VALUE'] = $VAR_PADRAO_NOME;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoNome;

  $cmpPadraoConsultar_lblPadraoTipo = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoTipo['ID'] = "TXT_PADRAO_TIPO";
  $cmpPadraoConsultar_lblPadraoTipo['LABEL'] = $SysRtl_Padrao_Campos_TIPO;
  $cmpPadraoConsultar_lblPadraoTipo['VALUE'] = $VAR_PADRAO_TIPO;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoTipo;

  $cmpPadraoConsultar_lblPadraoData = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoData['ID'] = "TXT_PADRAO_DATA";
  $cmpPadraoConsultar_lblPadraoData['LABEL'] = $SysRtl_Padrao_Campos_DATA;
  $cmpPadraoConsultar_lblPadraoData['VALUE'] = $VAR_PADRAO_DATA;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoData;

  $cmpPadraoConsultar_lblPadraoValor = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoValor['ID'] = "TXT_PADRAO_VALOR";
  $cmpPadraoConsultar_lblPadraoValor['LABEL'] = $SysRtl_Padrao_Campos_VALOR;
  $cmpPadraoConsultar_lblPadraoValor['VALUE'] = $VAR_PADRAO_VALOR;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoValor;

  $cmpPadraoConsultar_lblPadraoEscolha = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoEscolha['ID'] = "TXT_PADRAO_ESCOLHA";
  $cmpPadraoConsultar_lblPadraoEscolha['LABEL'] = $SysRtl_Padrao_Campos_ESCOLHA;
  $cmpPadraoConsultar_lblPadraoEscolha['VALUE'] = $VAR_PADRAO_ESCOLHA;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoEscolha;


  $cmpPadraoConsultar_lblPadraoDescricao = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoDescricao['ID'] = "TXT_PADRAO_DESCRICAO";
  $cmpPadraoConsultar_lblPadraoDescricao['LABEL'] = $SysRtl_Padrao_Campos_DESCRICAO;
  $cmpPadraoConsultar_lblPadraoDescricao['VALUE'] = $VAR_PADRAO_DESCRICAO;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoDescricao;


  $cmpPadraoConsultar_lblPadraoRegistroAtivo = $tmpLayoutComponenteLabel;
  $cmpPadraoConsultar_lblPadraoRegistroAtivo['ID'] = "TXT_PADRAO_REGATIVO";
  $cmpPadraoConsultar_lblPadraoRegistroAtivo['LABEL'] = $SysRtl_Padrao_Campos_REG_ATIVO;
  $cmpPadraoConsultar_lblPadraoRegistroAtivo['VALUE'] = $VAR_PADRAO_REG_ATIVO;
  $this->SISTEMA_['SAIDA']['PAGINA']['FORM']['COMPONENTES'][] = $cmpPadraoConsultar_lblPadraoRegistroAtivo;


  $this->SISTEMA_['SAIDA']['PAGINA']['DATA'] = $DATASET_DATA;

  if (!(($PERMISSAO_LOGVER) || ($PERMISSAO_LOGINFORMACAO))) {
    unset($this->SISTEMA_['SAIDA']['PAGINA']['DATA'][0]['USUARIO']);
    unset($this->SISTEMA_['SAIDA']['PAGINA']['DATA'][0]['USUARIO_NOME']);
    unset($this->SISTEMA_['SAIDA']['PAGINA']['DATA'][0]['DATACRIACAO']);
  }

}