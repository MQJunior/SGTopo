<?php
/**
 * 📄 local.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $LOCAL_ = new Local($this->SISTEMA_);
    $LOCAL_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $LOCAL_->getSISTEMA();
    unset($LOCAL_);

    require $this->SISTEMA_['LAYOUT'] . "local/local.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "local/local.incluir.layout.php";
}
