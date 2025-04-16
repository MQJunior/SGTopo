<?php
/**
 * 📄 cidade.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $CIDADE_ = new Cidade($this->SISTEMA_);
    $CIDADE_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $CIDADE_->getSISTEMA();
    unset($CIDADE_);

    require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.listar.layout.php";
}
