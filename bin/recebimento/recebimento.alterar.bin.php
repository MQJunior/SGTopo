<?php
/**
 * 📄 recebimento.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

$RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_RECEBIMENTO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_RECEBIMENTO_') === false) ? false : $tmpDados[str_replace('TXT_RECEBIMENTO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $RECEBIMENTO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $RECEBIMENTO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $RECEBIMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $RECEBIMENTO_->getSISTEMA();
}

unset($RECEBIMENTO_);

require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.alterar.layout.php";
