<?php
/**
 * 📄 servico.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

$SERVICO_ = new Servico($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_SERVICO_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_SERVICO_') === false) ? false : $tmpDados[str_replace('TXT_SERVICO_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $SERVICO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SERVICO_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $SERVICO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $SERVICO_->getSISTEMA();
}

unset($SERVICO_);

require $this->SISTEMA_['LAYOUT'] . "servico/servico.alterar.layout.php";
