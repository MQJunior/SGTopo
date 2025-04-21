<?php
/**
 * 📄 projeto.alterar.bin.php - Altera um registro no sistema
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-10 | 🏷️ v0.0.1
 */

$PROJETO_ = new Projeto($this->SISTEMA_);

/* Se for alteração de dados */
if (isset($_REQUEST['txtChaveRegistro']) && isset($_REQUEST['TXT_PROJETOS_NOME'])) {

    $PROJETO_->Alterar(
        $_REQUEST['txtChaveRegistro'],
        $_REQUEST['TXT_PROJETOS_NOME'],
        $_REQUEST['TXT_PROJETOS_DESCRICAO'],
        $_REQUEST['TXT_PROJETOS_DATA_INICIO'],
        $_REQUEST['TXT_PROJETOS_DATA_FIM'],
        $_REQUEST['TXT_PROJETOS_CAMINHO']
    );

    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
    unset($PROJETO_);

    if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
        $item = $this->SISTEMA_['ENTIDADE']['PROJETO']['VARS'];

        $projeto = [
            'CODIGO'      => $item['CODIGO'],
            'NOME'        => $item['NOME'],
            'DESCRICAO'   => $item['DESCRICAO'],
            'DATA_INICIO' => $item['DATA_INICIO'],
            'DATA_FIM'    => $item['DATA_FIM'],
            'STATUS'      => strtoupper($item['STATUS']),
            'CAMINHO'     => $item['CAMINHO'],
            'SESSAO'      => $item['SESSAO'],
            'USUARIO'     => $item['USUARIO'],
            'DATACRIACAO' => $item['DATACRIACAO'],
            'REG_ATIVO'   => $item['REG_ATIVO'],
        ];

        $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] =
        $this->SISTEMA_['ENTIDADE']['PROJETO']['MENSAGEM']['SUCESSO']['ALTERAR'];

        $this->SISTEMA_['SAIDA']['APP'] = ['projeto' => $projeto];
        return;
    }

    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.consultar.layout.php";
    return;
}

/* Se for apenas para exibir o formulário HTML */
if (isset($_REQUEST['txtChaveRegistro'])) {
    $PROJETO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $PROJETO_->getSISTEMA();
}

unset($PROJETO_);
require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.alterar.layout.php";