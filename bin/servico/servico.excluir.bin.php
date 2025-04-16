<?php
/**
 * 📄 servico.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $SERVICO_ = new Servico($this->SISTEMA_);
    $SERVICO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SERVICO_->getSISTEMA();
    unset($SERVICO_);

}
require $this->SISTEMA_['LAYOUT'] . "servico/servico.pesquisar.layout.php";
