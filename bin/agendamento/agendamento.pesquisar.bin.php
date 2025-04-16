<?php
/**
 * 📄 agendamento.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
(isset($_REQUEST['TXT_AGENDAMENTO_PESQUISAR'])) ? $AGENDAMENTO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], utf8_decode($_REQUEST['TXT_AGENDAMENTO_PESQUISAR']), $tmpRegInativos, $_REQUEST['TXT_AGENDAMENTO_PESQUISAR']) : $AGENDAMENTO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
unset($AGENDAMENTO_);

if (isset($_REQUEST['TXT_AGENDAMENTO_PESQUISAR'])) {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.pesquisa.layout.php";
}
// Layout Resumido
else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.pesquisar.layout.php";
}
// Layout Completo
