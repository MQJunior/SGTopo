<?php
/**
 * 📄 arquivos.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

$ARQUIVOS_ = new Arquivos($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_ARQUIVOS_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_ARQUIVOS_') === false) ? false : $tmpDados[str_replace('TXT_ARQUIVOS_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $ARQUIVOS_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $ARQUIVOS_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
}

unset($ARQUIVOS_);

require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.alterar.layout.php";
