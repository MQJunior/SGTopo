<?php
/**
* @file padrao.ativar.bin.php
* @name padrao.ativar
* @desc
*   Ativa um registro do sistema
*
* @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright � 2006, M�rcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a ativa��o do sistema */
  $PADRAO_ = new Padrao($this->SISTEMA_);
   $PADRAO_->Ativar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$PADRAO_->getSISTEMA();
  unset($PADRAO_);
  
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.incluir.layout.php");
}

?>