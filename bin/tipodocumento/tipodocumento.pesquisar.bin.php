<?php
/**
 * 📄 tipodocumento.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$TIPODOCUMENTO_ = new Tipodocumento($this->SISTEMA_);
(isset($_REQUEST['TXT_TIPODOCUMENTO_PESQUISAR'])) ? $TIPODOCUMENTO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_TIPODOCUMENTO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_TIPODOCUMENTO_PESQUISAR']) : $TIPODOCUMENTO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $TIPODOCUMENTO_->getSISTEMA();
unset($TIPODOCUMENTO_);

if (isset($_REQUEST['TXT_TIPODOCUMENTO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "tipodocumento/tipodocumento.pesquisar.layout.php";
}
// Layout Completo
