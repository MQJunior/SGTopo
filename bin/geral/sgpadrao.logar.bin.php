<?php
/**
* @file sgpadrao.logar.bin.php
* @name logar
* @desc
*   Script para exibir a tela de logar do sistema
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-11  v. 0.0.0
*/
if (!isset($SAIDA_MENSAGEM_ERROR))$SAIDA_MENSAGEM_ERROR ="";
if (isset($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'])){
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.logar.php");
  //echo __FILE__." ".__LINE__;
}
?>