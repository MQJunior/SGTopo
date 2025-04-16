<?php
/**
 * 📄 os.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

$OS_ = new Os($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_OS_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_OS_') === false) ? false : $tmpDados[str_replace('TXT_OS_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $OS_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $OS_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $OS_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $OS_->getSISTEMA();
}

unset($OS_);

require $this->SISTEMA_['LAYOUT'] . "os/os.alterar.layout.php";
