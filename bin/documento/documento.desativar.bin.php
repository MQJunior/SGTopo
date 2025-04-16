<?php
/**
 * 📄 documento.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $DOCUMENTO_ = new Documento($this->SISTEMA_);
    $DOCUMENTO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $DOCUMENTO_->getSISTEMA();
    unset($DOCUMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "documento/documento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "documento/documento.listar.layout.php";
}
