<?php
/**
 * 📄 padrao.ativar.bin.php - Ativa um registro do sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

// 📝 Captura a Chave do Registro
if (isset($_REQUEST['txtChaveRegistro'])) {

  // 🔄 Ativa o Registro
  $PADRAO_ = new Padrao($this->SISTEMA_);
  $PADRAO_->Ativar($_REQUEST['txtChaveRegistro']);
  $this->SISTEMA_ = $PADRAO_->getSISTEMA();
  unset($PADRAO_);

  // 📦 Exibe Layout de Consulta
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.consultar.layout.php");
} else {
  // 📦 Exibe Layout de Inclusão
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.incluir.layout.php");
}
?>
