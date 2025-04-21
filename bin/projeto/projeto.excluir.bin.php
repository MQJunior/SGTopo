<?php
/**
 * 📄 projeto.excluir.bin.php - Realiza a exclusão do registro no sistema
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-21 | 🏷️ v0.0.1
 */

/* Captura a chave do registro */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a exclusão do registro */
    $PROJETO_ = new Projeto($this->SISTEMA_);
    $PROJETO_->Excluir($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
    unset($PROJETO_);

    if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
        $this->SISTEMA_['SAIDA']['APP'] = [
            'SID'      => $this->SISTEMA_['SID'],
            'mensagem' => $this->SISTEMA_['ENTIDADE']['PROJETO']['MENSAGEM']['SUCESSO']['EXCLUIR'],
        ];
        return;
    }

}
require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.pesquisar.layout.php";