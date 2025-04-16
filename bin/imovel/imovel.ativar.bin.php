<?php
/**
 * 📄 imovel.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $IMOVEL_ = new Imovel($this->SISTEMA_);
     $IMOVEL_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$IMOVEL_->getSISTEMA();
    unset($IMOVEL_);
    
    require($this->SISTEMA_['LAYOUT']."imovel/imovel.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."imovel/imovel.incluir.layout.php");
  }
  