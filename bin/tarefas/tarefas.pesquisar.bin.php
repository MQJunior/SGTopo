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
* @date 2018-03-11  v. 0.0.0
*
*/

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS']))?$tmpRegInativos=$_REQUEST['TXT_REGISTROS_INATIVOS']:$tmpRegInativos=false;

/* Realiza a pesquisa no Banco de Dados */
$TAREFAS_ = new Tarefas($this->SISTEMA_);
  (isset($_REQUEST['TXT_TAREFAS_PESQUISAR']))?$TAREFAS_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'],utf8_decode($_REQUEST['TXT_TAREFAS_PESQUISAR']),$tmpRegInativos,$_REQUEST['TXT_TAREFAS_PESQUISAR']):$TAREFAS_->PesquisarNome(null,null,false,20);
  $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
unset($TAREFAS_);


if(isset($_REQUEST['TXT_TAREFAS_PESQUISAR']))
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.pesquisa.layout.php");  // Layout Resumido
else
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.pesquisar.layout.php"); // Layout Completo
?>