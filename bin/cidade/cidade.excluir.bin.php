<?php
/**
 * 📄 cidade.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $CIDADE_ = new Cidade($this->SISTEMA_);
    $CIDADE_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $CIDADE_->getSISTEMA();
    unset($CIDADE_);

}
require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.pesquisar.layout.php";
