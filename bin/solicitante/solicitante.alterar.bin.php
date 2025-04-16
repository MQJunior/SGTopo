<?php
/**
 * 📄 solicitante.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

$SOLICITANTE_ = new Solicitante($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_SOLICITANTE_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_SOLICITANTE_') === false) ? false : $tmpDados[str_replace('TXT_SOLICITANTE_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $SOLICITANTE_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $SOLICITANTE_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
}

unset($SOLICITANTE_);

require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.alterar.layout.php";
