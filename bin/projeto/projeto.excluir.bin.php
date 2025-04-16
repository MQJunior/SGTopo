<?php
/**
 * 📄 projeto.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $PROJETO_ = new Projeto($this->SISTEMA_);
    $PROJETO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
    unset($PROJETO_);

}
require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.pesquisar.layout.php";
