<?php
/**
 * @file padrao.conf.php
 * @name padrao
 * @desc
 *   Descrição padr�o
 *
 * @author     Márcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Márcio Queiroz Jr.
 * @package    padrao
 * @subpackage Config
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */

/* CONFIGURA��O DO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE']['TBL_PADRAO'] = 'TBL_PADRAO';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

