<?php
/**
 * 📄 tipodocumento.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
     $TIPODOCUMENTO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$TIPODOCUMENTO_->getSISTEMA();
    unset($TIPODOCUMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."tipodocumento/tipodocumento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."tipodocumento/tipodocumento.incluir.layout.php");
  }
  