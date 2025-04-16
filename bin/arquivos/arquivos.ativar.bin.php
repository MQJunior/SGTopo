<?php
/**
 * 📄 arquivos.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $ARQUIVOS_ = new Arquivos($this->SISTEMA_);
     $ARQUIVOS_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$ARQUIVOS_->getSISTEMA();
    unset($ARQUIVOS_);
    
    require($this->SISTEMA_['LAYOUT']."arquivos/arquivos.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."arquivos/arquivos.incluir.layout.php");
  }
  