<?php
/**
 * 📄 padrao.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $PADRAO_ = new Padrao($this->SISTEMA_);
    $PADRAO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PADRAO_->getSISTEMA();
    unset($PADRAO_);

    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.incluir.layout.php";
}
