<?php
/**
 * 📄 pessoa.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $PESSOA_ = new Pessoa($this->SISTEMA_);
    $PESSOA_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PESSOA_->getSISTEMA();
    unset($PESSOA_);

    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.incluir.layout.php";
}
