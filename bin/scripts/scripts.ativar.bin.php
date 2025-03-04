<?php
/**
* @file scripts.ativar.bin.php
* @name scripts.ativar
* @desc
*   Ativa um registro do sistema
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright й 2006, Mсrcio Queiroz Jr.
* @package    scripts
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
*
*/

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a ativaчуo do sistema */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Ativar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.incluir.layout.php");
}

?>