<?php
/**
 * 📄 cidade.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$CIDADE_ = new Cidade($this->SISTEMA_);
(isset($_REQUEST['TXT_CIDADE_PESQUISAR'])) ? $CIDADE_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_CIDADE_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_CIDADE_PESQUISAR']) : $CIDADE_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $CIDADE_->getSISTEMA();
unset($CIDADE_);

if (isset($_REQUEST['TXT_CIDADE_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "cidade/cidade.pesquisar.layout.php";
}
// Layout Completo
