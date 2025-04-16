<?php
/**
 * 📄 solicitante.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $SOLICITANTE_ = new Solicitante($this->SISTEMA_);
     $SOLICITANTE_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$SOLICITANTE_->getSISTEMA();
    unset($SOLICITANTE_);
    
    require($this->SISTEMA_['LAYOUT']."solicitante/solicitante.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."solicitante/solicitante.incluir.layout.php");
  }
  