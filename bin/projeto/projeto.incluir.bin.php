<?php
/**
 * 📄 projeto.incluir.bin.php - Realiza a inclusão de um novo projeto
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-10 | 🏷️ v0.0.1
 */

if (isset($_REQUEST['TXT_PROJETOS_NOME'])) {

    /* Captura os campos enviados pelo formulário */
    foreach ($_REQUEST as $tmpChave => $tmpValor);
    (strpos($tmpChave, 'TXT_PROJETOS_') === false) ? false : $tmpDados[str_replace('TXT_PROJETOS_', '', $tmpChave)] = utf8_decode($tmpValor);

    /* Realiza a inclusão */
    $PROJETO_ = new Projeto($this->SISTEMA_);
    $PROJETO_->Novo(
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
        $this->SISTEMA_['ENTIDADE']['PROJETO']['MENSAGEM']['SUCESSO']['INCLUIR'];

        $this->SISTEMA_['SAIDA']['APP'] = ['projeto' => $projeto];

    } else {
        require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.consultar.layout.php";
    }

} else {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.incluir.layout.php";
}
