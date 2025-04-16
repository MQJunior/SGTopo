<?php
/**
 * 📄 bairro.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $BAIRRO_ = new Bairro($this->SISTEMA_);
    $BAIRRO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $BAIRRO_->getSISTEMA();
    unset($BAIRRO_);

}
require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.pesquisar.layout.php";
