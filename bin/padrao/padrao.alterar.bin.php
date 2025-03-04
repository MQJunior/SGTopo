<?php
/**
* @file padrao.alterar.bin.php
* @name padrao.alterar
* @desc
*   Altera um registro no sistema
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

$PADRAO_ = new Padrao($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_PADRAO_NOME']))){
  
  /* Captura os dados do formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_PADRAO_')===false)?false:$tmpDados[str_replace('TXT_PADRAO_','',$tmpChave)]= utf8_decode($tmpValor);
    
  (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';
  /* Realiza a alteração do registro */
  $PADRAO_->Alterar($tmpDados,$_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ =$PADRAO_->getSISTEMA();
}else{
  /* Realiza a consulta do registro para ser alterado */
  $PADRAO_->Consultar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ =$PADRAO_->getSISTEMA();
}

unset($PADRAO_);

require($this->SISTEMA_['LAYOUT']."padrao/padrao.alterar.layout.php");

?>