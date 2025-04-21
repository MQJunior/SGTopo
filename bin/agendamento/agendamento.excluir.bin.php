<?php
/**
 * 📄 agendamento.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-10 | 🏷️ v0.0.1
 */

if (isset($_REQUEST['txtChaveRegistro'])) {

    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);

    if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
        $this->SISTEMA_['SAIDA']['APP'] = [
            'SID'      => $this->SISTEMA_['SID'],
            'mensagem' => $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['EXCLUIR'],
        ];
        return;
    }
}

if ($this->SISTEMA_['SAIDA']['MODE'] != 'app') {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.pesquisar.layout.php";
}