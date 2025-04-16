<?php
/**
 * 📄 imovel.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: imovel | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$IMOVEL_ = new Imovel($this->SISTEMA_);
(isset($_REQUEST['TXT_IMOVEL_PESQUISAR'])) ? $IMOVEL_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_IMOVEL_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_IMOVEL_PESQUISAR']) : $IMOVEL_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $IMOVEL_->getSISTEMA();
unset($IMOVEL_);

if (isset($_REQUEST['TXT_IMOVEL_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "imovel/imovel.pesquisar.layout.php";
}
// Layout Completo
