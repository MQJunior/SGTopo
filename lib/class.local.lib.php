<?php
/**
 * 📄 class.local.lib.php - Classe para manipulação da entidade local
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: classe
 */

class Local
{
    /**
     * @var    array $SISTEMA_ Variavel Sistema
     * @access private
     */
    private $SISTEMA_ = null;

    /**
     * @var    link $TBL_LOCAL Nome da Tabela da Entidade
     * @access private
     */
    private $TBL_LOCAL = null;
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
        $this->SISTEMA_       = $p_SISTEMA;
        $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['LOCAL']['CONF']['DATABASE'];
        $this->TBL_LOCAL     = $this->DataBaseConfig['TBL_LOCAL'];
        $this->TBL_USUARIO    = $this->DataBaseConfig['TBL_USUARIO'];

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
        $sql_Alterar = "update " . $this->TBL_LOCAL . " set REG_ATIVO='0' where codigo='" . $p_Codigo . "'";
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
        $sql_Alterar = "update " . $this->TBL_LOCAL . " set REG_ATIVO='1' where codigo='" . $p_Codigo . "'";
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
        $sql_Excluir = "DELETE FROM " . $this->TBL_LOCAL . " where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Excluir);
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['EXCLUSAO'];
        $this->PesquisarNome();
    }
    /**
     * Lista os registro no Banco de Dados
     * @param boolean $p_Inativos Seta-se true para listar registros desativados
     * @param boolean $p_QtdeReg Seta-se a quantidade de registro exibido
     * @access public
     */
    public function Listar($p_Inativos = false, $p_QtdeReg = null)
    {
        $this->ConectaDB();
        $sql_QtdReg = "";
        if ($p_QtdeReg > 0) {
            $sql_QtdReg = " LIMIT " . $p_QtdeReg;
        }
        $sql_Condicao = "(Local.REG_ATIVO=1)";
        if ($p_Inativos) {
            $sql_Condicao = "(1=1)";
        }

        $sql_Listar = "select  Local.*
      FROM  " . $this->TBL_LOCAL . " as Local
        where
          " . $sql_Condicao . "
      order by Local.NOME " . $sql_QtdReg;

        $this->DataBaseLink->Query($sql_Listar);
        $this->SISTEMA_['ENTIDADE']['LOCAL']['DADOS'] = $this->DataBaseLink->ResultConsult();
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

        $sql_Condicao = "(Local.REG_ATIVO=1)";
        if ($p_Inativos) {
            $sql_Condicao = "(1=1)";
        }

        $sql_Condicao .= " and (Local.NOME like '" . $p_NOME . "%')";

        $sql_PesquisarNome = "select  Local.*
      FROM  " . $this->TBL_LOCAL . " as Local
        where
          " . $sql_Condicao . "
      order by Local.NOME" . $sql_QtdReg;

        $this->DataBaseLink->Query($sql_PesquisarNome);
        $this->SISTEMA_['ENTIDADE']['LOCAL']['DADOS'] = $this->DataBaseLink->ResultConsult();
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

        $sql_Condicao = "(Local.REG_ATIVO=1)";
        if ($p_Inativos) {
            $sql_Condicao = "(1=1)";
        }

        $sql_Condicao .= " and (Local.$p_CAMPO like '" . $p_VALOR . "%')";

        $sql_PesquisarNome = "select  Local.*
      FROM  " . $this->TBL_LOCAL . " as Local
        where
          " . $sql_Condicao . "
      order by Local." . $p_CAMPO . $sql_QtdReg;

        $this->DataBaseLink->Query($sql_PesquisarNome);
        $this->SISTEMA_['ENTIDADE']['LOCAL']['DADOS'] = $this->DataBaseLink->ResultConsult();
    }
    /**
     * Consulta um registro no Banco de Dados
     * @param integer $p_Codigo Chave do registro a ser consultado
     * @access public
     */
    public function Consultar($p_Codigo)
    {
        $this->ConectaDB();
        $sql_Consultar = "select Local.*, Usuario.NOME_EXIBIR USUARIO_NOME
      FROM  " . $this->TBL_LOCAL . " as Local
      Left join
          " . $this->TBL_USUARIO . " as Usuario on (Usuario.codigo = Local.usuario)
        where
          Local.codigo = '" . $p_Codigo . "'";

        $this->DataBaseLink->Query($sql_Consultar);
        $tmpDados                                     = $this->DataBaseLink->ResultConsult();
        $this->SISTEMA_['ENTIDADE']['LOCAL']['VARS'] = $tmpDados[0];
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
        $this->DataBaseLink->Insert($this->TBL_LOCAL);
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['MENSAGEM'];
        $this->Consultar($this->DataBaseLink->Id());
    }
    /**
     * Altera um registro no Banco de Dados
     * @param array $p_Dados Vetor com as Chaves e valores a serem alterados no Banco de Dados
     * @param array $p_Codigo Chave do Registro a ser alterado
     * @access public
     */
    public function Alterar($p_Dados, $p_Codigo)
    {
        $this->ConectaDB();
        $sql_Complemento = " codigo=" . $p_Codigo;
        foreach ($p_Dados as $tmpCampo => $tmpValor) {
            if (($tmpValor == "null") || ($tmpValor == null)) {
                $sql_Complemento .= ", " . $tmpCampo . " = null ";
            } else {
                $sql_Complemento .= ", " . $tmpCampo . " = '" . $tmpValor . "' ";
            }

        }
        $sql_Alterar = "update " . $this->TBL_LOCAL . " set " . $sql_Complemento . " where codigo='" . $p_Codigo . "'";
        $this->DataBaseLink->Query($sql_Alterar);
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']   = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['TITULO'];
        $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'] = $this->SISTEMA_['ENTIDADE']['LOCAL']['MENSAGEM']['SUCESSO']['MENSAGEM'];
        $this->Consultar($p_Codigo);
    }
}
