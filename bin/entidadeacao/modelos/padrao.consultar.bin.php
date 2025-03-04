<?php
/**
 * 📄 padrao.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

// 📝 Captura a Chave do Registro
if (isset($_REQUEST['txtChaveRegistro'])) {

  // 🔍 Realiza a Consulta
  $PADRAO_ = new Padrao($this->SISTEMA_);
  $PADRAO_->Consultar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ = $PADRAO_->getSISTEMA();
  unset($PADRAO_);

  // 📦 Exibe Layout de Consulta
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.consultar.layout.php");
} else {
  // 📦 Exibe Layout de Inclusão
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.incluir.layout.php");
}
?>
