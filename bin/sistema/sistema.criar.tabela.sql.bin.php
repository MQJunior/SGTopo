<?php
/**
* @file sistema.criar.tabela.sql.bin.php
* @name sistema.criar.tabela.sql
* @desc
*   Cria uma tabela de acordo com os comandos
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-03-01  v. 0.0.0
*
*/

$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
$CNXDB_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],
                        $tmpDBConfig['USERNAME'],
                        $tmpDBConfig['PASSWORD'],
                        $tmpDBConfig['DATABASENAME'],
                        $tmpDBConfig['TIPODB']);
if (isset($_REQUEST['TXT_SQL_TABELA_GENERATOR']))
  $CNXDB_->Query(utf8_decode($_REQUEST['TXT_SQL_TABELA_GENERATOR']));

if (isset($_REQUEST['TXT_SQL_TABELA_CAMPOS']))
  $CNXDB_->Query(utf8_decode($_REQUEST['TXT_SQL_TABELA_CAMPOS']));

if (isset($_REQUEST['TXT_SQL_TABELA_PRIMARY_KEY']))
  $CNXDB_->Query(utf8_decode($_REQUEST['TXT_SQL_TABELA_PRIMARY_KEY']));

if (isset($_REQUEST['TXT_SQL_TABELA_FOREING_KEY'])){
  $tmpScripts = explode(";",utf8_decode($_REQUEST['TXT_SQL_TABELA_FOREING_KEY']),-1);
  for ($i=0;$i<count($tmpScripts);$i++)
    $CNXDB_->Query($tmpScripts[$i].";");
}
if (isset($_REQUEST['TXT_SQL_TABELA_TRIGGER']))
  $CNXDB_->Query(utf8_decode($_REQUEST['TXT_SQL_TABELA_TRIGGER']));

unset($CNXDB_);
$this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']="Sistema Tabelas";
$this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']= "Tabela criada com sucesso!";

$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']='SISTEMA';
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = 'TABELAS';

$this->ExecutarComando();

?>