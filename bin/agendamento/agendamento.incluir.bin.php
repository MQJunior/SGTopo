<?php
/**
 * 📄 agendamento.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */

//die(print_r($_REQUEST));
if (isset($_REQUEST['TXT_AGENDAMENTO_DATA'])) {

    /* Captura os campos enviados pelo formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_AGENDAMENTO_') === false) ? false : $tmpDados[str_replace('TXT_AGENDAMENTO_', '', $tmpChave)] = utf8_decode($tmpValor);

    // (isset($tmpDados['ESCOLHA']))?$tmpDados['ESCOLHA']='A':$tmpDados['ESCOLHA']='B';  //  TRABALHO COM ESCOLHA
    /* Realiza a inclusão */
    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Novo(
        $_REQUEST['TXT_AGENDAMENTO_DATA'],
        $_REQUEST['TXT_AGENDAMENTO_HORA'],
        $_REQUEST['TXT_AGENDAMENTO_ENDERECO'],
        $_REQUEST['TXT_AGENDAMENTO_DESCRICAO'],
        $_REQUEST['TXT_AGENDAMENTO_CONTATO'],
        $_REQUEST['TXT_AGENDAMENTO_LOCAL'],
        $_REQUEST['TXT_AGENDAMENTO_OBSERVACOES']
    );

    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
} else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.incluir.layout.php";
}
