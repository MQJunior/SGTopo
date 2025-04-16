<?php
/**
 * 📄 servico.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $SERVICO_ = new Servico($this->SISTEMA_);
     $SERVICO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$SERVICO_->getSISTEMA();
    unset($SERVICO_);
    
    require($this->SISTEMA_['LAYOUT']."servico/servico.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."servico/servico.incluir.layout.php");
  }
  