<?php
/**
 * 📄 local.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $LOCAL_ = new Local($this->SISTEMA_);
    $LOCAL_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $LOCAL_->getSISTEMA();
    unset($LOCAL_);

    require $this->SISTEMA_['LAYOUT'] . "local/local.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "local/local.listar.layout.php";
}
