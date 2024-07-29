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

if (!isset($VAR_USUARIO_ID)){
  if(isset($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'])){
    $VAR_USUARIO_ID =$this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}


$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$tmp_EVAL_ConexaoDB = new ConexaoDB($this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['HOSTNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['USERNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['PASSWORD']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['DATABASENAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['TIPODB']);
                                 
$DADOS_ALTERAR['CODIGO'] = $_REQUEST['TXT_USUARIO_PERFIL_CODIGO'];
$DADOS_ALTERAR['NOME'] = utf8_decode($_REQUEST['TXT_USUARIO_PERFIL_NOME']);
$DADOS_ALTERAR['NOME_EXIBIR'] = utf8_decode($_REQUEST['TXT_USUARIO_PERFIL_NOMECURTO']);
$DADOS_ALTERAR['FUNCAO'] = $_REQUEST['TXT_USUARIO_PERFIL_FUNCAO'];
$DADOS_ALTERAR['TITULO'] = $_REQUEST['TXT_USUARIO_PERFIL_TITULO'];

$condicao = " CODIGO = '".$DADOS_ALTERAR['CODIGO']."' ";             # Adiciona a Condição no registro, se houver

if ($tmp_EVAL_ConexaoDB->Update($DADOS_ALTERAR, $condicao, "TBL_USUARIOS")) {
  $var_layout_Saida_Mensagem_Titulo = "Sucesso!";
  $var_layout_Saida_Mensagem_Corpo = "Informações salva com sucesso!";
  include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout/layout.saida.mensagem.layout.php");
  
}else{
  $var_layout_Saida_Mensagem_Titulo = "Alerta!";
  $var_layout_Saida_Mensagem_Corpo = "As informações não foram salvas!";
  include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout/layout.saida.alerta.layout.php");
}
unset($tmp_EVAL_ConexaoDB);
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "PERFIL";
$this->ExecutarComando();
?>