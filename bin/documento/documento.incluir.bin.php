<?php
/**
 * 📄 documento.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_DOCUMENTO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_DOCUMENTO_')===false)?false:$tmpDados[str_replace('TXT_DOCUMENTO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $DOCUMENTO_ = new Documento($this->SISTEMA_);
     $DOCUMENTO_->Incluir($tmpDados);
     $this->SISTEMA_ =$DOCUMENTO_->getSISTEMA();
    unset($DOCUMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."documento/documento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."documento/documento.incluir.layout.php");
  }
  