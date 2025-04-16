<?php
/**
 * 📄 padrao.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $PADRAO_ = new Padrao($this->SISTEMA_);
    $PADRAO_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PADRAO_->getSISTEMA();
    unset($PADRAO_);

    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.listar.layout.php";
}
