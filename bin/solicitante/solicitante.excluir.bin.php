<?php
/**
 * 📄 solicitante.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $SOLICITANTE_ = new Solicitante($this->SISTEMA_);
    $SOLICITANTE_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
    unset($SOLICITANTE_);

}
require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.pesquisar.layout.php";
