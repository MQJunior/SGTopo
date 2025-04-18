<?php
/**
 * 📄 agendamento.consultar.bin.php - Consulta um registro no sistema
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */
/* Captura a chave do registro a ser consultada */
if (isset($_REQUEST['txtChaveRegistro'])) {

    /* Realiza a consulta no sistema */
    $AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
    $AGENDAMENTO_->Consultar($_REQUEST['txtChaveRegistro']);
    $this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
    unset($AGENDAMENTO_);
    if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
        // Suponha que esse seja o array vindo do banco de dados
        //print_r($dados = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']);
        $item = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['VARS'];

        //$agendamento = [];

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

        $resultado                                    = ['agendamento' => $agendamento];
        $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['CONSULTAR'];
        $this->SISTEMA_['SAIDA']['APP']               = $resultado;
    } else {

        require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.consultar.layout.php";
    }

} else {
    if ($this->SISTEMA_['SAIDA']['MODE'] != 'app') {
        require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.incluir.layout.php";
    }
}
