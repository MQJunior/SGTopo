<?php
/**
 * 📄 bairro.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$BAIRRO_ = new Bairro($this->SISTEMA_);
(isset($_REQUEST['TXT_BAIRRO_PESQUISAR'])) ? $BAIRRO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_BAIRRO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_BAIRRO_PESQUISAR']) : $BAIRRO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $BAIRRO_->getSISTEMA();
unset($BAIRRO_);

if (isset($_REQUEST['TXT_BAIRRO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "bairro/bairro.pesquisar.layout.php";
}
// Layout Completo
