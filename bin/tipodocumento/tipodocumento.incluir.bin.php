<?php
/**
 * 📄 tipodocumento.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_TIPODOCUMENTO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_TIPODOCUMENTO_')===false)?false:$tmpDados[str_replace('TXT_TIPODOCUMENTO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
     $TIPODOCUMENTO_->Incluir($tmpDados);
     $this->SISTEMA_ =$TIPODOCUMENTO_->getSISTEMA();
    unset($TIPODOCUMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."tipodocumento/tipodocumento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."tipodocumento/tipodocumento.incluir.layout.php");
  }
  