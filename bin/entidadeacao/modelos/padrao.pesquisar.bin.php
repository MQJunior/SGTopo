<?php
/**
 * 📄 padrao.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$PADRAO_ = new Padrao($this->SISTEMA_);
(isset($_REQUEST['TXT_PADRAO_PESQUISAR'])) ? $PADRAO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_PADRAO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_PADRAO_PESQUISAR']) : $PADRAO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $PADRAO_->getSISTEMA();
unset($PADRAO_);

if (isset($_REQUEST['TXT_PADRAO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "padrao/padrao.pesquisar.layout.php";
}
// Layout Completo
