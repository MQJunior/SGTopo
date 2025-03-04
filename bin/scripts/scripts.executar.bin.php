<?php
/**
* @file scripts.executar.bin.php
* @name scripts.executar
* @desc
*   Executa um script de um registro do sistema
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    scripts
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-04  v. 0.0.0
*
*/

/* Captura a chave do registro a ser executada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a execuчуo do script do sistema */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Executar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  /*
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.pesquisar.layout.php");
  */
}

?>