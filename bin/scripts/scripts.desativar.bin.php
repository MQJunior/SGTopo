<?php
/**
* @file scripts.desativar.bin.php
* @name scripts.desativar
* @desc
*   Desativa um registro 
*
* @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright � 2006, M�rcio Queiroz Jr.
* @package    scripts
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
*
*/

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a desativa��o do registro */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Desativar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.listar.layout.php");
}

?>