<?php
/**
 * 📄 class.agendamento.lib.php - Classe para manipulação da entidade agendamento
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: classe
 */

class Agendamento
{
    /**
     * @var    array $SISTEMA_ Variavel Sistema
     * @access private
     */
    private $SISTEMA_ = null;

    /**
     * @var    link $TBL_AGENDAMENTO Nome da Tabela da Entidade
     * @access private
     */
    private $TBL_AGENDAMENTO = null;
    /**
     * @var    link $TBL_USUARIO Nome da Tabela onde possui registro dos Usuários (Relacionamento)
     * @access private
     */
    private $TBL_USUARIO = null;

    /**
     * @var    array $DataBaseConfig Vetor com as configurações de acesso ao banco de dados
     * @access private
     */
    private $DataBaseConfig = null;
    /**
     * @var    link $DataBaseLink Link de acesso ao Banco de Dados
     * @access private
     */
    private $DataBaseLink = null;
    /**
     * Retorna a Variavel SISTEMA manipulada pela classe
     * @return array Variavel SISTEMA
     * @access public
     */
    public function getSISTEMA()
    {
        return $this->SISTEMA_;
    }
    /**
     * Carrega a variavel SISTEMA, Configuração do DB e Seta-se as tabelas a serem utilizadas
     * @param array $SISTEMA Variavel SISTEMA
     * @access constructor
     */
    public function __construct($p_SISTEMA)
    {
        $this->SISTEMA_        = $p_SISTEMA;
        $this->DataBaseConfig  = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['CONF']['DATABASE'];
        $this->TBL_AGENDAMENTO = $this->DataBaseConfig['TBL_AGENDAMENTO'];
        $this->TBL_USUARIO     = $this->DataBaseConfig['TBL_USUARIO'];

    }
    /**
     * Libera da Memória as variaveis e o Link de conexção do Banco de Dados
     * @access destruct
     */
    public function __destruct()
    {
        if (is_object($this->DataBaseLink)) {
            $this->DataBaseLink->Disconnect();
        }

        unset($this->DataBaseLink);
    }

    /**
     * Realiza a conexção com o Banco de Dados
     * @access private
     */
    private function ConectaDB()
    {
        if ($this->DataBaseLink == null) {
            $this->DataBaseLink = new ConexaoDB($this->DataBaseConfig['HOSTNAME'], $this->DataBaseConfig['USERNAME'], $this->DataBaseConfig['PASSWORD'], $this->DataBaseConfig['DATABASENAME'], $this->DataBaseConfig['TIPODB'], $this->SISTEMA_);
        }

    }

    /**
     * Desativa um registro no Banco de Dados setando o Valor de REG_ATIVO para 0
     * Realiza a consulta do registro no Banco de Dados
     * @param integer $p_Codigo Chave do registro a ser desativado
     * @access public
     */
    public function Desativar($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Alterar = "update " . $this->TBL_AGENDAMENTO . " set REG_ATIVO='0' where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->Consultar($p_Codigo);
    }
    /**
     * Ativa um registro no Banco de Dados setando o Valor de REG_ATIVO para 1
     * Realiza a consulta do registro no Banco de Dados
     * @param integer $p_Codigo Chave do registro a ser ativado
     * @access public
     */
    public function Ativar($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Alterar = "update " . $this->TBL_AGENDAMENTO . " set REG_ATIVO='1' where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->Consultar($p_Codigo);
    }
    /**
     * Exclui um registro no Banco de Dados
     * @param integer $p_Codigo Chave do registro a ser excluido
     * @access public
     */
    public function Excluir($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Excluir = "DELETE FROM " . $this->TBL_AGENDAMENTO . " where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Excluir);
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['EXCLUSAO'];
        $this->PesquisarNome();
    }

/**
 * Lista registros da entidade Agendamento.
 *
 * Esta função executa uma consulta SQL baseada em filtros opcionais,
 * podendo retornar registros ativos ou inativos, com ou sem limite de quantidade.
 *
 * Caso não sejam fornecidos parâmetros, retorna todos os registros ativos.
 *
 * @param array $p_Filtros     Array associativo com campos => valores para aplicar como filtro (AND).
 *                             Exemplo: ['STATUS' => 'PENDENTE', 'DATA' => '2025-04-17']
 * @param bool $p_Inativos     Define se a consulta deve incluir registros inativos (REG_ATIVO=0).
 *                             Padrão: false (retorna apenas ativos).
 * @param int|null $p_QtdeReg  Limita a quantidade de registros retornados. Padrão: null (sem limite).
 *
 * @return void Os resultados são armazenados em $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS']
 */

