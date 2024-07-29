<?php
/**
* @file sistema.backup.executar.bin.php
* @name sistema.backup.executar
* @desc
*   Executa um backup do sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-12  v. 0.0.0
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
  
    $tmpSQLConsultar = "select Backups.*
    FROM  $tmpTBLBackup as Backups
      where
        Backups.codigo = '".$tmpBackupCodigo."'";
  
    $BACKUP_->Query($tmpSQLConsultar);
    $BackupDados = $BACKUP_->ResultConsult();
  unset($BACKUP_);
  
  $BackupDados = $BackupDados[0];
  //$BackupDados['NOME'];
  //$BackupDados['TIPO'];  {1-Arquivo; 2-Firebird; 3-MySQL}
  //$BackupDados['ORIGEM'];
  //$BackupDados['DESTINO'];
  //$BackupDados['DATABASENAME'];
  //$BackupDados['USUARIO_DB'];
  //$BackupDados['SENHA_DB'];
  //$BackupDados['COMPACTAR'];
  //$BackupDados['PARAMETROS'];
  
  //sshpass -p 'wsx852357' scp SGPadrao.zip sistema@mqjrserver:/sistema/backup

  $hostname = strstr($BackupDados['DESTINO'],'@');
  $hostname = strstr($hostname,':',true);
  $hostname = substr($hostname,1);
  $username = strstr($BackupDados['DESTINO'],'@',true);
  $targetFile = strstr($BackupDados['DESTINO'],':');
  $targetFile = substr($targetFile,1);
  
  // Script para arquivo //
  if ($BackupDados['TIPO']==1){
    $comando_compactar = 'zip -r '.$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip '.$BackupDados['ORIGEM'];
    $tmpSaida = exec($comando_compactar);
    
    $connection = ssh2_connect($hostname); 
    ssh2_auth_password($connection, $username, $BackupDados['PARAMETROS']) ;
    ssh2_scp_send($connection, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip', $targetFile.'/'.$BackupDados['NOME'].'.zip', 0777);
    
    unlink($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip');

    //echo $tmpSaida;

  }
  // Script para Banco de Dados - Firebird //
  if ($BackupDados['TIPO']==2){
    $comando_backup = 'gbak -b -t -user '.$BackupDados['USUARIO_DB'].' -password '.$BackupDados['SENHA_DB'].' '.$BackupDados['ORIGEM'].' '.$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.fbk';
    $tmpSaida = exec($comando_backup);

    //echo $comando_backup;
    
    $comando_compactar = 'zip -r -m '.$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip '.$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.fbk';
    $tmpSaida = exec($comando_compactar);
    
    $connection = ssh2_connect($hostname); 
    ssh2_auth_password($connection, $username, $BackupDados['PARAMETROS']) ;
    ssh2_scp_send($connection, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip', $targetFile.'/'.$BackupDados['NOME'].'.zip', 0777);
    
    unlink($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['TMP'].$BackupDados['NOME'].'.zip');

    //echo $tmpSaida;

  }
  
  //require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.incluir.layout.php");
}

?>