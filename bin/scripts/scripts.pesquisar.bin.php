<?php
/**
* @file scripts.pesquisar.bin.php
* @name scripts.pesquisar
* @desc
*   Realiza a pesquisa de registro no Banco de Dados pelo nome
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

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS']))?$tmpRegInativos=$_REQUEST['TXT_REGISTROS_INATIVOS']:$tmpRegInativos=false;

/* Realiza a pesquisa no Banco de Dados */
$SCRIPTS_ = new Scripts($this->SISTEMA_);
  (isset($_REQUEST['TXT_SCRIPTS_PESQUISAR']))?$SCRIPTS_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'],utf8_decode($_REQUEST['TXT_SCRIPTS_PESQUISAR']),$tmpRegInativos,$_REQUEST['TXT_SCRIPTS_PESQUISAR']):$SCRIPTS_->PesquisarNome(null,null,false,20);
  $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
unset($SCRIPTS_);


if(isset($_REQUEST['TXT_SCRIPTS_PESQUISAR']))
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.pesquisa.layout.php");  // Layout Resumido
else
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.pesquisar.layout.php"); // Layout Completo
?>