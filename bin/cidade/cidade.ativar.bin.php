<?php
/**
 * 📄 cidade.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $CIDADE_ = new Cidade($this->SISTEMA_);
     $CIDADE_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$CIDADE_->getSISTEMA();
    unset($CIDADE_);
    
    require($this->SISTEMA_['LAYOUT']."cidade/cidade.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."cidade/cidade.incluir.layout.php");
  }
  