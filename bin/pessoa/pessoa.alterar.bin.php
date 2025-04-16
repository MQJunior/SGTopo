<?php
/**
 * 📄 pessoa.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */

$PESSOA_ = new Pessoa($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_PESSOA_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_PESSOA_') === false) ? false : $tmpDados[str_replace('TXT_PESSOA_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $PESSOA_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PESSOA_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $PESSOA_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PESSOA_->getSISTEMA();
}

unset($PESSOA_);

require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.alterar.layout.php";
