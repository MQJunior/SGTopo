<?php
/**
 * 📄 servico.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $SERVICO_ = new Servico($this->SISTEMA_);
    $SERVICO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SERVICO_->getSISTEMA();
    unset($SERVICO_);

    require $this->SISTEMA_['LAYOUT'] . "servico/servico.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "servico/servico.listar.layout.php";
}
