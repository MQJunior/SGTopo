<?php
/**
* @file sistema.backup.alterar.bin.php
* @name sistema.backup.alterar
* @desc
*   Altera um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-05  v. 0.0.0
*
*/

$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
$tmpTBLBackup =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_BACKUP'];
$tmpTBLBackupUsuarios =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_USUARIO'];
$BACKUP_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],$tmpDBConfig['USERNAME'],$tmpDBConfig['PASSWORD'],$tmpDBConfig['DATABASENAME'],$tmpDBConfig['TIPODB']);

/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_BACKUP_NOME']))){
  $p_Codigo = $_REQUEST['txtChaveRegistro'];
  $tmpBackupCodigo = $p_Codigo;
  /* Captura os dados do formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_BACKUP_')===false)?false:$tmpDados[str_replace('TXT_BACKUP_','',$tmpChave)]= utf8_decode($tmpValor);
    
  //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
  /* Realiza a alteração do registro */
  
  $sql_Complemento =" codigo=".$p_Codigo;
    foreach($tmpDados as $tmpCampo => $tmpValor){
      if (($tmpValor=="null")||($tmpValor==null))
        $sql_Complemento.=", ".$tmpCampo." = null ";
      else
        $sql_Complemento.=", ".$tmpCampo." = '".$tmpValor."' ";
    }
    $sql_Alterar = "update $tmpTBLBackup set ".$sql_Complemento." where codigo='".$p_Codigo."'";
    $BACKUP_->Query($sql_Alterar);
  
  
  $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['TITULO'];
  $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['MENSAGEM'];
}
  /* Realiza a consulta do registro para ser alterado */
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

require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.alterar.layout.php");

?>