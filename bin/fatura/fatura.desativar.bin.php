<?php
/**
 * 📄 fatura.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $FATURA_ = new Fatura($this->SISTEMA_);
    $FATURA_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $FATURA_->getSISTEMA();
    unset($FATURA_);

    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.listar.layout.php";
}
