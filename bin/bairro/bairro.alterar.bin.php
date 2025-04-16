<?php
/**
 * 📄 bairro.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

$BAIRRO_ = new Bairro($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_BAIRRO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_BAIRRO_') === false) ? false : $tmpDados[str_replace('TXT_BAIRRO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $BAIRRO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $BAIRRO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $BAIRRO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $BAIRRO_->getSISTEMA();
}

unset($BAIRRO_);

require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.alterar.layout.php";
