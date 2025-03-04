<?php
/**
 * 📄 padrao.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

// 📝 Captura de Dados
$tmpRegInativos = isset($_REQUEST['TXT_REGISTROS_INATIVOS']) ? $_REQUEST['TXT_REGISTROS_INATIVOS'] : false;

// 🔍 Pesquisa no Banco de Dados
$PADRAO_ = new Padrao($this->SISTEMA_);
if (isset($_REQUEST['TXT_PADRAO_PESQUISAR'])) {
  $PADRAO_->Pesquisar(
    $_REQUEST['TXT_PESQUISA_CAMPO'],
    utf8_decode($_REQUEST['TXT_PADRAO_PESQUISAR']),
    $tmpRegInativos,
    $_REQUEST['TXT_PADRAO_PESQUISAR']
  );
} else {
  $PADRAO_->PesquisarNome(null, null, false, 20);
}

$this->SISTEMA_ = $PADRAO_->getSISTEMA();
unset($PADRAO_);

// 📦 Exibição do Layout
require(
  isset($_REQUEST['TXT_PADRAO_PESQUISAR']) ?
  $this->SISTEMA_['LAYOUT'] . "padrao/padrao.pesquisa.layout.php" :  // Layout Resumido
  $this->SISTEMA_['LAYOUT'] . "padrao/padrao.pesquisar.layout.php"   // Layout Completo
);
?>
