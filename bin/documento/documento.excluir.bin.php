<?php
/**
 * 📄 documento.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $DOCUMENTO_ = new Documento($this->SISTEMA_);
    $DOCUMENTO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $DOCUMENTO_->getSISTEMA();
    unset($DOCUMENTO_);

}
require $this->SISTEMA_['LAYOUT'] . "documento/documento.pesquisar.layout.php";
