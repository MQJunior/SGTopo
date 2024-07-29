<?php
/**
 * @file sgpadrao.login.bin.php
 * @name login
 * @desc
 *   Script para verificar a autenticacao do usuario
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright © 2006, Marcio Queiroz Jr.
 * @package    sgpadrao
 * @subpackage bin
 * @todo       
 *
 *
 * @date 2018-01-12  v. 0.0.0
 */
//print_r($this->SISTEMA_);
$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

unset($VAR_MENU_DADOS);
$VAR_MENU_DADOS['NOME'] = $_REQUEST['TXT_MENU_NOME'];
$VAR_MENU_DADOS['MENU_PAI'] = $_REQUEST['TXT_MENU_PAI'];
$VAR_MENU_DADOS['ENTIDADE_ACAO'] = $_REQUEST['TXT_MENU_ENTIDADE_ACAO'];
($VAR_MENU_DADOS['ENTIDADE_ACAO'] == 0) ? $VAR_MENU_DADOS['ENTIDADE_ACAO'] = null : false;
($VAR_MENU_DADOS['MENU_PAI'] == 0) ? $VAR_MENU_DADOS['MENU_PAI'] = null : false;


(isset($_REQUEST['TXT_MENU_ICONE_NOME'])) ? $VAR_MENU_DADOS['ICONE'] = $_REQUEST['TXT_MENU_ICONE_NOME'] : $VAR_MENU_DADOS['ICONE'] = $_REQUEST['TXT_MENU_ICONE'];


$VAR_MENU_DADOS['TIPO'] = 1;
if (isset($_REQUEST['TXT_MENU_TIPO']))
  $VAR_MENU_DADOS['TIPO'] = 0;


$VAR_MENU_DADOS['REG_ATIVO'] = 1;


$MENU_ = new MenuSys($this->SISTEMA_);

if (!isset($VAR_MENU_DADOS['NIVEL']))
  $VAR_MENU_DADOS['NIVEL'] = $MENU_->NivelPai($VAR_MENU_DADOS['MENU_PAI']) + 1;
if (!isset($VAR_MENU_DADOS['ORDEM']))
  $VAR_MENU_DADOS['ORDEM'] = $MENU_->NivelPai($VAR_MENU_DADOS['MENU_PAI']) + 1;
if (($VAR_MENU_DADOS['ORDEM'] == null) || ($VAR_MENU_DADOS['ORDEM'] == false))
  $VAR_MENU_DADOS['ORDEM'] = 0;

//if (($VAR_MENU_DADOS['MENU_PAI']=='')|| ($VAR_MENU_DADOS['MENU_PAI']==0))$VAR_MENU_DADOS['MENU_PAI']='0';

$MENU_->Incluir($VAR_MENU_DADOS);
$VAR_MENU_CODIGO = $MENU_->Codigo;
unset($MENU_);

$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = "MENU";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "EXIBIR";
$this->SISTEMA_['ENTIDADE']['MENU']['VARS']['CODIGO'] = $VAR_MENU_CODIGO;
$this->ExecutarComando();

?>