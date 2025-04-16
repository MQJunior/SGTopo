<?php
/**
 * 📄 documento.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: documento | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$DOCUMENTO_ = new Documento($this->SISTEMA_);
(isset($_REQUEST['TXT_DOCUMENTO_PESQUISAR'])) ? $DOCUMENTO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_DOCUMENTO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_DOCUMENTO_PESQUISAR']) : $DOCUMENTO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $DOCUMENTO_->getSISTEMA();
unset($DOCUMENTO_);

if (isset($_REQUEST['TXT_DOCUMENTO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "documento/documento.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "documento/documento.pesquisar.layout.php";
}
// Layout Completo
