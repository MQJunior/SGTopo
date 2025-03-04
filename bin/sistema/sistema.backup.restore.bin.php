<?php
/**
* @file sistema.backup.restore.bin.php
* @name sistema.backup.restore
* @desc
*   Realiza a pesquisa de registro no Banco de Dados pelo nome
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-02  v. 0.0.0
*
*/

/* Realiza a pesquisa no Banco de Dados */
$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
$tmpTBLBackup =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_BACKUP'];
$tmpTBLBackupUsuarios =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_USUARIO'];
$BACKUP_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],$tmpDBConfig['USERNAME'],$tmpDBConfig['PASSWORD'],$tmpDBConfig['DATABASENAME'],$tmpDBConfig['TIPODB']);
  $tmpSQLBackups = 'SELECT * FROM '.$tmpTBLBackup." 
  ";
  
  $sql_tmpBackups = "select Backups.*, Usuario.NOME_EXIBIR USUARIO_NOME
    FROM  $tmpTBLBackup as Backups
    Left join
        $tmpTBLBackupUsuarios as Usuario on (Usuario.codigo = Backups.usuario)";
  $BACKUP_->Query($tmpSQLBackups);
  $BackupListaDados = $BACKUP_->ResultConsult();
unset($BACKUP_);
$this->SISTEMA_['ENTIDADE']['BACKUP']['DADOS'] = $BackupListaDados;
require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.restore.layout.php"); // Layout Completo
?>