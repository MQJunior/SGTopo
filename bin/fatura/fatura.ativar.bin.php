<?php
/**
 * 📄 fatura.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $FATURA_ = new Fatura($this->SISTEMA_);
     $FATURA_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$FATURA_->getSISTEMA();
    unset($FATURA_);
    
    require($this->SISTEMA_['LAYOUT']."fatura/fatura.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."fatura/fatura.incluir.layout.php");
  }
  