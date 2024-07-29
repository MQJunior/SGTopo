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

//$this->SISTEMA_['SAIDA']['EXIBIR'] = print_r($_REQUEST,true);



if (isset($_REQUEST['txtChaveRegistro'])){
  $VAR_USUARIO_ID =$_REQUEST['txtChaveRegistro'];
}

if (!isset($VAR_USUARIO_ID)){
  if(isset($this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'])){
    $VAR_USUARIO_ID =$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}


$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];


$USUARIO_ = new usuario($this->SISTEMA_);
//$tmp_EVAL_usuario =   $_REQUEST['TXT_USUARIO_EMAIL'];
$tmp_EVAL_senha =     $_REQUEST['TXT_USUARIO_SENHA'];



$USUARIO_->redefinirSenha($VAR_USUARIO_ID,$tmp_EVAL_senha);
$this->SISTEMA_ = $USUARIO_->getSISTEMA();

unset($USUARIO_);
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTAR";
$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'] = $VAR_USUARIO_ID;

$var_layout_Saida_Mensagem_Titulo = "Sucesso!";
$var_layout_Saida_Mensagem_Corpo = "Informações salva com sucesso!";
include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout/layout.saida.mensagem.layout.php");

$this->ExecutarComando();

?>