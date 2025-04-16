<?php
/**
 * 📄 local.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

$LOCAL_ = new Local($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_LOCAL_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_LOCAL_') === false) ? false : $tmpDados[str_replace('TXT_LOCAL_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $LOCAL_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $LOCAL_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $LOCAL_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $LOCAL_->getSISTEMA();
}

unset($LOCAL_);

require $this->SISTEMA_['LAYOUT'] . "local/local.alterar.layout.php";
