<?php
/**
 * 📄 os.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $OS_ = new Os($this->SISTEMA_);
     $OS_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$OS_->getSISTEMA();
    unset($OS_);
    
    require($this->SISTEMA_['LAYOUT']."os/os.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."os/os.incluir.layout.php");
  }
  