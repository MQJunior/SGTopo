<?php
/**
 * 📄 projeto.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

$PROJETO_ = new Projeto($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_PROJETO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_PROJETO_') === false) ? false : $tmpDados[str_replace('TXT_PROJETO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $PROJETO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $PROJETO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
}

unset($PROJETO_);

require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.alterar.layout.php";
