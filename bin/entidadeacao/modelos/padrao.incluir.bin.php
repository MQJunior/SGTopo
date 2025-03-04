<?php
/**
 * 📄 padrao.incluir.bin.php - Realiza a inclusão do registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

// 📝 Captura os Campos do Formulário
if (isset($_REQUEST['TXT_PADRAO_NOME'])) {
  $tmpDados = [];
  foreach ($_REQUEST as $tmpChave => $tmpValor) {
    if (strpos($tmpChave, 'TXT_PADRAO_') !== false) {
      $tmpDados[str_replace('TXT_PADRAO_', '', $tmpChave)] = utf8_decode($tmpValor);
    }
  }

  // 🔄 Inclui o Registro
  $PADRAO_ = new Padrao($this->SISTEMA_);
  $PADRAO_->Incluir($tmpDados);
  $this->SISTEMA_ = $PADRAO_->getSISTEMA();
  unset($PADRAO_);

  // 📦 Exibe Layout de Consulta
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.consultar.layout.php");
} else {
  // 📦 Exibe Layout de Inclusão
  require($this->SISTEMA_['LAYOUT'] . "padrao/padrao.incluir.layout.php");
}
?>
