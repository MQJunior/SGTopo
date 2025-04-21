<?php
/**
 * 📄 projeto.pesquisar.bin.php - Realiza a pesquisa de registros no Banco de Dados pelo nome
 * 🧭 Sistema: SGTopo
 * 📦 Pacote: projeto | 📂 Subpacote: bin
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com>
 *  📅 2025-04-20 | 🏷️ v0.0.0
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

// Filtros dinâmicos a partir de campos que comecem com TXT_PROJETO_
$filtros = [];
foreach ($_REQUEST as $chave => $valor) {
    if (stripos($chave, 'TXT_PROJETO_') === 0 && $valor !== '') {
        // Extrai o nome do campo real (ex: STATUS, DATA, etc.)
        $campo           = substr($chave, strlen('TXT_PROJETO_'));
        $filtros[$campo] = $valor;
    }
}

/* Realiza a pesquisa no Banco de Dados */
$PROJETO_ = new Projeto($this->SISTEMA_);
$PROJETO_->Listar($filtros);
$this->SISTEMA_ = $PROJETO_->getSISTEMA();
unset($PROJETO_);
if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {

    $dados = $this->SISTEMA_['ENTIDADE']['PROJETO']['DADOS'];

    $projetos = [];
    if (! empty($dados)) {

        foreach ($dados as $item) {
            $projetos[] = [
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
        }
    }

    $resultado                                    = ['projetos' => $projetos];
    $this->SISTEMA_['MENSAGEM']['APP']['SUCESSO'] = $this->SISTEMA_['ENTIDADE']['PROJETO']['MENSAGEM']['SUCESSO']['LISTAR'];
    $this->SISTEMA_['SAIDA']['APP']               = $resultado;

} else {

    require $this->SISTEMA_['LAYOUT'] . "projeto/projeto.pesquisar.layout.php";
}
