<?php
/**
 * 📄 agendamento.listar.bin.php - Realiza a listagem de registros no Banco de Dados pelos campos informados
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: agendamento | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 * 📅 2025-04-09 | 🏷️ v0.0.1
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

// Filtros dinâmicos a partir de campos que comecem com TXT_AGENDAMENTO_
$filtros = [];
foreach ($_REQUEST as $chave => $valor) {
    if (stripos($chave, 'TXT_AGENDAMENTO_') === 0 && $valor !== '') {
        // Extrai o nome do campo real (ex: STATUS, DATA, etc.)
        $campo           = substr($chave, strlen('TXT_AGENDAMENTO_'));
        $filtros[$campo] = $valor;
    }
}

/* Realiza a pesquisa no Banco de Dados */
$AGENDAMENTO_ = new Agendamento($this->SISTEMA_);
$AGENDAMENTO_->Listar($filtros);
$this->SISTEMA_ = $AGENDAMENTO_->getSISTEMA();
//print_r($this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS']);
unset($AGENDAMENTO_);

if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {

    // Suponha que esse seja o array vindo do banco de dados
    $dados = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS'];

    $agendamentos = [];
    if (! empty($dados)) {

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
            ];
        }
    }

    $resultado                                    = ['agendamentos' => $agendamentos];
    $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['LISTAR'];
    $this->SISTEMA_['SAIDA']['APP']               = $resultado;

    // Converte para JSON

    //die();

} else {

    require $this->SISTEMA_['LAYOUT'] . "agendamento/agendamento.listar.layout.php";
}
