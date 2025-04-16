<?php
/**
 * 📄 agendamento.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.listar.layout.php";
}
