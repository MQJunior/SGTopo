<?php
/**
* @file sistema.backup.incluir.bin.php
* @name sistema.backup.incluir
* @desc
*   Realiza a inclusão do registro no sistema
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

if (isset($_REQUEST['TXT_BACKUP_NOME'])){

/* Captura os campos enviados pelo formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_BACKUP_')===false)?false:$tmpDados[str_replace('TXT_BACKUP_','',$tmpChave)]= utf8_decode($tmpValor);

  (isset($tmpDados['COMPACTAR']))?$tmpDados['COMPACTAR']='S':$tmpDados['COMPACTAR']='N';  //  TRABALHO COM ESCOLHA

  
  
/* Realiza a inclusão */
$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
$tmpTBLBackup =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_BACKUP'];
$tmpTBLBackupUsuarios =$this->SISTEMA_['ENTIDADE']['SISTEMA']['CONF']['DATABASE']['TBL_USUARIO'];
$BACKUP_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],$tmpDBConfig['USERNAME'],$tmpDBConfig['PASSWORD'],$tmpDBConfig['DATABASENAME'],$tmpDBConfig['TIPODB']);
  $BACKUP_->Data=array();
  $BACKUP_->Data =$tmpDados;
  $BACKUP_->Data['USUARIO'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  $BACKUP_->Data['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
  $BACKUP_->Data['DATACRIACAO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
  $BACKUP_->Data['REG_ATIVO'] = '1';
  $BACKUP_->Insert($tmpTBLBackup);
  
  $tmpBackupCodigo = $BACKUP_->Id();
  
  $tmpSQLConsultar = "select Backups.*, Usuario.NOME_EXIBIR USUARIO_NOME
    FROM  $tmpTBLBackup as Backups
    Left join
        $tmpTBLBackupUsuarios as Usuario on (Usuario.codigo = Backups.usuario)
      where
        Backups.codigo = '".$tmpBackupCodigo."'";
  
  $BACKUP_->Query($tmpSQLConsultar);
  $BackupDados = $BACKUP_->ResultConsult();
  
unset($BACKUP_);
  $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['TITULO'];
  $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['MENSAGEM'];
  
  require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."sistema/sistema.backup.incluir.layout.php");
}

?>