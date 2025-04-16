<?php
/**
 * 📄 fatura.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$FATURA_ = new Fatura($this->SISTEMA_);
(isset($_REQUEST['TXT_FATURA_PESQUISAR'])) ? $FATURA_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_FATURA_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_FATURA_PESQUISAR']) : $FATURA_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $FATURA_->getSISTEMA();
unset($FATURA_);

if (isset($_REQUEST['TXT_FATURA_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "fatura/fatura.pesquisar.layout.php";
}
// Layout Completo
