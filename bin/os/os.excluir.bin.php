<?php
/**
 * 📄 os.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $OS_ = new Os($this->SISTEMA_);
    $OS_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $OS_->getSISTEMA();
    unset($OS_);

}
require $this->SISTEMA_['LAYOUT'] . "os/os.pesquisar.layout.php";
