<?php
/**
 * 📄 agendamento.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.incluir.layout.php";
}
