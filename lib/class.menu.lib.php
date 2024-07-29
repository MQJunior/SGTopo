<?php
/**
 * class.menu.lib.php
 *
 * Classe MenuSys
 *
 * API para manipulação de Permissões
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @copyright Copyright © 2006, Marcio Queiroz Jr.
 * @package sistema
 * @date 2018-02-03
 *
 * @Update 2018-02-03
 *
 * @todo
 *   - 
 */


class MenuSys
{
  private $SISTEMA_;

  private $TBL_MENU = "";
  private $TBL_ENTIDADE_ACAO = "";

  /**
   * @var	array $DataBaseConfig Vetor com as configuracoes de acesso ao banco de dados
   * @access private
   */
  private $DataBaseConfig = null;
  /**
   * @var	link $DataBaseLink Link de acesso ao Banco de Dados
   * @access private
   */
  private $DataBaseLink = null;


  public $Codigo = null;
  public $Nome = null;
  public $EntidadeAcao = null;
  public $Ordem = null;
  public $Nivel = null;
  public $Tipo = null;
  public $Icone = null;
  public $MenuPai = null;
  public $Sessao = null;
  public $Usuario = null;
  public $DataCriacao = null;
  public $Ativo = null;

  /**
   * Retorna o Vetor Sistema apos processa-lo
   * @return array Array Sistema
   * access public
   */
  public function getSISTEMA()
  {
    return $this->SISTEMA_;
  }

  function __construct($p_SISTEMA)
  {
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['MENU']['CONFIG']['DATABASE'];
    $this->TBL_MENU = $this->SISTEMA_['ENTIDADE']['MENU']['CONFIG']['ENTIDADE_DB']['TBL_MENU'];
    $this->TBL_ENTIDADE_ACAO = $this->SISTEMA_['ENTIDADE']['MENU']['CONFIG']['ENTIDADE_DB']['TBL_ENTIDADE_ACAO'];

  }
  function __destruct()
  {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }
  private function ConectaDB()
  {
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB(
        $this->DataBaseConfig['HOSTNAME']
        ,
        $this->DataBaseConfig['USERNAME']
        ,
        $this->DataBaseConfig['PASSWORD']
        ,
        $this->DataBaseConfig['DATABASENAME']
        ,
        $this->DataBaseConfig['TIPODB']
      );
  }

  public function ListarMenu($p_Inativos = false)
  {
    $this->ConectaDB();
    $sql_Condicao = "(Menus.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
    $sql_ListaMenu = "select Acoes.ENTIDADE ENTIDADE, Acoes.NOME ACAO, Menus.*
    FROM  " . $this->TBL_MENU . " as Menus
    Left join
        " . $this->TBL_ENTIDADE_ACAO . " as Acoes on (Acoes.codigo = Menus.entidade_acao)
      where
        " . $sql_Condicao . "
    order by Menus.MENU_PAI, Menus.NIVEL, Menus.ORDEM";

    $this->DataBaseLink->Query($sql_ListaMenu);
    return $this->DataBaseLink->ResultConsult();
  }
  /* --------------------------------------------------------------- */
  public function ListarMenuPai($p_Inativos = false)
  {
    $this->ConectaDB();
    $sql_Condicao = "and (Menus.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = " and (1=1)";
    $sql_ListaMenu = "select Menus.*
    FROM  " . $this->TBL_MENU . " as Menus
      where
        (Menus.entidade_acao is null)
        " . $sql_Condicao . "
    order by Menus.MENU_PAI, Menus.NIVEL, Menus.ORDEM";

    $this->DataBaseLink->Query($sql_ListaMenu);
    return $this->DataBaseLink->ResultConsult();
  }
  /* --------------------------------------------------------------- */
  public function ListarEntidadeAcao($p_Inativos = false)
  {
    $this->ConectaDB();
    $sql_Condicao = "where REG_ATIVO=1";
    if ($p_Inativos)
      $sql_Condicao = "";
    $sql_ListaEntidadeAcao = "select *
    FROM  " . $this->TBL_ENTIDADE_ACAO . "
        " . $sql_Condicao . "
    order by ENTIDADE, NOME";

    $this->DataBaseLink->Query($sql_ListaEntidadeAcao);
    return $this->DataBaseLink->ResultConsult();
  }
  //////////////////////////////////////////////////
  public function possuiItens($p_array, $p_PAI)
  {
    $result = false;
    foreach ($p_array as $tmp_array)
      if ($tmp_array['MENU_PAI'] == $p_PAI)
        $result = true;
    return $result;
  }

