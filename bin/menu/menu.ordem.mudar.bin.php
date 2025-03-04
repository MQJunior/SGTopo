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
$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if (isset($_REQUEST['txtChaveRegistro']))
  $VAR_MENU_CODIGO = $_REQUEST['txtChaveRegistro'];

$MENU_ = new MenuSys($this->SISTEMA_);
//$MENU_->Consultar($VAR_MENU_CODIGO);    txtOrdemAcao
if ($_REQUEST['txtOrdemAcao']=="SUBIR")
  $MENU_->OrdemMudar($VAR_MENU_CODIGO,true);
if ($_REQUEST['txtOrdemAcao']=="DESCER")
  $MENU_->OrdemMudar($VAR_MENU_CODIGO,false);

unset($MENU_);

$this->SISTEMA_['ENTIDADE']['MENU']['VARS']['CODIGO'] = $VAR_MENU_CODIGO;
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "MENU";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "EXIBIR";
$this->CaminhoComando();

?>