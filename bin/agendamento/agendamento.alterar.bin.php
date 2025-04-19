<?php
/**
 * 📄 agendamento.alterar.bin.php - Altera um registro no sistema
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-09 | 🏷️ v0.0.1
 */

$AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_AGENDAMENTO_DATA']))) {

    $AGENDAMENTO_->Alterar($_REQUEST['txtChaveRegistro'],
        $_REQUEST['TXT_AGENDAMENTO_DATA'],
        $_REQUEST['TXT_AGENDAMENTO_HORA'],
        $_REQUEST['TXT_AGENDAMENTO_ENDERECO'],
        $_REQUEST['TXT_AGENDAMENTO_DESCRICAO'],
        $_REQUEST['TXT_AGENDAMENTO_CONTATO'],
        $_REQUEST['TXT_AGENDAMENTO_LOCAL'],
        $_REQUEST['TXT_AGENDAMENTO_OBSERVACOES']
    );

    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $AGENDAMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
}

unset($AGENDAMENTO_);

require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.alterar.layout.php";
