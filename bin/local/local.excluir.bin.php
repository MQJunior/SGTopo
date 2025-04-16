<?php
/**
 * 📄 local.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $LOCAL_ = new Local($this->SISTEMA_);
    $LOCAL_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $LOCAL_->getSISTEMA();
    unset($LOCAL_);

}
require $this->SISTEMA_['LAYOUT'] . "local/local.pesquisar.layout.php";
