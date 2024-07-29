<?php
/**
* @file scripts.incluir.bin.php
* @name scripts.incluir
* @desc
*   Realiza a inclusão do registro no sistema
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

if (isset($_REQUEST['TXT_SCRIPTS_NOME'])){

/* Captura os campos enviados pelo formulário */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_SCRIPTS_')===false)?false:$tmpDados[str_replace('TXT_SCRIPTS_','',$tmpChave)]= utf8_decode($tmpValor);

  // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
    /* Realiza a inclusão */
  $SCRIPTS_ = new Scripts($this->SISTEMA_);
   $SCRIPTS_->Incluir($tmpDados);
   $this->SISTEMA_ =$SCRIPTS_->getSISTEMA();
  unset($SCRIPTS_);
  
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."scripts/scripts.incluir.layout.php");
}

?>