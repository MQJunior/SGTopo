<?php
/**
 * 📄 projeto.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$PROJETO_ = new Projeto($this->SISTEMA_);
(isset($_REQUEST['TXT_PROJETO_PESQUISAR'])) ? $PROJETO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_PROJETO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_PROJETO_PESQUISAR']) : $PROJETO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $PROJETO_->getSISTEMA();
unset($PROJETO_);

if (isset($_REQUEST['TXT_PROJETO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.pesquisar.layout.php";
}
// Layout Completo
