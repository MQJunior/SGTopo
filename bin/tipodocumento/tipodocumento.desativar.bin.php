<?php
/**
 * 📄 tipodocumento.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
    $TIPODOCUMENTO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $TIPODOCUMENTO_->getSISTEMA();
    unset($TIPODOCUMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.listar.layout.php";
}
