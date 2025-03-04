<?php
/**
* @file scripts.consultar.bin.php
* @name scripts.consultar
* @desc
*   Consulta um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    scripts
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
*
*/

/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a consulta no sistema */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Consultar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.incluir.layout.php");
}

?>