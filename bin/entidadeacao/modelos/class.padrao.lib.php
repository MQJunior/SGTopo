<?php
/**
 * 📄 class.padrao.lib.php - Classe para manipulação da entidade padrao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: classe
 */

class Padrao {

  // 🔒 Atributos Privados
  private $SISTEMA_ = null;
  private $TBL_PADRAO = null;
  private $TBL_USUARIO = null;
  private $DataBaseConfig = null;
  private $DataBaseLink = null;

  // 🔄 Retorna a variável SISTEMA
  public function getSISTEMA() {
    return $this->SISTEMA_;
  }

  // 🛠️ Construtor: Carrega configurações e tabelas
  function __construct($p_SISTEMA) {
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['PADRAO']['CONF']['DATABASE'];
    $this->TBL_PADRAO = $this->DataBaseConfig['TBL_PADRAO'];
    $this->TBL_USUARIO = $this->DataBaseConfig['TBL_USUARIO'];
  }

  // 🛠️ Destrutor: Libera memória e desconecta do DB
  function __destruct() {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }

  // 🔄 Conecta ao Banco de Dados
  private function ConectaDB() {
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB(
        $this->DataBaseConfig['HOSTNAME'],
        $this->DataBaseConfig['USERNAME'],
        $this->DataBaseConfig['PASSWORD'],
        $this->DataBaseConfig['DATABASENAME'],
        $this->DataBaseConfig['TIPODB'],
        $this->SISTEMA_
      );
  }

  // ❌ Desativa um registro
  public function Desativar($p_Codigo) {
    $this->ConectaDB();
    $this->DataBaseLink->Query("UPDATE {$this->TBL_PADRAO} SET REG_ATIVO='0' WHERE codigo='$p_Codigo'");
    $this->Consultar($p_Codigo);
  }

  // ✅ Ativa um registro
  public function Ativar($p_Codigo) {
    $this->ConectaDB();
    $this->DataBaseLink->Query("UPDATE {$this->TBL_PADRAO} SET REG_ATIVO='1' WHERE codigo='$p_Codigo'");
    $this->Consultar($p_Codigo);
  }

  // 🗑️ Exclui um registro
  public function Excluir($p_Codigo) {
    $this->ConectaDB();
    $this->DataBaseLink->Query("DELETE FROM {$this->TBL_PADRAO} WHERE codigo='$p_Codigo'");
    $this->PesquisarNome();
  }

  // 📋 Lista registros
  public function Listar($p_Inativos = false, $p_QtdeReg = null) {
    $this->ConectaDB();
    $sql_Condicao = $p_Inativos ? "(1=1)" : "(Padrao.REG_ATIVO=1)";
    $sql_QtdReg = $p_QtdeReg > 0 ? "LIMIT $p_QtdeReg" : "";
    $sql = "SELECT * FROM {$this->TBL_PADRAO} AS Padrao WHERE $sql_Condicao ORDER BY Padrao.NOME $sql_QtdReg";
    $this->DataBaseLink->Query($sql);
    $this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'] = $this->DataBaseLink->ResultConsult();
  }

  // 🔍 Pesquisa por Nome
  public function PesquisarNome($p_NOME = '', $p_Inativos = false, $p_QtdeReg = null) {
    $this->ConectaDB();
    $sql_Condicao = $p_Inativos ? "(1=1)" : "(Padrao.REG_ATIVO=1)";
    $sql_QtdReg = $p_QtdeReg > 0 ? "LIMIT $p_QtdeReg" : "";
    $sql = "SELECT * FROM {$this->TBL_PADRAO} AS Padrao WHERE $sql_Condicao AND Padrao.NOME LIKE '$p_NOME%' ORDER BY Padrao.NOME $sql_QtdReg";
    $this->DataBaseLink->Query($sql);
    $this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'] = $this->DataBaseLink->ResultConsult();
  }

  // 🔍 Pesquisa por Campo
  public function Pesquisar($p_CAMPO = 'NOME', $p_VALOR = '', $p_Inativos = false, $p_QtdeReg = null) {
    $this->ConectaDB();
    $sql_Condicao = $p_Inativos ? "(1=1)" : "(Padrao.REG_ATIVO=1)";
    $sql_QtdReg = $p_QtdeReg > 0 ? "LIMIT $p_QtdeReg" : "";
    $sql = "SELECT * FROM {$this->TBL_PADRAO} AS Padrao WHERE $sql_Condicao AND Padrao.$p_CAMPO LIKE '$p_VALOR%' ORDER BY Padrao.$p_CAMPO $sql_QtdReg";
    $this->DataBaseLink->Query($sql);
    $this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'] = $this->DataBaseLink->ResultConsult();
  }

  // 📄 Consulta um registro
  public function Consultar($p_Codigo) {
    $this->ConectaDB();
    $sql = "SELECT Padrao.*, Usuario.NOME_EXIBIR AS USUARIO_NOME FROM {$this->TBL_PADRAO} AS Padrao LEFT JOIN {$this->TBL_USUARIO} AS Usuario ON Usuario.codigo = Padrao.usuario WHERE Padrao.codigo = '$p_Codigo'";
    $this->DataBaseLink->Query($sql);
    $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'] = $this->DataBaseLink->ResultConsult()[0];
  }

  // ➕ Inclui um registro
  public function Incluir($p_Dados) {
    $this->ConectaDB();
    $p_Dados['USUARIO'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $p_Dados['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
    $p_Dados['DATACRIACAO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
    $p_Dados['REG_ATIVO'] = '1';
    $this->DataBaseLink->Insert($this->TBL_PADRAO, $p_Dados);
    $this->Consultar($this->DataBaseLink->Id());
  }

  // 🖊️ Altera um registro
  public function Alterar($p_Dados, $p_Codigo) {
    $this->ConectaDB();
    $sql_Set = implode(", ", array_map(fn($k, $v) => "$k = " . ($v === null ? "null" : "'$v'"), array_keys($p_Dados), $p_Dados));
    $sql = "UPDATE {$this->TBL_PADRAO} SET $sql_Set WHERE codigo='$p_Codigo'";
    $this->DataBaseLink->Query($sql);
    $this->Consultar($p_Codigo);
  }
}
?>
