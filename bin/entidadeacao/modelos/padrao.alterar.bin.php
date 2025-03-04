<?php
/**
 * 📄 padrao.alterar.bin.php - Altera um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

$PADRAO_ = new Padrao($this->SISTEMA_);
/** 🔄 Altera registro se existir chave e nome */
if ((isset($_REQUEST['txtChaveRegistro'])) && (isset($_REQUEST['TXT_PADRAO_NOME']))) {
  
  /** 🗂️ Captura dados do formulário */
  foreach ($_REQUEST as $tmpChave => $tmpValor)
    (strpos($tmpChave, 'TXT_PADRAO_') === false) ? false : $tmpDados[str_replace('TXT_PADRAO_', '', $tmpChave)] = utf8_decode($tmpValor);
    
  /** 🔄 Altera o registro */
  $PADRAO_->Alterar($tmpDados, $_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ = $PADRAO_->getSISTEMA();
} else {
  /** 🔍 Consulta o registro para ser alterado */
  $PADRAO_->Consultar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ = $PADRAO_->getSISTEMA();
}

unset($PADRAO_);

/** 📄 Requer layout específico */
require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.alterar.layout.php");

?>
