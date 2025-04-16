<?php
/**
 * 📄 local.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $LOCAL_ = new Local($this->SISTEMA_);
     $LOCAL_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$LOCAL_->getSISTEMA();
    unset($LOCAL_);
    
    require($this->SISTEMA_['LAYOUT']."local/local.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."local/local.incluir.layout.php");
  }
  