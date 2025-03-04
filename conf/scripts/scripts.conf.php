<?php
/**
* @file scripts.conf.php
* @name scripts
* @desc
*   Descrição scripts
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    scripts
* @subpackage Config
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
*
*/

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['SCRIPTS']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['SCRIPTS']['CONF']['DATABASE']['TBL_SCRIPTS'] = 'TBL_SYS_SCRIPTS';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['SCRIPTS']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['ENTIDADE']['USUARIO']['CONF']['DATABASE']['ENTIDADE_DB'];


?>