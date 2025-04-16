<?php
/**
 * 📄 os.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $OS_ = new Os($this->SISTEMA_);
    $OS_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $OS_->getSISTEMA();
    unset($OS_);

    require $this->SISTEMA_['LAYOUT'] . "os/os.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "os/os.listar.layout.php";
}
