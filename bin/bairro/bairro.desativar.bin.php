<?php
/**
 * 📄 bairro.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $BAIRRO_ = new Bairro($this->SISTEMA_);
    $BAIRRO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $BAIRRO_->getSISTEMA();
    unset($BAIRRO_);

    require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.listar.layout.php";
}
