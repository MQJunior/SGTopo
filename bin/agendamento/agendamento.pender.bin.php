<?php
/**
 * 📄 agendamento.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-10 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */

/* Captura a chave do registro a ser ativada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a ativação do sistema */
    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Pender($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.incluir.layout.php";
}
