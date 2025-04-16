<?php
/**
 * 📄 fatura.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $FATURA_ = new Fatura($this->SISTEMA_);
    $FATURA_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $FATURA_->getSISTEMA();
    unset($FATURA_);

    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.incluir.layout.php";
}
