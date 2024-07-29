<?php
/**
* @file sistema.backup.consultar.bin.php
* @name sistema.backup.consultar
* @desc
*   Consulta um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-03  v. 0.0.0
*
*/

/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])){

/* Realiza a consulta no sistema */
  $tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
  $tmpTBLBackup =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_BACKUP'];
  $tmpTBLBackupUsuarios =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_USUARIO'];
  $BACKUP_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],$tmpDBConfig['USERNAME'],$tmpDBConfig['PASSWORD'],$tmpDBConfig['DATABASENAME'],$tmpDBConfig['TIPODB']);
    $tmpBackupCodigo =  $_REQUEST['txtChaveRegistro'];
  
    $tmpSQLConsultar = "select Backups.*, Usuario.NOME_EXIBIR USUARIO_NOME
    FROM  $tmpTBLBackup as Backups
    Left join
        $tmpTBLBackupUsuarios as Usuario on (Usuario.codigo = Backups.usuario)
      where
        Backups.codigo = '".$tmpBackupCodigo."'";
  
    $BACKUP_->Query($tmpSQLConsultar);
    $BackupDados = $BACKUP_->ResultConsult();
  unset($BACKUP_);
  
  require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.incluir.layout.php");
}

?>