<?php
/**
 * 📄 projeto.pender.bin.php - Seta um projeto como Pendente
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-21 | 🏷️ v0.0.0
 */

/* Captura a chave do registro a ser consultada */
if (! isset($_REQUEST['txtChaveRegistro'])) {
    if ($this->SISTEMA_['SAIDA']['MODE'] != 'app') {
        require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.incluir.layout.php";
    }
    return;
}

/* Realiza a consulta no sistema */
$PROJETO_ = new Projeto($this->SISTEMA_);
$PROJETO_->Pender($_REQUEST['txtChaveRegistro']);
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
    $this->SISTEMA_['ENTIDADE']['PROJETO']['MENSAGEM']['SUCESSO']['PENDER'];

    $this->SISTEMA_['SAIDA']['APP'] = ['projeto' => $projeto];

} else {
    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.consultar.layout.php";
}