  private function RetornaItens($p_array, $p_Pai = 0)
  {
    foreach ($p_array as $tmp_array) {
      $dataRetorno = null;
      if ($tmp_array['MENU_PAI'] == $p_Pai) {
        $dataRetorno['CODIGO'] = $tmp_array['CODIGO'];
        $dataRetorno['NIVEL'] = $tmp_array['NIVEL'];
        $dataRetorno['NOME'] = $tmp_array['NOME'];
        $dataRetorno['ENTIDADE'] = $tmp_array['ENTIDADE'];
        if (($tmp_array['ACAO'] != "") || ($tmp_array['ACAO'] != null))
          $dataRetorno['ACAO'] = $tmp_array['ACAO'];
        $dataRetorno['ORDEM'] = $tmp_array['ORDEM'];
        if ($tmp_array['TIPO'] == 0)
          $dataRetorno['TIPO'] = "TITULO";
        else
          $dataRetorno['TIPO'] = "MENU";
        $dataRetorno['ICONE'] = $tmp_array['ICONE'];
        $dataRetorno['ENTIDADE_ACAO'] = $tmp_array['ENTIDADE_ACAO'];
        if ($this->possuiItens($p_array, $tmp_array['CODIGO'])) {
          $dataRetorno['ITENS'] = $this->RetornaItens($p_array, $tmp_array['CODIGO']);
        } else {
          $dataRetorno['ITENS'] = null;
        }
        $retorno[] = $dataRetorno;
      }
    }

    return $retorno;
  }

  public function GerarVarMenu($p_ListaMenu = null)
  {
    if ($p_ListaMenu != null)
      $var_ListaMenu = $p_ListaMenu;
    else
      $var_ListaMenu = $this->ListarMenu();

    $var_menu = $this->RetornaItens($var_ListaMenu);


    return $var_menu;
  }

  public function NivelPai($p_CodigoPai)
  {
    $this->ConectaDB();
    $sql_Consultar = "select Menus.*
    FROM  " . $this->TBL_MENU . " as Menus
      where
        Menus.CODIGO = '" . $p_CodigoPai . "'";

    $this->DataBaseLink->Query($sql_Consultar);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    if (is_array($tmpDados)) {
      return $tmpDados[0]['NIVEL'];
    }
  }



  public function Consultar($p_Codigo)
  {
    $this->ConectaDB();
    $sql_Consultar = "select Menus.*
    FROM  " . $this->TBL_MENU . " as Menus
      where
        Menus.CODIGO = '" . $p_Codigo . "'";

    $this->DataBaseLink->Query($sql_Consultar);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    if (is_array($tmpDados)) {
      $this->Codigo = $tmpDados[0]['CODIGO'];
      $this->Nome = $tmpDados[0]['NOME'];
      $this->EntidadeAcao = $tmpDados[0]['ENTIDADE_ACAO'];
      $this->Ordem = $tmpDados[0]['ORDEM'];
      $this->Nivel = $tmpDados[0]['NIVEL'];
      $this->Tipo = $tmpDados[0]['TIPO'];
      $this->Icone = $tmpDados[0]['ICONE'];
      $this->MenuPai = $tmpDados[0]['MENU_PAI'];
      $this->Sessao = $tmpDados[0]['SESSAO'];
      $this->Usuario = $tmpDados[0]['USUARIO'];
      $this->DataCriacao = $tmpDados[0]['DATACRIACAO'];
      $this->Ativo = ($tmpDados[0]['REG_ATIVO'] == 1);
    } else {
      $this->resetVar();
    }
  }

