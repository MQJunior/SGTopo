<?php
/**
 * 📄 cidade.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_CIDADE_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_CIDADE_')===false)?false:$tmpDados[str_replace('TXT_CIDADE_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $CIDADE_ = new Cidade($this->SISTEMA_);
     $CIDADE_->Incluir($tmpDados);
     $this->SISTEMA_ =$CIDADE_->getSISTEMA();
    unset($CIDADE_);
    
    require($this->SISTEMA_['LAYOUT']."cidade/cidade.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."cidade/cidade.incluir.layout.php");
  }
  