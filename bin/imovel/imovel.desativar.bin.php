<?php
/**
 * 📄 imovel.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $IMOVEL_ = new Imovel($this->SISTEMA_);
    $IMOVEL_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $IMOVEL_->getSISTEMA();
    unset($IMOVEL_);

    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.listar.layout.php";
}
