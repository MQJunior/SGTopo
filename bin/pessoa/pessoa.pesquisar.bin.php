<?php
/**
 * 📄 pessoa.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$PESSOA_ = new Pessoa($this->SISTEMA_);
(isset($_REQUEST['TXT_PESSOA_PESQUISAR'])) ? $PESSOA_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_PESSOA_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_PESSOA_PESQUISAR']) : $PESSOA_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $PESSOA_->getSISTEMA();
unset($PESSOA_);

if (isset($_REQUEST['TXT_PESSOA_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "pessoa/pessoa.pesquisar.layout.php";
}
// Layout Completo
