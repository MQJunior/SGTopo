<?php
/**
* @file padrao.excluir.bin.php
* @name padrao.excluir
* @desc
*   Realiza a exclusão do registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a exclusão do registro */
  $PADRAO_ = new Padrao($this->SISTEMA_);
   $PADRAO_->Excluir($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$PADRAO_->getSISTEMA();
  unset($PADRAO_);
  
}
require($this->SISTEMA_['LAYOUT']."padrao/padrao.pesquisar.layout.php");

?>