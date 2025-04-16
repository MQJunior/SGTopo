<?php
/**
 * 📄 projeto.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_PROJETO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_PROJETO_')===false)?false:$tmpDados[str_replace('TXT_PROJETO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $PROJETO_ = new Projeto($this->SISTEMA_);
     $PROJETO_->Incluir($tmpDados);
     $this->SISTEMA_ =$PROJETO_->getSISTEMA();
    unset($PROJETO_);
    
    require($this->SISTEMA_['LAYOUT']."projeto/projeto.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."projeto/projeto.incluir.layout.php");
  }
  