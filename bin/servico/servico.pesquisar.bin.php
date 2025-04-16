<?php
/**
 * 📄 servico.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$SERVICO_ = new Servico($this->SISTEMA_);
(isset($_REQUEST['TXT_SERVICO_PESQUISAR'])) ? $SERVICO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_SERVICO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_SERVICO_PESQUISAR']) : $SERVICO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $SERVICO_->getSISTEMA();
unset($SERVICO_);

if (isset($_REQUEST['TXT_SERVICO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "servico/servico.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "servico/servico.pesquisar.layout.php";
}
// Layout Completo
