<?php
/**
 * 📄 recebimento.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$RECEBIMENTO_ = new Recebimento($this->SISTEMA_);
(isset($_REQUEST['TXT_RECEBIMENTO_PESQUISAR'])) ? $RECEBIMENTO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_RECEBIMENTO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_RECEBIMENTO_PESQUISAR']) : $RECEBIMENTO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $RECEBIMENTO_->getSISTEMA();
unset($RECEBIMENTO_);

if (isset($_REQUEST['TXT_RECEBIMENTO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "recebimento/recebimento.pesquisar.layout.php";
}
// Layout Completo
