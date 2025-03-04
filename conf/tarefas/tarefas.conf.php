<?php
/**
* @file tarefas.conf.php
* @name tarefas
* @desc
*   Descrição tarefas
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Config
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE']['TBL_TAREFAS'] = 'TBL_SYS_TAREFAS';
/* NOME DA TABELA DE STATUS DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE']['TBL_TAREFA_STATUS'] = 'TBL_SYS_TAREFA_STATUS';

/* TABELA ENTIDADE ACAO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE']['TBL_ENTIDADE'] = 'TBL_SYS_ENTIDADES';
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE']['TBL_ENTIDADEACAO'] = 'TBL_SYS_ACOES';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['ENTIDADE']['USUARIO']['CONF']['DATABASE']['ENTIDADE_DB'];


?>