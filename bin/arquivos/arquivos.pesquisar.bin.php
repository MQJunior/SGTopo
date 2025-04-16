<?php
/**
 * 📄 arquivos.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$ARQUIVOS_ = new Arquivos($this->SISTEMA_);
(isset($_REQUEST['TXT_ARQUIVOS_PESQUISAR'])) ? $ARQUIVOS_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_ARQUIVOS_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_ARQUIVOS_PESQUISAR']) : $ARQUIVOS_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $ARQUIVOS_->getSISTEMA();
unset($ARQUIVOS_);

if (isset($_REQUEST['TXT_ARQUIVOS_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "arquivos/arquivos.pesquisar.layout.php";
}
// Layout Completo
