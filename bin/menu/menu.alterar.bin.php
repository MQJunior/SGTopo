<?php
/** 
 * @file sgpadrao.login.bin.php
 * @name login
 * @desc
 *   Script para verificar a autenticacao do usuario
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright Â© 2006, Marcio Queiroz Jr.
 * @package    sgpadrao
 * @subpackage bin
 * @todo       
 *
 *
 * @date 2018-01-12  v. 0.0.0
 */
//print_r($this->SISTEMA_);
$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if (isset($_REQUEST['txtChaveRegistro']))
  $VAR_MENU_CODIGO = $_REQUEST['txtChaveRegistro'];
unset($VAR_MENU_DADOS);
$VAR_MENU_DADOS['NOME'] = $_REQUEST['TXT_MENU_NOME'];
$VAR_MENU_DADOS['MENU_PAI'] = $_REQUEST['TXT_MENU_PAI'];
($VAR_MENU_DADOS['MENU_PAI'] == 0) ? $VAR_MENU_DADOS['MENU_PAI'] = "null" : false;

(!isset($_REQUEST['TXT_MENU_ENTIDADE_ACAO'])) ? $_REQUEST['TXT_MENU_ENTIDADE_ACAO'] = 0 : false;
$VAR_MENU_DADOS['ENTIDADE_ACAO'] = $_REQUEST['TXT_MENU_ENTIDADE_ACAO'];
($VAR_MENU_DADOS['ENTIDADE_ACAO'] == 0) ? $VAR_MENU_DADOS['ENTIDADE_ACAO'] = null : false;

(isset($_REQUEST['TXT_MENU_ICONE_NOME'])) ? $VAR_MENU_DADOS['ICONE'] = $_REQUEST['TXT_MENU_ICONE_NOME'] : $VAR_MENU_DADOS['ICONE'] = $_REQUEST['TXT_MENU_ICONE'];


$VAR_MENU_DADOS['TIPO'] = '1';
if (isset($_REQUEST['TXT_MENU_TIPO']))
  $VAR_MENU_DADOS['TIPO'] = '0';

$VAR_MENU_DADOS['REG_ATIVO'] = '0';
if (isset($_REQUEST['TXT_MENU_ATIVO']))
  $VAR_MENU_DADOS['REG_ATIVO'] = '1';



$MENU_ = new MenuSys($this->SISTEMA_);
//$MENU_->Consultar($VAR_MENU_CODIGO);    txtOrdemAcao
$MENU_->Codigo = $VAR_MENU_CODIGO;
$MENU_->Alterar($VAR_MENU_DADOS);
unset($MENU_);

$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = "MENU";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "EXIBIR";
$this->SISTEMA_['ENTIDADE']['MENU']['VARS']['CODIGO'] = $VAR_MENU_CODIGO;
//$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "SISTEMA";
//$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "DEBUG";
$this->ExecutarComando();

?>