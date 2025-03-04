<?php
/**
* @file padrao.desativar.bin.php
* @name padrao.desativar
* @desc
*   Desativa um registro 
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a desativaчуo do registro */
  $PADRAO_ = new Padrao($this->SISTEMA_);
   $PADRAO_->Desativar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$PADRAO_->getSISTEMA();
  unset($PADRAO_);
  
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.listar.layout.php");
}

?>