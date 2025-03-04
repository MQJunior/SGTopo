<?php
/**
 * class.permissao.lib.php
 *
 * Classe Permissao
 *
 * API para manipula��o de Permiss�es
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @copyright Copyright � 2006, Marcio Queiroz Jr.
 * @package sistema
 * @date 2018-02-03
 *
 * @Update 2018-02-03
 *
 * @todo
 *   - 
 */


class permissao
{
  private $SISTEMA_;

  private $TBL_ENTIDADE = "";
  private $TBL_ACAO = "";
  private $TBL_PERMISSAO = "";

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
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE'];
    $this->TBL_ENTIDADE = $this->DataBaseConfig['ENTIDADE_DB']['TBL_ENTIDADE'];
    $this->TBL_ACAO = $this->DataBaseConfig['ENTIDADE_DB']['TBL_ACAO'];
    $this->TBL_PERMISSAO = $this->DataBaseConfig['ENTIDADE_DB']['TBL_PERMISSAO'];

  }
  function __destruct()
  {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }
  public function EntidadeExiste($p_nome)
  {
    $this->ConectaDB();
    $tmp_Result = false;
    $this->DataBaseLink->Executar("select " . $this->TBL_ENTIDADE . "TABELA FROM " . $this->TBL_ENTIDADE . " WHERE " . $this->TBL_ENTIDADE . "NOME ='" . $p_nome . "' Limit 1");
    $this->DataBaseLink->ResultConsult();
    if (is_array($this->DataBaseLink->Data))
      if ($this->DataBaseLink->Data != "")
        $tmp_Result = true;
    return $tmp_Result;
  }
  public function EntidadeIncluir($p_nome, $p_tabela = "")
  {
    $this->ConectaDB();
    if ($p_nome == "")
      exit;
    if ($p_tabela == "")
      $p_tabela = $p_nome;
    if (!$this->EntidadeExiste($p_nome)) {
      unset($this->DataBaseLink->Data);
      $this->DataBaseLink->Data['NOME'] = $p_nome;
      $this->DataBaseLink->Data['TABELA'] = $p_tabela;
      $this->DataBaseLink->Insert($this->TBL_ENTIDADE);
    }
    return $this->EntidadeExiste($p_nome);
  }

  public function EntidadeAcaoExiste($p_entidade, $p_acao)
  {
    $this->ConectaDB();
    $tmp_Result = false;
    $this->DataBaseLink->Executar("select " . $this->TBL_ACAO . "CODIGO FROM " . $this->TBL_ACAO . " WHERE ((" . $this->TBL_ACAO . "NOME ='" . $p_acao . "') AND (" . $this->TBL_ACAO . "ENTIDADE ='" . $p_entidade . "')) Limit 1");
    $this->DataBaseLink->ResultConsult();
    if (is_array($this->DataBaseLink->Data))
      if ($this->DataBaseLink->Data != "")
        $tmp_Result = true;
    return $tmp_Result;
  }

  public function AcaoIncluir($p_entidade, $p_acao)
  {
    $this->ConectaDB();
    if ($p_entidade == "")
      exit;
    if ($p_acao == "")
      exit;
    if ($this->EntidadeIncluir($p_entidade)) {
      unset($this->DataBaseLink->Data);
      $this->DataBaseLink->Data['NOME'] = $p_acao;
      $this->DataBaseLink->Data['ENTIDADE'] = $p_entidade;
      $this->DataBaseLink->Insert($this->TBL_ACAO);
    }
    return $this->EntidadeAcaoExiste($p_entidade, $p_acao);
  }

  public function EntidadeAcaoDisponiveis()
  {
    $this->ConectaDB();
    $sql_EntidadeAcaoDisponiveis = "
    select 
      " . $this->TBL_ACAO . ".CODIGO,
      " . $this->TBL_ACAO . ".ENTIDADE,
      " . $this->TBL_ACAO . ".NOME ACAO,
      " . $this->TBL_ACAO . ".RESTRITO
    from " . $this->TBL_ACAO . "
    WHERE 
      " . $this->TBL_ACAO . ".RESTRITO = '1'
    order by " . $this->TBL_ACAO . ".ENTIDADE, " . $this->TBL_ACAO . ".NOME, " . $this->TBL_ACAO . ".RESTRITO";
    $this->DataBaseLink->Query($sql_EntidadeAcaoDisponiveis);



    $tmpDados = $this->DataBaseLink->ResultConsult();

    foreach ($tmpDados as $listaPermissao) {
      $dadosSaida[$listaPermissao['ENTIDADE']][] = array("CODIGO" => $listaPermissao['CODIGO'], "ACAO" => $listaPermissao['ACAO'], "RESTRITO" => $listaPermissao['RESTRITO']);
    }
    $tmpDados = $dadosSaida;

    return $tmpDados;
  }

  public function UsuarioPermissao($p_usuario, $p_Todos = true)
  {
    $this->ConectaDB();
    $condicaoExtra = "";
    if ($p_Todos == false) {
      $condicaoExtra = "and 
      (" . $this->TBL_PERMISSAO . ".TIPO_ACESSO = '+')";
    }
    $sql_UsuarioPermissao = "
    select 
    " . $this->TBL_ACAO . ".CODIGO,
    " . $this->TBL_PERMISSAO . ".USUARIO,
    " . $this->TBL_ACAO . ".ENTIDADE,
    " . $this->TBL_ACAO . ".nome ACAO,
    " . $this->TBL_ACAO . ".RESTRITO,
    " . $this->TBL_PERMISSAO . ".TIPO_ACESSO,
    " . $this->TBL_PERMISSAO . ".ENTIDADE_CODIGO
from " . $this->TBL_PERMISSAO . ",
" . $this->TBL_ACAO . "
where 
  ( (
      (" . $this->TBL_PERMISSAO . ".ACAO = " . $this->TBL_ACAO . ".CODIGO)
   and 
      (" . $this->TBL_PERMISSAO . ".USUARIO = " . $p_usuario . ")
    " . $condicaoExtra . "
   )or(
   " . $this->TBL_ACAO . ".RESTRITO=0)
   )
    order by " . $this->TBL_ACAO . ".ENTIDADE, " . $this->TBL_ACAO . ".CODIGO, " . $this->TBL_ACAO . ".RESTRITO";
    $this->DataBaseLink->Query($sql_UsuarioPermissao);
    return $this->DataBaseLink->ResultConsult();
  }
  /**
   * Checa se possui permissao para a Entidade e Acao de acordo com a Variavel SISTEMA_
   * access public
   */
  public function ChecarPermissaoSys()
  {
    $tmpCodigoUsuario = 0;
    $tmpEntidade = $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'];
    $tmpAcao = $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'];

    if (isset ($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO']))
      $tmpCodigoUsuario = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];

    if (!$this->ChecarPermissao($tmpCodigoUsuario, $tmpEntidade, $tmpAcao)) {
      //die('sem permissao');
      //unset($_REQUEST);
      $this->SISTEMA_['EXECUTAR']['COMANDO']['AUTORIZADO'] = false;
      $this->SISTEMA_['ERROR']['PERMISSAO']['MENSAGEM'] = "USU�RIO SEM PERMISSAO PARA O COMANDO: " . $tmpEntidade . " -> " . $tmpAcao;
      $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = 'SISTEMA';
      $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = 'EXIBIR_ERRO';
    }
  }

  /**
   * Checa se possui permissao para a Entidade e Acao
   * access public
   */
  public function ChecarPermissao($p_usuario, $p_entidade, $p_acao, $p_chave = 0)
  {

    $this->ConectaDB();
    $tmp_Result = false;
    $sql_ChecarPermissao = "
    select 
      " . $this->TBL_ACAO . ".codigo,
      " . $this->TBL_ACAO . ".restrito
    from " . $this->TBL_ACAO . ",
      " . $this->TBL_PERMISSAO . "
    where 
     (
        (" . $this->TBL_PERMISSAO . ".acao = " . $this->TBL_ACAO . ".codigo)
     and (
          (
            (" . $this->TBL_PERMISSAO . ".usuario =  '" . $p_usuario . "')
            and 
            (" . $this->TBL_PERMISSAO . ".entidade_codigo = '" . $p_chave . "')
            and 
            (" . $this->TBL_PERMISSAO . ".tipo_acesso = '+')
          )or 
            (" . $this->TBL_ACAO . ".restrito=0)
        )
      and 
      (" . $this->TBL_ACAO . ".entidade = '" . $p_entidade . "')
      and 
      (" . $this->TBL_ACAO . ".nome = '" . $p_acao . "')
     )
    order by  " . $this->TBL_ACAO . ".codigo, " . $this->TBL_ACAO . ".restrito";

    $this->DataBaseLink->Query($sql_ChecarPermissao);
    unset($this->DataBaseLink->Data);
    $this->DataBaseLink->ResultConsult();
    if (!empty ($this->DataBaseLink->Data))
      $tmp_Result = true;
    return $tmp_Result;
  }

  public function ListaAcaoPermissaoEntidade($p_usuario, $p_entidade)
  {

    $this->ConectaDB();
    $tmp_Result = false;
    $sql_ChecarPermissao = "
    select 
      " . $this->TBL_ACAO . ".codigo,
      " . $this->TBL_ACAO . ".restrito,
      " . $this->TBL_ACAO . ".NOME
    from " . $this->TBL_ACAO . ",
      " . $this->TBL_PERMISSAO . "
    where 
     (
        (" . $this->TBL_PERMISSAO . ".acao = " . $this->TBL_ACAO . ".codigo)
     and (
          (
            (" . $this->TBL_PERMISSAO . ".usuario =  '" . $p_usuario . "')
            and 
            (" . $this->TBL_PERMISSAO . ".entidade_codigo = '" . $p_chave . "')
            and 
            (" . $this->TBL_PERMISSAO . ".tipo_acesso = '+')
          )or 
            (" . $this->TBL_ACAO . ".restrito=0)
        )
      and 
      (" . $this->TBL_ACAO . ".entidade = '" . $p_entidade . "')
     )
    order by  " . $this->TBL_ACAO . ".codigo, " . $this->TBL_ACAO . ".restrito";



    $this->DataBaseLink->Query($sql_ChecarPermissao);
    unset($this->DataBaseLink->Data);
    $this->DataBaseLink->ResultConsult();
    if (!empty ($this->DataBaseLink->Data)) {
      $tmp_Result = $this->DataBaseLink->Data;
      foreach ($tmp_Result as $_Result) {
        $tmp_ResultLista[] = $_Result['NOME'];
        //echo '---- ' . $_Result['NOME'];
      }
      $tmp_Result = $tmp_ResultLista;
    }
    return $tmp_Result;
  }

  public function EntidadeAcaoCodigo($p_entidade, $p_acao)
  {
    $this->ConectaDB();
    $tmp_Result = null;
    $this->DataBaseLink->Executar("select " . $this->TBL_ACAO . "CODIGO FROM " . $this->TBL_ACAO . " WHERE ((" . $this->TBL_ACAO . "NOME ='" . $p_acao . "') AND (" . $this->TBL_ACAO . "ENTIDADE ='" . $p_entidade . "')) Limit 1");
    $tmpDados = $this->DataBaseLink->ResultConsult();
    if ($tmpDados[0]['CODIGO'] == "")
      $tmp_Result = null;
    else
      $tmp_Result = $tmpDados[0]['CODIGO'];


    return $tmp_Result;
  }

  public function PermissaoCodigo($p_entidade, $p_acao, $p_usuario, $p_chave = 0)
  {
    $this->ConectaDB();
    $tmp_Result = null;
    $this->DataBaseLink->Executar("select " . $this->TBL_PERMISSAO . "CODIGO from " . $this->TBL_ACAO . ",
      " . $this->TBL_PERMISSAO . "
    where 
     (
        (" . $this->TBL_PERMISSAO . ".acao = " . $this->TBL_ACAO . ".codigo)
     and 
        (" . $this->TBL_PERMISSAO . ".usuario = " . $p_usuario . ")
     and 
        (" . $this->TBL_PERMISSAO . ".entidade_codigo = " . $p_chave . ")
     and 
        (" . $this->TBL_ACAO . ".entidade = '" . $p_entidade . "')
     and 
        (" . $this->TBL_ACAO . ".nome = '" . $p_acao . "')
     ) Limit 1");
    $tmpDados = $this->DataBaseLink->ResultConsult();
    if ($tmpDados[0]['CODIGO'] == "")
      $tmp_Result = null;
    else
      $tmp_Result = $tmpDados[0]['CODIGO'];


    return $tmp_Result;
  }

  public function PermissaoEntidadeAcaoCodigo($p_entidadeAcao, $p_usuario)
  {
    $this->ConectaDB();
    if ($p_entidadeAcao == "")
      exit;
    if ($p_usuario == "")
      exit;
    $tmp_Result = null;
    $this->DataBaseLink->Executar("select " . $this->TBL_PERMISSAO . ".CODIGO from 
      " . $this->TBL_PERMISSAO . "
    where 
     (
        (" . $this->TBL_PERMISSAO . ".ACAO = '" . $p_entidadeAcao . "')
     and 
        (" . $this->TBL_PERMISSAO . ".usuario = '" . $p_usuario . "')
     ) Limit 1");
    $tmpDados = $this->DataBaseLink->ResultConsult();
    //print_r($tmpDados);
    if ($tmpDados[0]['CODIGO'] == "")
      $tmp_Result = null;
    else
      $tmp_Result = $tmpDados[0]['CODIGO'];

    return $tmp_Result;
  }

  public function IncluirPermissao($p_usuario, $p_entidade, $p_acao, $p_chave = 0)
  {
    if ($p_usuario == "")
      exit;
    if ($p_entidade == "")
      exit;
    if ($p_acao == "")
      exit;
    $tmp_Result = false;
    if (!$this->EntidadeAcaoExiste($p_entidade, $p_acao)) {
      $this->AcaoIncluir($p_entidade, $p_acao);
    }
    $tmp_CodigoAcao = $this->EntidadeAcaoCodigo($p_entidade, $p_acao);
    unset($this->DataBaseLink->Data);
    $this->DataBaseLink->Data['TIPO_ACESSO'] = "+";
    $this->DataBaseLink->Data['ENTIDADE_CODIGO'] = '0';
    $tmpPermissaoCodigo = $this->PermissaoCodigo($p_usuario, $p_entidade, $p_acao, $p_chave);
    if ($tmpPermissaoCodigo == null) {
      $this->DataBaseLink->Data['USUARIO'] = $p_usuario;
      $this->DataBaseLink->Data['ACAO'] = $tmp_CodigoAcao;
      $this->DataBaseLink->Data['DATACRIACAO'] = date('Y-m-d H:i:s');
      $this->DataBaseLink->Data['USUARIO_CRIOU'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
      $this->DataBaseLink->Data['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
      $this->DataBaseLink->Insert($this->TBL_PERMISSAO);
      $tmp_Result = true;
    } else {
      $this->DataBaseLink->Data['CODIGO'] = $tmpPermissaoCodigo;
      $condicao = " CODIGO = '" . $tmpPermissaoCodigo . "' ";
      $this->DataBaseLink->Update($this->TBL_PERMISSAO);
      $tmp_Result = true;
    }
    return $tmp_Result;
  }

  public function IncluirPermissaoCodigo($p_usuario, $p_entidadeAcao, $p_chave = 0)
  {
    if ($p_usuario == "")
      exit;
    if ($p_entidadeAcao == "")
      exit;
    $tmp_Result = false;
    $tmpPermissaoCodigo = $this->PermissaoEntidadeAcaoCodigo($p_entidadeAcao, $p_usuario);

    $usuarioCriou = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $usuarioSessao = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];

    if ($tmpPermissaoCodigo == null) {

      $sqlPermissaoIncluir = "INSERT INTO " . $this->TBL_PERMISSAO . " (CODIGO, USUARIO, ACAO, ENTIDADE_CODIGO, TIPO_ACESSO, DATACRIACAO,USUARIO_CRIOU,SESSAO)
        values (null, '" . $p_usuario . "', '" . $p_entidadeAcao . "', '0', '+', '" . date('Y-m-d H:i:s') . "', '" . $usuarioCriou . "','" . $usuarioSessao . "');";
      $this->DataBaseLink->Query($sqlPermissaoIncluir);
      //var_dump($this->DataBaseLink->Data);
      $tmp_Result = true;
    } else {
      $sqlPermissaoAlterar = "UPDATE " . $this->TBL_PERMISSAO . " SET ENTIDADE_CODIGO='0', TIPO_ACESSO='+', USUARIO_CRIOU='" . $usuarioCriou . "', SESSAO='" . $usuarioSessao . "'
      WHERE 
        " . $this->TBL_PERMISSAO . ".CODIGO='" . $tmpPermissaoCodigo . "' ;";
      $this->DataBaseLink->Query($sqlPermissaoAlterar);
      $tmp_Result = true;
    }
    return $tmp_Result;
  }


  public function RevogarPermissao($p_usuario, $p_entidade, $p_acao, $p_chave = 0)
  {
    if ($p_usuario == "")
      exit;
    if ($p_entidade == "")
      exit;
    if ($p_acao == "")
      exit;
    $tmp_Result = false;
    if (!$this->EntidadeAcaoExiste($p_entidade, $p_acao)) {
      $this->AcaoIncluir($p_entidade, $p_acao);
    }
    $tmp_CodigoAcao = $this->EntidadeAcaoCodigo($p_entidade, $p_acao);
    unset($this->DataBaseLink->Data);
    $this->DataBaseLink->Data['TIPO_ACESSO'] = "-";
    $this->DataBaseLink->Data['ENTIDADE_CODIGO'] = '0';
    $tmpPermissaoCodigo = $this->PermissaoCodigo($p_usuario, $p_entidade, $p_acao, $p_chave);
    if ($tmpPermissaoCodigo == null) {
      $this->DataBaseLink->Data['USUARIO'] = $p_usuario;
      $this->DataBaseLink->Data['ACAO'] = $tmp_CodigoAcao;
      $this->DataBaseLink->Data['DATACRIACAO'] = date('Y-m-d H:i:s');
      $this->DataBaseLink->Data['USUARIO_CRIOU'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
      $this->DataBaseLink->Data['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
      $this->DataBaseLink->Insert($this->TBL_PERMISSAO);
      $tmp_Result = true;
    } else {
      $this->DataBaseLink->Data['CODIGO'] = $tmpPermissaoCodigo;
      $condicao = " CODIGO = '" . $tmpPermissaoCodigo . "' ";
      $this->DataBaseLink->Update($this->TBL_PERMISSAO);
      $tmp_Result = true;
    }
    return $tmp_Result;
  }

  public function RevogarPermissaoCodigo($p_usuario, $p_entidadeAcao, $p_chave = 0)
  {
    if ($p_usuario == "")
      exit;
    if ($p_entidadeAcao == "")
      exit;
    $tmp_Result = false;
    $tmpPermissaoCodigo = $this->PermissaoEntidadeAcaoCodigo($p_entidadeAcao, $p_usuario);

    $usuarioCriou = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $usuarioSessao = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];

    if ($tmpPermissaoCodigo == null) {

      $sqlPermissaoIncluir = "INSERT INTO " . $this->TBL_PERMISSAO . " (CODIGO, USUARIO, ACAO, ENTIDADE_CODIGO, TIPO_ACESSO, DATACRIACAO,USUARIO_CRIOU,SESSAO)
        values (null, '" . $p_usuario . "', '" . $p_entidadeAcao . "', '0', '-', '" . date('Y-m-d H:i:s') . "', '" . $usuarioCriou . "','" . $usuarioSessao . "');";
      $this->DataBaseLink->Query($sqlPermissaoIncluir);
      //var_dump($this->DataBaseLink->Data);
      $tmp_Result = true;
    } else {
      $sqlPermissaoAlterar = "UPDATE " . $this->TBL_PERMISSAO . " SET ENTIDADE_CODIGO='0', TIPO_ACESSO='-', USUARIO_CRIOU='" . $usuarioCriou . "', SESSAO='" . $usuarioSessao . "'
      WHERE 
        " . $this->TBL_PERMISSAO . ".CODIGO='" . $tmpPermissaoCodigo . "' ;";
      $this->DataBaseLink->Query($sqlPermissaoAlterar);
      $tmp_Result = true;
    }
    return $tmp_Result;
  }

  private function ConectaDB()
  {
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB(
        $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE']['HOSTNAME']
        ,
        $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE']['USERNAME']
        ,
        $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE']['PASSWORD']
        ,
        $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE']['DATABASENAME']
        ,
        $this->SISTEMA_['CONFIG']['PERMISSAO']['DATABASE']['TIPODB']
      );
  }

}
