<?php
/**
 * 📄 padrao.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $PADRAO_ = new Padrao($this->SISTEMA_);
    $PADRAO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PADRAO_->getSISTEMA();
    unset($PADRAO_);

}
require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.pesquisar.layout.php";
