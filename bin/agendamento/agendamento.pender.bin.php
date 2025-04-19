<?php
/**
 * 📄 agendamento.pender.bin.php - Define o status do agendamento como pendente
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-10 | 🏷️ v0.0.1
 */

if (! isset($_REQUEST['txtChaveRegistro'])) {
    if ($this->SISTEMA_['SAIDA']['MODE'] != 'app') {
        require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.incluir.layout.php";
    }
    return;
}

$AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
$AGENDAMENTO_->Pender($_REQUEST['txtChaveRegistro']);
$this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
unset($AGENDAMENTO_);

if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
    $item = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['VARS'];

    $agendamento = [
        'CODIGO'      => $item['CODIGO'],
        'DATA'        => $item['DATA'],
        'HORA'        => $item['HORA'],
        'DESCRICAO'   => $item['DESCRICAO'],
        'ENDERECO'    => $item['ENDERECO'],
        'CONTATO'     => $item['CONTATO'],
        'LOCAL'       => $item['LOCAL'],
        'OBSERVACOES' => $item['OBSERVACOES'],
        'STATUS'      => strtoupper($item['STATUS']),
        'SESSAO'      => $item['SESSAO'],
        'USUARIO'     => $item['USUARIO'],
        'DATACRIACAO' => $item['DATACRIACAO'],
        'REG_ATIVO'   => $item['REG_ATIVO'],
    ];

    $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] =
    $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['PENDER'];

    $this->SISTEMA_['SAIDA']['APP'] = ['agendamento' => $agendamento];

} else {
    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
}
