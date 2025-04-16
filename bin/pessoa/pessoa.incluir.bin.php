<?php
/**
 * 📄 pessoa.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_PESSOA_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_PESSOA_')===false)?false:$tmpDados[str_replace('TXT_PESSOA_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $PESSOA_ = new Pessoa($this->SISTEMA_);
     $PESSOA_->Incluir($tmpDados);
     $this->SISTEMA_ =$PESSOA_->getSISTEMA();
    unset($PESSOA_);
    
    require($this->SISTEMA_['LAYOUT']."pessoa/pessoa.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."pessoa/pessoa.incluir.layout.php");
  }
  