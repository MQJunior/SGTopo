<?php
/**
 * 📄 fatura.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_FATURA_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_FATURA_')===false)?false:$tmpDados[str_replace('TXT_FATURA_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $FATURA_ = new Fatura($this->SISTEMA_);
     $FATURA_->Incluir($tmpDados);
     $this->SISTEMA_ =$FATURA_->getSISTEMA();
    unset($FATURA_);
    
    require($this->SISTEMA_['LAYOUT']."fatura/fatura.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."fatura/fatura.incluir.layout.php");
  }
  