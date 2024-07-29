<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright � 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/
//print_r($this->SISTEMA_);
$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if(isset($_REQUEST['txtChaveRegistro'])){
  if(!isset($_REQUEST['TXT_ENTIDADEACAO_ACAO_RESTRITO']))
    $_REQUEST['TXT_ENTIDADEACAO_ACAO_RESTRITO']=0;
  else
    $_REQUEST['TXT_ENTIDADEACAO_ACAO_RESTRITO']=1;
  
  $tmpDados['RESTRITO'] =$_REQUEST['TXT_ENTIDADEACAO_ACAO_RESTRITO'];
  $tmpDados['NIVEL'] =$_REQUEST['TXT_ENTIDADEACAO_ACAO_NIVEL'];
  
  $tmpCodigo=$_REQUEST['txtChaveRegistro'];

  $ENTIDADEACAO_ = new EntidadeAcao($this->SISTEMA_);
  $ENTIDADEACAO_->AlterarAcao($tmpDados,$tmpCodigo);
  $this->SISTEMA_ =$ENTIDADEACAO_->getSISTEMA();
  unset($ENTIDADEACAO_);

  
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.consultar.acao.layout.php");
}
else{
  if(isset($_REQUEST['TXT_ENTIDADEACAO_ACAO_ENTIDADE']))
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ACAO_ENTIDADE']=$_REQUEST['TXT_ENTIDADEACAO_ACAO_ENTIDADE'];
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.listar.acao.layout.php");
}  
?>