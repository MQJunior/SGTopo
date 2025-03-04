<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/


$VAR_SISTEMA_DEBUG = print_r($this->SISTEMA_,true);
//die($VAR_SISTEMA_DEBUG);
//$VAR_SISTEMA_DEBUG = print_r($_REQUEST,true);
require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."sistema/sistema.debug.layout.php");

?>