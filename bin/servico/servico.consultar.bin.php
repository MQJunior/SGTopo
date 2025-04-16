<?php
/**
 * 📄 servico.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $SERVICO_ = new Servico($this->SISTEMA_);
    $SERVICO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SERVICO_->getSISTEMA();
    unset($SERVICO_);

    require $this->SISTEMA_['LAYOUT'] . "servico/servico.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "servico/servico.incluir.layout.php";
}
