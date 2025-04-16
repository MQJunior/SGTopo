<?php
/**
 * 📄 projeto.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $PROJETO_ = new Projeto($this->SISTEMA_);
    $PROJETO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
    unset($PROJETO_);

    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.incluir.layout.php";
}
