<?php
/**
 * 📄 local.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_LOCAL_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_LOCAL_')===false)?false:$tmpDados[str_replace('TXT_LOCAL_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $LOCAL_ = new Local($this->SISTEMA_);
     $LOCAL_->Incluir($tmpDados);
     $this->SISTEMA_ =$LOCAL_->getSISTEMA();
    unset($LOCAL_);
    
    require($this->SISTEMA_['LAYOUT']."local/local.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."local/local.incluir.layout.php");
  }
  