<?php
/**
 * 📄 recebimento.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
    $RECEBIMENTO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $RECEBIMENTO_->getSISTEMA();
    unset($RECEBIMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.listar.layout.php";
}
