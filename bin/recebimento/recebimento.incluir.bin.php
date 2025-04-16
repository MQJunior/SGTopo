<?php
/**
 * 📄 recebimento.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_RECEBIMENTO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_RECEBIMENTO_')===false)?false:$tmpDados[str_replace('TXT_RECEBIMENTO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
     $RECEBIMENTO_->Incluir($tmpDados);
     $this->SISTEMA_ =$RECEBIMENTO_->getSISTEMA();
    unset($RECEBIMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."recebimento/recebimento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."recebimento/recebimento.incluir.layout.php");
  }
  