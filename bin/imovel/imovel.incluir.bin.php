<?php
/**
 * 📄 imovel.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_IMOVEL_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_IMOVEL_')===false)?false:$tmpDados[str_replace('TXT_IMOVEL_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $IMOVEL_ = new Imovel($this->SISTEMA_);
     $IMOVEL_->Incluir($tmpDados);
     $this->SISTEMA_ =$IMOVEL_->getSISTEMA();
    unset($IMOVEL_);
    
    require($this->SISTEMA_['LAYOUT']."imovel/imovel.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."imovel/imovel.incluir.layout.php");
  }
  