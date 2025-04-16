<?php
/**
 * 📄 tipodocumento.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

$TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_TIPODOCUMENTO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_TIPODOCUMENTO_') === false) ? false : $tmpDados[str_replace('TXT_TIPODOCUMENTO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $TIPODOCUMENTO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $TIPODOCUMENTO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $TIPODOCUMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $TIPODOCUMENTO_->getSISTEMA();
}

unset($TIPODOCUMENTO_);

require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.alterar.layout.php";
