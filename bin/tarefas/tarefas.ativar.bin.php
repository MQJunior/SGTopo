<?php
/**
* @file tarefas.ativar.bin.php
* @name tarefas.ativar
* @desc
*   Ativa um registro do sistema
*
* @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright � 2006, M�rcio Queiroz Jr.
* @package    tarefas
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-30  v. 0.0.0
*
*/

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a ativa��o do sistema */
  $TAREFAS_ = new Tarefas($this->SISTEMA_);
   $TAREFAS_->Ativar($_REQUEST['txtChaveRegistro']);
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);
  
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.incluir.layout.php");
}

?>