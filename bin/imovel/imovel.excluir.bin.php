<?php
/**
 * 📄 imovel.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $IMOVEL_ = new Imovel($this->SISTEMA_);
    $IMOVEL_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $IMOVEL_->getSISTEMA();
    unset($IMOVEL_);

}
require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.pesquisar.layout.php";
