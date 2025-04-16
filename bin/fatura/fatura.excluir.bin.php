<?php
/**
 * 📄 fatura.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $FATURA_ = new Fatura($this->SISTEMA_);
    $FATURA_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $FATURA_->getSISTEMA();
    unset($FATURA_);

}
require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.pesquisar.layout.php";
