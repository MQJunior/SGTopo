<?php
/**
 * 📄 servico.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

 if (isset($_REQUEST['TXT_SERVICO_NOME'])){

  /* Captura os campos enviados pelo formulário */
    foreach($_REQUEST as $tmpChave => $tmpValor)
      (strpos($tmpChave,'TXT_SERVICO_')===false)?false:$tmpDados[str_replace('TXT_SERVICO_','',$tmpChave)]= utf8_decode($tmpValor);
  
    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
      /* Realiza a inclusão */
    $SERVICO_ = new Servico($this->SISTEMA_);
     $SERVICO_->Incluir($tmpDados);
     $this->SISTEMA_ =$SERVICO_->getSISTEMA();
    unset($SERVICO_);
    
    require($this->SISTEMA_['LAYOUT']."servico/servico.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."servico/servico.incluir.layout.php");
  }
  