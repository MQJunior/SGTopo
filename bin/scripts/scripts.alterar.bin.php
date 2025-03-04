<?php
/**
* @file scripts.alterar.bin.php
* @name scripts.alterar
* @desc
*   Altera um registro no sistema
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    scripts
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
*
*/

$SCRIPTS_ = new Scripts($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_SCRIPTS_NOME']))){
  
  /* Captura os dados do formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_SCRIPTS_')===false)?false:$tmpDados[str_replace('TXT_SCRIPTS_','',$tmpChave)]= utf8_decode($tmpValor);
    
  //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
  /* Realiza a alteração do registro */
  $SCRIPTS_->Alterar($tmpDados,$_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
}else{
  /* Realiza a consulta do registro para ser alterado */
  $SCRIPTS_->Consultar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
}

unset($SCRIPTS_);

require($this->SISTEMA_['LAYOUT']."scripts/scripts.alterar.layout.php");

?>