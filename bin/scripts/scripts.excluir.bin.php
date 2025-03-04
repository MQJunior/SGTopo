<?php
/**
* @file scripts.excluir.bin.php
* @name scripts.excluir
* @desc
*   Realiza a exclusão do registro no sistema
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

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a exclusão do registro */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Excluir($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  
}
require($this->SISTEMA_['LAYOUT']."scripts/scripts.pesquisar.layout.php");

?>