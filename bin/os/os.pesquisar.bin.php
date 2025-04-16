<?php
/**
 * 📄 os.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$OS_ = new Os($this->SISTEMA_);
(isset($_REQUEST['TXT_OS_PESQUISAR'])) ? $OS_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_OS_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_OS_PESQUISAR']) : $OS_->Listar();
$this->SISTEMA_ = $OS_->getSISTEMA();
unset($OS_);

if (isset($_REQUEST['TXT_OS_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "os/os.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "os/os.pesquisar.layout.php";
}
// Layout Completo
