<?php
/**
 * 📄 solicitante.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_SOLICITANTE_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_SOLICITANTE_')===false)?false:$tmpDados[str_replace('TXT_SOLICITANTE_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $SOLICITANTE_ = new Solicitante($this->SISTEMA_);
     $SOLICITANTE_->Incluir($tmpDados);
     $this->SISTEMA_ =$SOLICITANTE_->getSISTEMA();
    unset($SOLICITANTE_);
    
    require($this->SISTEMA_['LAYOUT']."solicitante/solicitante.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."solicitante/solicitante.incluir.layout.php");
  }
  