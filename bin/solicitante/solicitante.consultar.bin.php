<?php
/**
 * 📄 solicitante.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $SOLICITANTE_ = new Solicitante($this->SISTEMA_);
    $SOLICITANTE_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
    unset($SOLICITANTE_);

    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.incluir.layout.php";
}
