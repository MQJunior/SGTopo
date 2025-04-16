<?php
/**
 * 📄 pessoa.desativar.bin.php - Desativa um registro
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */

/* Captura a Chave do Registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a desativação do registro */
    $PESSOA_ = new Pessoa($this->SISTEMA_);
    $PESSOA_->Desativar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PESSOA_->getSISTEMA();
    unset($PESSOA_);

    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.listar.layout.php";
}
