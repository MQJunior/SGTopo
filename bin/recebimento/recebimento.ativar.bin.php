<?php
/**
 * 📄 recebimento.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
     $RECEBIMENTO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$RECEBIMENTO_->getSISTEMA();
    unset($RECEBIMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."recebimento/recebimento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."recebimento/recebimento.incluir.layout.php");
  }
  