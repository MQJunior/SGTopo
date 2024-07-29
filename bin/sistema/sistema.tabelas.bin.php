<?php
/**
* @file sistema.tabelas.bin.php
* @name sistema.tabelas
* @desc
*   Realiza a pesquisa de registro no Banco de Dados pelo nome
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];

$CNXDB_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],
                        $tmpDBConfig['USERNAME'],
                        $tmpDBConfig['PASSWORD'],
                        $tmpDBConfig['DATABASENAME'],
                        $tmpDBConfig['TIPODB']);

$VAR_SISTEMA_TABELAS_DADOS = $CNXDB_->ListarTabelas();
unset($CNXDB_);

require($this->SISTEMA_['LAYOUT']."sistema/sistema.tabelas.layout.php"); 
?>