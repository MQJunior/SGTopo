<?php
/**
 * 📄 documento.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

$DOCUMENTO_ = new Documento($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_DOCUMENTO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_DOCUMENTO_') === false) ? false : $tmpDados[str_replace('TXT_DOCUMENTO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $DOCUMENTO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $DOCUMENTO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $DOCUMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $DOCUMENTO_->getSISTEMA();
}

unset($DOCUMENTO_);

require $this->SISTEMA_['LAYOUT'] . "documento/documento.alterar.layout.php";
