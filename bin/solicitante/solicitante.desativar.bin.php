<?php
/**
 * 📄 solicitante.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $SOLICITANTE_ = new Solicitante($this->SISTEMA_);
    $SOLICITANTE_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
    unset($SOLICITANTE_);

    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.listar.layout.php";
}
