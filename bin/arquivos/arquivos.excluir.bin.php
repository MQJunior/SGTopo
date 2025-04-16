<?php
/**
 * 📄 arquivos.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $ARQUIVOS_ = new Arquivos($this->SISTEMA_);
    $ARQUIVOS_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
    unset($ARQUIVOS_);

}
require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.pesquisar.layout.php";
