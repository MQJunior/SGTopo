<?php
/**
* @file tarefas.pesquisar.bin.php
* @name tarefas.pesquisar
* @desc
*   Realiza a pesquisa de registro no Banco de Dados pelo nome
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-21  v. 0.0.0
*
*/


if (isset($_REQUEST['txtChaveRegistro'])){
  /* Realiza a pesquisa no Banco de Dados */
  $TAREFAS_ = new Tarefas($this->SISTEMA_);
    $TAREFAS_->ListarRegistrosEntidade($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);

  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.tabela.registros.layout.php");  // Layout Resumido
}
?>