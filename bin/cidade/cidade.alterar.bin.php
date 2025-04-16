<?php
/**
 * 📄 cidade.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

$CIDADE_ = new Cidade($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_CIDADE_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_CIDADE_') === false) ? false : $tmpDados[str_replace('TXT_CIDADE_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $CIDADE_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $CIDADE_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $CIDADE_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $CIDADE_->getSISTEMA();
}

unset($CIDADE_);

require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.alterar.layout.php";
