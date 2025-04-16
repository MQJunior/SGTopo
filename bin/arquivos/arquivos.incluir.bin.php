<?php
/**
 * 📄 arquivos.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_ARQUIVOS_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_ARQUIVOS_')===false)?false:$tmpDados[str_replace('TXT_ARQUIVOS_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $ARQUIVOS_ = new Arquivos($this->SISTEMA_);
     $ARQUIVOS_->Incluir($tmpDados);
     $this->SISTEMA_ =$ARQUIVOS_->getSISTEMA();
    unset($ARQUIVOS_);
    
    require($this->SISTEMA_['LAYOUT']."arquivos/arquivos.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."arquivos/arquivos.incluir.layout.php");
  }
  