    public function Listar($p_Filtros = [], $p_Inativos = false, $p_QtdeReg = null)
    {
        $this->ConectaDB();

        // Limite de registros
        $sql_QtdReg = "";
        if ($p_QtdeReg > 0) {
            $sql_QtdReg = " LIMIT " . intval($p_QtdeReg);
        }

        // Condição base: ativo ou todos
        $sql_Condicao = $p_Inativos ? "1=1" : "Agendamento.REG_ATIVO = 1";

        // Aplica filtros adicionais, se houver
        if (! empty($p_Filtros)) {
            foreach ($p_Filtros as $campo => $valor) {
                $valorSanitizado = addslashes(trim($valor));
                $sql_Condicao .= " AND Agendamento.`$campo` = '{$valorSanitizado}'";
            }
        }

        // Monta a consulta final
        $sql_Listar = "
        SELECT Agendamento.*
        FROM {$this->TBL_AGENDAMENTO} AS Agendamento
        WHERE {$sql_Condicao}
        ORDER BY Agendamento.DATA
        {$sql_QtdReg}
    ";

        // Executa
        $this->DataBaseLink->Query($sql_Listar);
        $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS'] = $this->DataBaseLink->ResultConsult();
    }

    /**
     * Pesquisa os registro no Banco de Dados pelo CAMPO nome
     * @param string $p_NOME Seta-se o nome a ser pesquisado
     * @param boolean $p_Inativos Seta-se true para listar registros desativados
     * @param boolean $p_QtdeReg Seta-se a quantidade de registro exibido
     * @access public
     */
    public function PesquisarNome($p_NOME = '', $p_Inativos = false, $p_QtdeReg = null)
    {
        $this->ConectaDB();
        $sql_QtdReg = "";
        if ($p_QtdeReg > 0) {
            $sql_QtdReg = " LIMIT " . $p_QtdeReg;
        }

        $sql_Condicao = "(Agendamento.REG_ATIVO=1)";
        if ($p_Inativos) {
            $sql_Condicao = "(1=1)";
        }

        //$sql_Condicao .= " and (Agendamento.NOME like '" . $p_NOME . "%')";

        $sql_PesquisarNome = "select  Agendamento.*
      FROM  " . $this->TBL_AGENDAMENTO . " as Agendamento
        where
          " . $sql_Condicao . "
      order by Agendamento.DATA" . $sql_QtdReg;

        $this->DataBaseLink->Query($sql_PesquisarNome);
        $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS'] = $this->DataBaseLink->ResultConsult();
    }
    /**
     * Pesquisa os registro no Banco de Dados pelo CAMPO Selecionado
     * @param string $p_CAMPO Seta-se o nome do campo
     * @param string $p_VALOR Seta-se o valor a ser pesquisado
     * @param boolean $p_Inativos Seta-se true para listar registros desativados
     * @param integer $p_QtdeReg Seta-se a quantidade de registro exibido
     * @access public
     */
    public function Pesquisar($p_CAMPO = 'NOME', $p_VALOR = '', $p_Inativos = false, $p_QtdeReg = null)
    {
        $this->ConectaDB();
        $sql_QtdReg = "";
        if ($p_QtdeReg > 0) {
            $sql_QtdReg = " LIMIT " . $p_QtdeReg;
        }

        $sql_Condicao = "(Agendamento.REG_ATIVO=1)";
        if ($p_Inativos) {
            $sql_Condicao = "(1=1)";
        }

        $sql_Condicao .= " and (Agendamento.$p_CAMPO like '" . $p_VALOR . "%')";

        $sql_PesquisarNome = "select  Agendamento.*
      FROM  " . $this->TBL_AGENDAMENTO . " as Agendamento
        where
          " . $sql_Condicao . "
      order by Agendamento.DATA" . $sql_QtdReg;

        $this->DataBaseLink->Query($sql_PesquisarNome);
        $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['DADOS'] = $this->DataBaseLink->ResultConsult();
    }
    /**
     * Consulta um registro no Banco de Dados
     * @param integer $p_Codigo Chave do registro a ser consultado
     * @access public
     */
    public function Consultar($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Consultar = "select Agendamento.*, Usuario.NOME_EXIBIR USUARIO_NOME
      FROM  " . $this->TBL_AGENDAMENTO . " as Agendamento
      Left join
          " . $this->TBL_USUARIO . " as Usuario on (Usuario.codigo = Agendamento.usuario)
        where
          Agendamento.codigo = '" . $p_Codigo . "'";

        $this->DataBaseLink->Query($sql_Consultar);
        $tmpDados                                          = $this->DataBaseLink->ResultConsult();
        $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['VARS'] = $tmpDados[0];
    }
    /**
     * Inclui um registro no Banco de Dados
     * @param array $p_Dados Vetor com as Chaves e valores a serem inseridos no Banco de Dados
     * @access public
     */
    public function Incluir($p_Dados)
    {
        $this->ConectaDB();
        $this->DataBaseLink->Data                = [];
        $this->DataBaseLink->Data                = $p_Dados;
        $this->DataBaseLink->Data['USUARIO']     = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
        $this->DataBaseLink->Data['SESSAO']      = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
        $this->DataBaseLink->Data['DATACRIACAO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
        $this->DataBaseLink->Data['REG_ATIVO']   = '1';
        $this->DataBaseLink->Insert($this->TBL_AGENDAMENTO);
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['MENSAGEM'];
        $this->Consultar($this->DataBaseLink->Id());
    }
    /**
     * Altera um registro no Banco de Dados
     * @param array $p_Codigo Chave do Registro a ser alterado
     * @param array $p_Dados Vetor com as Chaves e valores a serem alterados no Banco de Dados
     * @access public
     */
    public function Alterar($p_Codigo, $p_Data, $p_Hora, $p_Endereco, $p_Descricao, $p_Contato, $p_Local, $p_Observacoes)
    {
        $this->ConectaDB();

        // Função auxiliar para tratar NULL
        $NullIfEmpty = function ($valor) {
            return (trim($valor) === '') ? 'NULL' : "'{$valor}'";
        };

        $sql_Alterar = "UPDATE " . $this->TBL_AGENDAMENTO . " SET
                    DATA        = " . $NullIfEmpty($p_Data) . ",
                    HORA        = " . $NullIfEmpty($p_Hora) . ",
                    ENDERECO    = " . $NullIfEmpty($p_Endereco) . ",
                    DESCRICAO   = " . $NullIfEmpty($p_Descricao) . ",
                    CONTATO     = " . $NullIfEmpty($p_Contato) . ",
                    LOCAL       = " . $NullIfEmpty($p_Local) . ",
                    OBSERVACOES = " . $NullIfEmpty($p_Observacoes) . "
                    WHERE CODIGO = '{$p_Codigo}'";

        $this->DataBaseLink->Query($sql_Alterar);

        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['ALTERADO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['ALTERADO']['MENSAGEM'];

        $this->Consultar($p_Codigo);
    }

    public function Novo($p_Data, $p_Hora, $p_Endereco, $p_Descricao, $p_Contato, $p_Local, $p_Observacoes)
    {
        $this->ConectaDB();

        $sql_Incluir = "INSERT INTO " . $this->TBL_AGENDAMENTO . "
    (DATA, HORA, ENDERECO, DESCRICAO, CONTATO, LOCAL, OBSERVACOES, USUARIO, SESSAO)
    VALUES (
        " . NullIfEmpty($p_Data) . ",
        " . NullIfEmpty($p_Hora) . ",
        " . NullIfEmpty($p_Endereco) . ",
        " . NullIfEmpty($p_Descricao) . ",
        " . NullIfEmpty($p_Contato) . ",
        " . NullIfEmpty($p_Local) . ",
        " . NullIfEmpty($p_Observacoes) . ",
        " . $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'] . ",
        " . $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'] . "
    )";

        $this->DataBaseLink->Query($sql_Incluir);

        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['MENSAGEM']['SUCESSO']['MENSAGEM'];

        $this->Consultar($this->DataBaseLink->Id());
    }

    public function Cancelar($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Alterar = "update " . $this->TBL_AGENDAMENTO . " set STATUS='CANCELADO' where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->Consultar($p_Codigo);
    }

    public function Pender($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Alterar = "update " . $this->TBL_AGENDAMENTO . " set STATUS='PENDENTE' where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->Consultar($p_Codigo);
    }

    public function Concluir($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Alterar = "update " . $this->TBL_AGENDAMENTO . " set STATUS='CONCLUIDO' where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->Consultar($p_Codigo);
    }

}
