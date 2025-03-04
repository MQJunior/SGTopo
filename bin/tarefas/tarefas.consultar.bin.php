<?php
/**
* @file tarefas.consultar.bin.php
* @name tarefas.consultar
* @desc
*   Consulta um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-15  v. 0.0.0
*
*/

/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a consulta no sistema */
  $TAREFAS_ = new Tarefas($this->SISTEMA_);
   $TAREFAS_->Consultar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);
  
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.incluir.layout.php");
}

?>