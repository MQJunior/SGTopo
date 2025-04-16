<?php
/**
 * 📄 os.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_OS_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_OS_')===false)?false:$tmpDados[str_replace('TXT_OS_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $OS_ = new Os($this->SISTEMA_);
     $OS_->Incluir($tmpDados);
     $this->SISTEMA_ =$OS_->getSISTEMA();
    unset($OS_);
    
    require($this->SISTEMA_['LAYOUT']."os/os.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."os/os.incluir.layout.php");
  }
  