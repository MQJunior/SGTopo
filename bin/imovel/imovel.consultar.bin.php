<?php
/**
 * 📄 imovel.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $IMOVEL_ = new Imovel($this->SISTEMA_);
    $IMOVEL_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $IMOVEL_->getSISTEMA();
    unset($IMOVEL_);

    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.incluir.layout.php";
}
