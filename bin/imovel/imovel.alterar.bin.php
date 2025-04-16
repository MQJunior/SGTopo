<?php
/**
 * 📄 imovel.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

$IMOVEL_ = new Imovel($this->SISTEMA_);
/* Caso seja capturado a chave do registro e nome  */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_IMOVEL_NOME']))) {

    /* Captura os dados do formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_IMOVEL_') === false) ? false : $tmpDados[str_replace('TXT_IMOVEL_', '', $tmpChave)] = utf8_decode($tmpValor);

    //(isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';   //EXEMPLO DE COMO TRABALHAR COM ESCOLHA
    /* Realiza a alteração do registro */
    $IMOVEL_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $IMOVEL_->getSISTEMA();
} else {
    /* Realiza a consulta do registro para ser alterado */
    $IMOVEL_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $IMOVEL_->getSISTEMA();
}

unset($IMOVEL_);

require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.alterar.layout.php";
