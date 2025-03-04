<?php
/**
* @file tarefas.incluir.bin.php
* @name tarefas.incluir
* @desc
*   Realiza a inclusão do registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

if (isset($_REQUEST['TXT_TAREFAS_NOME'])){

/* Captura os campos enviados pelo formulário */

  $tmp_TXT_TAREFAS_REPETIR_SEMANA = "0000000";
  if (isset($_REQUEST['TXT_TAREFAS_REPETIR_SEMANA'])){
  
    $tmp_Repetir_Semana = array_values ($_REQUEST['TXT_TAREFAS_REPETIR_SEMANA']);
    for ($i=0; $i<=6; $i++){
      
      in_array($i,$tmp_Repetir_Semana)?$tmp_addDiaSemana = "1":$tmp_addDiaSemana = "0";
      $tmp_TXT_TAREFAS_REPETIR_SEMANA .= $tmp_addDiaSemana;
    }
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
  
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_TAREFAS_')===false)?false:$tmpDados[str_replace('TXT_TAREFAS_','',$tmpChave)]= utf8_decode($tmpValor);

  // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
    /* Realiza a inclusão */
  $TAREFAS_ = new Tarefas($this->SISTEMA_);
   $TAREFAS_->Incluir($tmpDados);
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);
  
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.consultar.layout.php");
}else{
  $TAREFAS_ = new Tarefas($this->SISTEMA_);
   $TAREFAS_->ListarEntidadeAcao();
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
   $TAREFAS_->ListarRegistrosEntidade($this->SISTEMA_['ENTIDADE']['TAREFAS']['ENTIDADEACAO']['DADOS'][0]['ENTIDADEACAO_CODIGO']);
   $this->SISTEMA_ =$TAREFAS_->getSISTEMA();
  unset($TAREFAS_);
    
  require($this->SISTEMA_['LAYOUT']."tarefas/tarefas.incluir.layout.php");
}

?>