  private function resetVar()
  {
    $this->Codigo = null;
    $this->Nome = null;
    $this->EntidadeAcao = null;
    $this->Ordem = null;
    $this->Nivel = null;
    $this->Tipo = null;
    $this->Icone = null;
    $this->MenuPai = null;
    $this->Sessao = null;
    $this->Usuario = null;
    $this->DataCriacao = date("Y-m-d H:i:s");
    $this->Ativo = null;
  }

  //////////////////////////////////////////////////
  public function OrdemMudar($p_codigo, $p_subir = true)
  {
    $this->resetVar();
    $this->Consultar($p_codigo);
    $tmp_OrdemAtual = $this->Ordem;
    if ($p_subir)
      $tmp_OrdemOutro = $tmp_OrdemAtual - 1;
    else
      $tmp_OrdemOutro = $tmp_OrdemAtual + 1;
    $tmp_MenuPai = $this->MenuPai;

    $sql_Ordem = "select Menus.CODIGO
    FROM  " . $this->TBL_MENU . " as Menus
      where
        ((Menus.MENU_PAI = '" . $tmp_MenuPai . "') and (Menus.ORDEM = '" . $tmp_OrdemOutro . "')) LIMIT 1";
    $this->DataBaseLink->Query($sql_Ordem);
    $tmpDados = $this->DataBaseLink->ResultConsult();

    $tmpDadosOrdem1['ORDEM'] = $tmp_OrdemOutro;
    $tmpDadosOrdem1['CODIGO'] = $p_codigo;
    $tmpCondicao1 = " CODIGO = '" . $p_codigo . "'";
    $this->DataBaseLink->Update($tmpDadosOrdem1, $tmpCondicao1, $this->TBL_MENU);

    $tmpDadosOrdem2['ORDEM'] = $tmp_OrdemAtual;
    $tmpDadosOrdem2['CODIGO'] = $tmpDados[0]['CODIGO'];
    $tmpCondicao2 = " CODIGO = '" . $tmpDados[0]['CODIGO'] . "'";
    $this->DataBaseLink->Update($tmpDadosOrdem2, $tmpCondicao2, $this->TBL_MENU);
    $this->MenuNivelar();
  }

  public function Alterar($p_Dados)
  {
    $this->ConectaDB();
    $sql_Complemento = " codigo=" . $this->Codigo;
    foreach ($p_Dados as $tmpCampo => $tmpValor) {
      if (($tmpValor == "null") || ($tmpValor == null))
        $sql_Complemento .= ", " . $tmpCampo . " = null ";
      else
        $sql_Complemento .= ", " . $tmpCampo . " = '" . $tmpValor . "' ";
    }
    //print($sql_Complemento);die();
    $tmpCondicao = " CODIGO = '" . $this->Codigo . "'";
    $sql_Alterar = "update " . $this->TBL_MENU . " set " . $sql_Complemento . " where codigo='" . $this->Codigo . "'";
    $this->DataBaseLink->Query($sql_Alterar);
    $this->MenuNivelar();
  }


  private function MenuNivelar()
  {
    $tmpLista = $this->ListarMenu();
    foreach ($tmpLista as $tmpDadosPais)
      $dadosPais[$tmpDadosPais['CODIGO']]['NIVEL'] = $tmpDadosPais['NIVEL'];

    foreach ($tmpLista as $tmpDadosOrdenar) {
      ($tmpDadosOrdenar['MENU_PAI'] == null) ? $tmpDadosOrdenar['MENU_PAI'] = 0 : false;
      $DadosOrdenar[$tmpDadosOrdenar['MENU_PAI']][] = $tmpDadosOrdenar;
    }
    foreach ($DadosOrdenar as $tmpDadosOrdenadosLista) {
      $I = 0;
      foreach ($tmpDadosOrdenadosLista as $tmpDadosOrdenarGravar) {
        $sql_Ordenar = "update " . $this->TBL_MENU . " set ORDEM=" . $I . " where codigo = '" . $tmpDadosOrdenarGravar['CODIGO'] . "'";
        $this->DataBaseLink->Query($sql_Ordenar);
        $I++;
      }
    }


    foreach ($tmpLista as $tmpDados) {
      $tmpCodigo = $tmpDados['CODIGO'];
      $tmpNivel = $tmpDados['NIVEL'];
      $tmpMenuPai = $tmpDados['MENU_PAI'];
      if ($tmpDados['MENU_PAI'] == null)
        $tmpNivelPai = -1;
      (isset($dadosPais[$tmpMenuPai])) ? $tmpNivelPai = $dadosPais[$tmpMenuPai]['NIVEL'] : false;
      $tmpNivelGravar = $tmpNivelPai + 1;
      $sql_Nivelar = "update " . $this->TBL_MENU . " set NIVEL=" . $tmpNivelGravar . " where codigo = '" . $tmpCodigo . "'";
      $this->DataBaseLink->Query($sql_Nivelar);
    }
  }

