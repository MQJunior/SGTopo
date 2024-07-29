<?php
/**
* @file padrao.incluir.bin.php
* @name padrao.incluir
* @desc
*   Realiza a inclus�o do registro no sistema
*
* @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright � 2006, M�rcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

if (isset($_REQUEST['TXT_PADRAO_NOME'])){

/* Captura os campos enviados pelo formul�rio */
  foreach($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave,'TXT_PADRAO_')===false)?false:$tmpDados[str_replace('TXT_PADRAO_','',$tmpChave)]= utf8_decode($tmpValor);

  // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
    /* Realiza a inclus�o */
  $PADRAO_ = new Padrao($this->SISTEMA_);
   $PADRAO_->Incluir($tmpDados);
   $this->SISTEMA_ =$PADRAO_->getSISTEMA();
  unset($PADRAO_);
  
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.consultar.layout.php");
}else{
  require($this->SISTEMA_['LAYOUT']."padrao/padrao.incluir.layout.php");
}

?>