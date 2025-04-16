<?php
/**
 * 📄 pessoa.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $PESSOA_ = new Pessoa($this->SISTEMA_);
    $PESSOA_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PESSOA_->getSISTEMA();
    unset($PESSOA_);

}
require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.pesquisar.layout.php";
