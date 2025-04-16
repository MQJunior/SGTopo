<?php
/**
 * 📄 recebimento.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
    $RECEBIMENTO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $RECEBIMENTO_->getSISTEMA();
    unset($RECEBIMENTO_);

}
require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.pesquisar.layout.php";
