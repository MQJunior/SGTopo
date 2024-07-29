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

//$this->SISTEMA_['SAIDA']['EXIBIR'] .= " --- ".print_r($VAR_MENU_GERAL_B,true)." --- ";
if (isset($_REQUEST))
	$this->SISTEMA_['SAIDA']['EXIBIR'] = print_r($_REQUEST,true);
$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($_FILES,true);
$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($this->SISTEMA_,true);
//$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($VAR_MENU_GERAL,true);

?>