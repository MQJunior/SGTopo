<?php
/**
 * 📄 arquivos.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $ARQUIVOS_ = new Arquivos($this->SISTEMA_);
    $ARQUIVOS_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
    unset($ARQUIVOS_);

    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.incluir.layout.php";
}
