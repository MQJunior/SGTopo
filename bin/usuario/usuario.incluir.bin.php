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
$TMP_SESSAO_CODIGO =$this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTAR";



if (isset($_REQUEST['TXT_USUARIO_NOME']) && isset($_REQUEST['TXT_USUARIO_EMAIL']) && isset($_REQUEST['TXT_USUARIO_SENHA'])){
  $tmp_ConexaoDB = new ConexaoDB($this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['HOSTNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['USERNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['PASSWORD']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['DATABASENAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['TIPODB']);
  $tmp_USUARIO = $tmp_ConexaoDB; 
  $tmp_USUARIO->Data['NOME'] = utf8_decode($_REQUEST['TXT_USUARIO_NOME']);
  $tmp_USUARIO->Data['NOME_EXIBIR'] = utf8_decode($_REQUEST['TXT_USUARIO_NOME_EXIBIR']);
  $tmp_USUARIO->Data['EMAIL'] = $_REQUEST['TXT_USUARIO_EMAIL'];
  $tmp_USUARIO->Data['SENHA'] = $_REQUEST['TXT_USUARIO_SENHA'];
  $tmp_USUARIO->Data['FUNCAO'] = $_REQUEST['TXT_USUARIO_FUNCAO'];
  $tmp_USUARIO->Data['TITULO'] = $_REQUEST['TXT_USUARIO_TITULO'];
  //$tmp_USUARIO->Data['PESSOA'] = $_REQUEST['TXT_USUARIO_PESSOA'];
  $tmp_USUARIO->Data['TIPO'] = "1"; //$_REQUEST['TXT_USUARIO_TIPO'];
  $tmp_USUARIO->Data['GRUPO'] = "1"; //$_REQUEST['TXT_USUARIO_GRUPO'];
  $tmp_USUARIO->Data['DESCRICAO'] = $_REQUEST['TXT_USUARIO_DESCRICAO'];
  //$tmp_USUARIO->Data['IMAGEM'] = $_REQUEST['TXT_USUARIO_IMAGEM'];
  $tmp_USUARIO->Data['USUARIO_CRIOU'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  $tmp_USUARIO->Data['SESSAO'] = $TMP_SESSAO_CODIGO;
  $tmp_USUARIO->Data['DATACRIACAO']= date('Y-m-d H:i:s');
  $USUARIO_ =new usuario($this->SISTEMA_);
  $tmp_USUARIO->Insert($USUARIO_->ENTIDADE_DB);
  unset($USUARIO_);
  $VAR_USUARIO_ID = $tmp_USUARIO->Id();
  $_REQUEST['txtChaveRegistro'] =$VAR_USUARIO_ID;
  $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO']=$VAR_USUARIO_ID;
  $var_layout_Saida_Mensagem_Titulo = "Sucesso!";
  $var_layout_Saida_Mensagem_Corpo = "Informações salva com sucesso!";
  include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout/layout.saida.mensagem.layout.php");
  $this->ExecutarComando();
  
  
}else{
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.incluir.layout.php");
}




?>