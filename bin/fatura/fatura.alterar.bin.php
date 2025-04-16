<?php
/**
 * 📄 fatura.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

$FATURA_ = new Fatura($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_FATURA_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_FATURA_') === false) ? false : $tmpDados[str_replace('TXT_FATURA_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $FATURA_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $FATURA_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $FATURA_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $FATURA_->getSISTEMA();
}

unset($FATURA_);

require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.alterar.layout.php";
