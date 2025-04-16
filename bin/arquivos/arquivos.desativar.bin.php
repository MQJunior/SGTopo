<?php
/**
 * 📄 arquivos.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $ARQUIVOS_ = new Arquivos($this->SISTEMA_);
    $ARQUIVOS_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
    unset($ARQUIVOS_);

    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.listar.layout.php";
}
