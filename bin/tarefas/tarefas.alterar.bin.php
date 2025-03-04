<?php
/**
* @file tarefas.alterar.bin.php
* @name tarefas.alterar
* @desc
*   Altera um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-07-15  v. 0.0.0
*
*/

$TAREFAS_ = new Tarefas($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_TAREFAS_NOME']))){
  
  /* Tratamento de dados para repetir durante a semana */
  $tmp_TXT_TAREFAS_REPETIR_SEMANA = "";
  $tmp_Repetir_Semana = array_values ($_REQUEST['TXT_TAREFAS_REPETIR_SEMANA']);
  for ($i=0; $i<=6; $i++){
    
    in_array($i,$tmp_Repetir_Semana)?$tmp_addDiaSemana = "1":$tmp_addDiaSemana = "0";
    $tmp_TXT_TAREFAS_REPETIR_SEMANA .= $tmp_addDiaSemana;
  }
  $_REQUEST['TXT_TAREFAS_REPETIR_SEMANA'] = $tmp_TXT_TAREFAS_REPETIR_SEMANA;
  
  /* Tratamento de Dados para Repetir a Cada */
  $_REQUEST['TXT_TAREFAS_REPETIR'] = $_REQUEST['TXT_TAREFAS_REPETIR_ANO'].'A'.$_REQUEST['TXT_TAREFAS_REPETIR_MES'].'M'.$_REQUEST['TXT_TAREFAS_REPETIR_DIAS'].'D'.$_REQUEST['TXT_TAREFAS_REPETIR_HORAS'].'H'.$_REQUEST['TXT_TAREFAS_REPETIR_MINUTOS'].'I';
  unset($_REQUEST['TXT_TAREFAS_REPETIR_ANO']);
  unset($_REQUEST['TXT_TAREFAS_REPETIR_MES']);
  unset($_REQUEST['TXT_TAREFAS_REPETIR_DIAS']);
  unset($_REQUEST['TXT_TAREFAS_REPETIR_HORAS']);
  unset($_REQUEST['TXT_TAREFAS_REPETIR_MINUTOS']);
  ($_REQUEST['TXT_TAREFAS_REPETIR']=='AMDHI')?$_REQUEST['TXT_TAREFAS_REPETIR']='':true;
  
  /* Captura os dados do formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_TAREFAS_')===false)?false:$tmpDados[str_replace('TXT_TAREFAS_','',$tmpChave)]= utf8_decode($tmpValor);
    
  //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
  /* Realiza a alteração do registro */
  $TAREFAS_->Alterar($tmpDados,$_REQUEST['txtChaveRegistro']);
  $TAREFAS_->ListarEntidadeAcao();
  $TAREFAS_->ListarRegistrosEntidade();
  $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
}else{
  /* Realiza a consulta do registro para ser alterado */
  $TAREFAS_->Consultar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ =$TAREFAS_->getSISTEMA();

  $TAREFAS_ = new Tarefas($this->SISTEMA_);
   $TAREFAS_->ListarEntidadeAcao();
   $TAREFAS_->ListarRegistrosEntidade();
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);
}

unset($TAREFAS_);

require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.alterar.layout.php");

?>