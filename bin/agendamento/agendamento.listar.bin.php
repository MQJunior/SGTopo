<?php
/**
 * 📄 agendamento.listar.bin.php - Realiza a listagem de registros no Banco de Dados pelos campos informados
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-16 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
$AGENDAMENTO_->Listar();
$this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
//print_r($this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS']);
unset($AGENDAMENTO_);

if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {

    // Suponha que esse seja o array vindo do banco de dados
    $dados = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS'];

    $agendamentos = [];

    foreach ($dados as $item) {
        $agendamentos[] = [
            'CODIGO'      => $item['CODIGO'],
            'DATA'        => $item['DATA'],
            'HORA'        => $item['HORA'],
            'DESCRICAO'   => $item['DESCRICAO'],
            'ENDERECO'    => $item['ENDERECO'],
            'CONTATO'     => $item['CONTATO'],
            'LOCAL'       => $item['LOCAL'],
            'OBSERVACOES' => $item['OBSERVACOES'],
            'STATUS'      => strtoupper($item['STATUS']),
            'DATACRIACAO' => $item['DATACRIACAO'],
            'USUARIO'     => 'supervisor@supervisor',
        ];
    }

    $resultado = ['agendamentos' => $agendamentos];

    // Converte para JSON
    echo json_encode($resultado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    die();

} else {

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.listar.layout.php";
}
