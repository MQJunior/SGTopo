<?php
/**
 * 📄 projeto.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $PROJETO_ = new Projeto($this->SISTEMA_);
    $PROJETO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
    unset($PROJETO_);

    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.listar.layout.php";
}
