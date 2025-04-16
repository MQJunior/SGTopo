<?php
/**
 * 📄 documento.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $DOCUMENTO_ = new Documento($this->SISTEMA_);
     $DOCUMENTO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$DOCUMENTO_->getSISTEMA();
    unset($DOCUMENTO_);
    
    require($this->SISTEMA_['LAYOUT']."documento/documento.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."documento/documento.incluir.layout.php");
  }
  