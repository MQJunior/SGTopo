<?php
/**
 * 📄 local.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$LOCAL_ = new Local($this->SISTEMA_);
(isset($_REQUEST['TXT_LOCAL_PESQUISAR'])) ? $LOCAL_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_LOCAL_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_LOCAL_PESQUISAR']) : $LOCAL_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $LOCAL_->getSISTEMA();
unset($LOCAL_);

if (isset($_REQUEST['TXT_LOCAL_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "local/local.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "local/local.pesquisar.layout.php";
}
// Layout Completo
