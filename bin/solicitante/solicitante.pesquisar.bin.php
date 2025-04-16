<?php
/**
 * 📄 solicitante.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: solicitante | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$SOLICITANTE_ = new Solicitante($this->SISTEMA_);
(isset($_REQUEST['TXT_SOLICITANTE_PESQUISAR'])) ? $SOLICITANTE_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_SOLICITANTE_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_SOLICITANTE_PESQUISAR']) : $SOLICITANTE_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $SOLICITANTE_->getSISTEMA();
unset($SOLICITANTE_);

if (isset($_REQUEST['TXT_SOLICITANTE_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "solicitante/solicitante.pesquisar.layout.php";
}
// Layout Completo
