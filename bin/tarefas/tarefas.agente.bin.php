<?php
/**
* @file tarefas.agente.bin.php
* @name tarefas.agente
* @desc
*   Agente que executa as tarefas definida pelo usuário
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage agente
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

error_reporting(E_ALL);

/**
 * @var string $SISTEMA['INCLUDES']['DIR']['CONFIG'] - Define o endereco do Diretorio conf;
 */
$SISTEMA['INCLUDES']['DIR']['CONFIG'] = '/sistema/sistemas/SGPadrao/conf/';
require_once($SISTEMA['INCLUDES']['DIR']['CONFIG'].'sgpadrao.def.conf.php');

print_r($SISTEMA);


?>