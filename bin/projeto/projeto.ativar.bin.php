<?php
/**
 * 📄 projeto.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])){

  /* Realiza a ativação do sistema */
    $PROJETO_ = new Projeto($this->SISTEMA_);
     $PROJETO_->Ativar($_REQUEST['txtChaveRegistro']);
     $this->SISTEMA_ =$PROJETO_->getSISTEMA();
    unset($PROJETO_);
    
    require($this->SISTEMA_['LAYOUT']."projeto/projeto.consultar.layout.php");
  }else{
    require($this->SISTEMA_['LAYOUT']."projeto/projeto.incluir.layout.php");
  }
  