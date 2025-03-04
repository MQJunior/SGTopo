<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright й 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/

//$this->SISTEMA_['SAIDA']['EXIBIR'] = print_r($_REQUEST,true);
$VAR_USUARIO_ID = $_REQUEST['txtChaveRegistro'];
if (!isset($VAR_USUARIO_ID)){
  if(isset($this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'])){
    $VAR_USUARIO_ID =$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}

$tmp_EVAL_ConexaoDB = new ConexaoDB($this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['HOSTNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['USERNAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['PASSWORD']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['DATABASENAME']
                                 ,$this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['TIPODB']);
                                 
$DADOS_ALTERAR['CODIGO'] = $VAR_USUARIO_ID;
$DADOS_ALTERAR['REG_ATIVO'] = "0";

$condicao = " CODIGO = '".$DADOS_ALTERAR['CODIGO']."' ";             # Adiciona a Condiчуo no registro, se houver

$USUARIO_ = new usuario($this->SISTEMA_);

if ($tmp_EVAL_ConexaoDB->Update($DADOS_ALTERAR, $condicao, $USUARIO_->ENTIDADE_DB)) {
  unset($USUARIO_);
  unset($tmp_EVAL_ConexaoDB);
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTAR";
  $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO']=$DADOS_ALTERAR['CODIGO'];
  $this->ExecutarComando();
}else{
  unset($tmp_EVAL_ConexaoDB);
  die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");  // IMPLEMENTAR CONTROLE DE ERROS
}

?>