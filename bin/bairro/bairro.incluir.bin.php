<?php
/**
 * 📄 bairro.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_BAIRRO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_BAIRRO_')===false)?false:$tmpDados[str_replace('TXT_BAIRRO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $BAIRRO_ = new Bairro($this->SISTEMA_);
     $BAIRRO_->Incluir($tmpDados);
     $this->SISTEMA_ =$BAIRRO_->getSISTEMA();
    unset($BAIRRO_);
    
    require($this->SISTEMA_['LAYOUT']."bairro/bairro.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."bairro/bairro.incluir.layout.php");
  }
  