  public function OrdemUltima($p_pai)
  {

    $condicao = "(Menus.MENU_PAI = '" . $p_pai . "')";
    if (($p_pai == null) || (($p_pai == "null")))
      $condicao = "(Menus.MENU_PAI is null)";
    $sql_OrdemUltima = "select  max(Menus.ordem)+1 ORDEM
    FROM  " . $this->TBL_MENU . " as Menus
      where
        " . $condicao;

    $this->DataBaseLink->Query($sql_OrdemUltima);
    $retorno = $this->DataBaseLink->ResultConsult();

    if (is_null($retorno[0]['ORDEM']) || $retorno[0]['ORDEM'] == '')
      $Resultado = 0;
    else
      $Resultado = $retorno[0]['ORDEM'];

    return $Resultado;

  }

  public function Incluir($p_Dados)
  {
    $this->ConectaDB();
    $tmp_OrdemUltima = $this->OrdemUltima($p_Dados['MENU_PAI']) * 1;

    if (is_null($tmp_OrdemUltima) || $tmp_OrdemUltima == '' || $tmp_OrdemUltima == 'NULL')
      $tmp_OrdemUltima = 0;
    #die($tmp_OrdemUltima);
    $this->DataBaseLink->Data = array();
    $this->DataBaseLink->Data = $p_Dados;

    $this->DataBaseLink->Data['NOME'] = $p_Dados['NOME'];
    $this->DataBaseLink->Data['ORDEM'] = $tmp_OrdemUltima * 1;
    $this->DataBaseLink->Data['USUARIO'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $this->DataBaseLink->Data['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
    $this->DataBaseLink->Data['DATACRIACAO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
    //print_r($this->DataBaseLink->Data); die();

    //die(var_dump($this->DataBaseLink->Data). __FILE__ . " - ". __LINE__);

    /*
  $this->DataBaseLink->Insert($this->TBL_MENU);
    $this->Codigo =$this->DataBaseLink->Id();
  */
    $tmpDados = $this->DataBaseLink->Data;

    if (is_null($tmpDados['ENTIDADE_ACAO']))
      $tmpDados['ENTIDADE_ACAO'] = "";
    if (trim($tmpDados['ENTIDADE_ACAO']) == "")
      $tmpDados['ENTIDADE_ACAO'] = "NULL";

    if (is_null($tmpDados['MENU_PAI']))
      $tmpDados['MENU_PAI'] = "";
    if (trim($tmpDados['MENU_PAI']) == "")
      $tmpDados['MENU_PAI'] = "NULL";

    $sqlIncluirMenu = "INSERT INTO TBL_SYS_MENUS (NOME, MENU_PAI, ENTIDADE_ACAO, ICONE, 
		TIPO, NIVEL, ORDEM, USUARIO, SESSAO, DATACRIACAO, REG_ATIVO) VALUES
		('" . $tmpDados['NOME'] . "'," . $tmpDados['MENU_PAI'] . "," . $tmpDados['ENTIDADE_ACAO'] . ",'" . $tmpDados['ICONE'] . "'," . $tmpDados['TIPO'] . "," . $tmpDados['NIVEL'] . "," . $tmpDados['ORDEM'] . "," . $tmpDados['USUARIO'] . "," . $tmpDados['SESSAO'] . ",CURRENT_TIMESTAMP,1)";


    $this->DataBaseLink->Query($sqlIncluirMenu);
    $this->Codigo = $this->DataBaseLink->Id();
    $this->MenuNivelar();
  }

}
?>