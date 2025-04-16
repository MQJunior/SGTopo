<?php
/**
 * 📄 tipodocumento.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
    $TIPODOCUMENTO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $TIPODOCUMENTO_->getSISTEMA();
    unset($TIPODOCUMENTO_);

}
require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.pesquisar.layout.php";
