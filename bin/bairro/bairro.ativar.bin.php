<?php
/**
 * 📄 bairro.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $BAIRRO_ = new Bairro($this->SISTEMA_);
     $BAIRRO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$BAIRRO_->getSISTEMA();
    unset($BAIRRO_);
    
    require($this->SISTEMA_['LAYOUT']."bairro/bairro.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."bairro/bairro.incluir.layout.php");
  }
  