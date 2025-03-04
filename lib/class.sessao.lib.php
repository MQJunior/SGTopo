<?php
/**
 * @file class.sessao.lib.php
 * @name Sessao
 * @desc
 *   Gerenciador de Sess�es
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    2.0.0 
 * @copyright  Copyright � 2006, Marcio Queiroz Jr.
 * @package    sistema
 * @subpackage Sessao
 * @todo       
 *
 *
 * @date 2023-11-10  v. 2.0.0
 *
 */

class Sessao
{
  public $Config = null;                  // Array - Configurações da sessão
  protected $SISTEMA_ = null;             // Array - Variável do Sistema
  private $Nome = '';                     // String - Nome da Sessão
  private $TempoExpiracao = 100;          // Int - Tempo de Expiração da Sessão em minutos (padrão 100 minutos ou 1 hora e 40 minutos)
  private $Limitacao = 'private';          // String - Limitação: [nocache|private|public;] + info: http://www.php.net - função: session_cache_limiter()
  private $SessaoIniciada = false;        // Bool - Variável de controle, define o status da sessão
  private $Autenticacao = true;           // Bool - Indica se a Sessão é autenticada (Protegida por senha)
  private $ComandoAutenticacao = 'Logar'; // String - Indica o comando a ser chamado para efetuar a autenticação
  private $EntidadeDB = 'TBL_SESSOES';    // String - Nome da Tabela no Banco de Dados
  private $DataBaseConfig = null;         // Array ou Null - Vetor com as configurações de acesso ao banco de dados
  private $DataBaseLink = null;           // Link ou Null - Link de acesso ao Banco de Dados
  private $DirSaveSessoes = '';           // String - Local onde serão salvos os arquivos de sessão (se não for setado, será o diretório definido no PHP.ini)
  protected $ID = "";                     // String - ID da Sessão (Implementar)
  protected $SID = "";                     // String - SID da Sessão (Implementar)
  protected $DataCriacao = 0;             // Int - Data/Hora de Início da Sessão
  protected $IPCliente = "";              // String - IP do Cliente
  protected $UltimoEvento = 0;            // Int - Data/Hora do Último evento na Sessão
  protected $DataFechamento = 0;          // Int - Data/Hora do encerramento da Sessão
  public $Autenticado = false;           // Bool - Indicador se está autenticado ou não (Logado)

  protected $TBL_USUARIOS = null;

  protected $TempoExpiracaoNome = '';

  public function __construct($p_Sistema)
  {

    $this->SISTEMA_ = $p_Sistema;
    $this->SISTEMA_['SESSAO']['CLIENTE']['DATAHORA_ULTIMOEVENTO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
    $this->Config = $this->SISTEMA_['CONFIG']['SESSAO'];
    $this->TBL_USUARIOS = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_USUARIO'];

    $this->Nome = $this->Config['GERAL']['NOME'];
    $this->TempoExpiracaoNome = $this->Config['GERAL']['TEMPO_EXPIRACAO'];
    $this->Limitacao = $this->Config['GERAL']['LIMITACAO'];
    $this->Autenticacao = $this->Config['GERAL']['SESSAO_AUTENTICACAO'];
    //$this->ComandoAutenticacao = $this->Config['GERAL']['COMANDO_AUTENTICACAO'];
    $this->EntidadeDB = $this->Config['DATABASE']['ENTIDADE_DB'];
    $this->DataBaseConfig = $this->Config['DATABASE'];
    $this->DirSaveSessoes = $this->Config['GERAL']['LOCAL_DIR'];



    $tmpSID = null;
    if (isset($_REQUEST['SID'])) {
      $tmpSID = $_REQUEST['SID'];
    }

    if (is_null($tmpSID))
      if (isset($_REQUEST['API_KEY'])) {
        $tmpApiKey = $_REQUEST['API_KEY'];
        $tmpSID = $this->ApiKeyToSID($tmpApiKey);
      }

    $this->ConectaDB();

    $tmpCodigoSessao = null;
    if (is_null($tmpSID)) {
      $this->Bloquear();
    } else {
      $tmpCodigoSessao = $this->SessaoExiste($tmpSID);
    }

    //$debug_tmp=print_r($Z2Sessao,true);
    /*
    $LogArray['REQUEST'] = $_REQUEST;
    $LogArray['SESSION'] = $_SESSION;
    $LogArray['COOKIE'] = $_COOKIE;
    $LogArray['SESSAO_CODIGO'] = $tmpCodigoSessao;
  */

    $this->IdentificarUserAgent();
    $this->getIP();

    $this->setNome();
    $this->setDirSaveSessoes();                          # Seta o Local Dir onde ser� salvo os arquivos da Sessão

    $this->setLimiter();                                 # Seta o Limiter
    $this->setTempoExpiracao();                          # Seta o Tempo de Expira��o 

    //session_start();

    /* VERIFICA SE A SESSAO EXISTE */

    /* VERIFICA SE FOI ENVIADO UMA SESSAO ID */
    /* CASO N�O FOI ENVIADO SESSAO ID */

    if ($tmpSID == NULL) {
      unset($this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS']);
      $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADEPADRAO'];
      $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ACAOPADRAO'];
      if ((isset($_REQUEST['SysEntidade'])) && (isset($_REQUEST['SysEntidadeAcao']))) {
        if (
          ($_REQUEST['SysEntidade'] == $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADELOGIN']) &&
          ($_REQUEST['SysEntidadeAcao'] == $this->SISTEMA_['CONFIG']['SISTEMA']['ACAOLOGIN'])
        ) {
          $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $_REQUEST['SysEntidade'];
          $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = $_REQUEST['SysEntidadeAcao'];
        } else {
          die(__LINE__ . ' - ' . __FILE__ . ' \n==> NOT SID - SET Entidade = ' . $_REQUEST['SysEntidade'] . '\n Acao= ' . $_REQUEST['SysEntidadeAcao']);
          unset($_REQUEST);
        }
      } else {

        unset($_REQUEST);
      }
    } else {
      //var_dump($this->SISTEMA_); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
      //($this->Config['GERAL']['COMANDO_LOGIN'])
      // VERIFICAR A VALIDADE DO SID
      // CARREGAR AS INFORMA�OES DA SESSAO DE ACORDO COM O SID
      $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'] = $tmpSID;
      $this->getDadosSessao();
      if ($this->getExpirado()) {
        $this->FecharSessao($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO']);
        unset($this->SISTEMA_['SESSAO']['CLIENTE']);
        die('Sessao Expirada! > ' . __FILE__ . ' > ' . __LINE__);
      }
      $this->GravaUltimaModificacao();


    }



  }
  /**
   * metodo chamado no encerramento da classe
   * access private
   */
  function __destruct()
  {
    if ($this->get('Autenticado') == false)
      $this->destroy();
    //$this->logout();
  }

  public function ApiKeyToSID($p_ApiKey = null)
  {
    return $p_ApiKey;
  }
  /**
    Imprime String quando a classe for convertida para uma String
    @return String Retorna a String desejada
    access public
   */
  public function __toString()
  {
    return "";
  }
  /**
   * Retorna o Vetor Sistema apos processa-lo
   * @return array Array Sistema
   * access public
   */
  public function getSISTEMA()
  {
    //print_r($_REQUEST); print_r($_SESSION); print_r($this->SISTEMA_); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
    //$this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = $this->Autenticado;
    //sprint_r($_REQUEST); print_r($_SESSION); print_r($this->SISTEMA_); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
    return $this->SISTEMA_;
  }


  //  Inicializa uma nova Sessão, ou restaura a anterior

  public function Inicializar($p_Sistema = null)
  {
    if ($p_Sistema != null)
      $this->SISTEMA_ = $p_Sistema;

    // $this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = $this->getAutenticado();

    if (isset($this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'])) {
      if ($this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO']) {


        // Existe alguma Sessao Aberta para este Usuario
        $this->getIDSessaoAbertaUsuario();
        // Caso Exista, a Sessao expirou?
        if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO']))
          if ($this->getExpirado()) {
            $this->FecharSessao($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO']);
            unset($this->SISTEMA_['SESSAO']['CLIENTE']);
          }

        if (!isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'])) {
          $this->set("USUARIO_ID", $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO']);
          $this->set("USUARIO_NOME", $this->SISTEMA_['SESSAO']['USUARIO']['NOME']);
          $this->setSID();
          $this->GravaSessao();

        } else {
          // Gravar Modificacao
          if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'])) {
            $this->GravaUltimaModificacao();
            // die('Gravar Modificacao');
          }
        }

      }

    }



  }
  /**
   * Retorna se a chave fornecida foi setada.
   * param string Chave para verificacao
   * return boolean 
   * access public
   */
  public function is_set($p_chave)
  {
    return isset($_SESSION[$this->Nome][$p_chave]);          # Retorna True ou False caso a variavel tenha sido setada
  }
  /**
   * Obt�m-se o ID da sessao aberta pelo Usuario
   * access private
   */
  private function getIDSessaoAbertaUsuario()
  {
    $tmp_cfg_bd = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE'];
    $tmp_ConexaoDB = $this->DataBaseLink;

    $tmp_SQL_IDSessaoAbertaUsuario =
      "select
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".SESSAO_UID,
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CODIGO,
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAINICIO,
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAMODIFICACAO,
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".IPCLIENTE,
     " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CLIENTENOME
    from
        " . $tmp_cfg_bd['ENTIDADE_DB'] . "
    where
        " . $tmp_cfg_bd['ENTIDADE_DB'] . ".usuario=" . $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'] . " and " . $tmp_cfg_bd['ENTIDADE_DB'] . ".datafim is null
        order by " . $tmp_cfg_bd['ENTIDADE_DB'] . ".datainicio desc limit 1";



    $tmp_ConexaoDB->Executar($tmp_SQL_IDSessaoAbertaUsuario);
    $tmp_ConexaoDB->ResultConsult();
    if (is_array($tmp_ConexaoDB->Data)) {

      if ($tmp_ConexaoDB->Data != "") {
        if ((isset($tmp_ConexaoDB->Data[0])) and (is_array($tmp_ConexaoDB->Data[0]))) {
          if ($tmp_ConexaoDB->Data[0]['SESSAO_UID'] == !null) {
            $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'] = $tmp_ConexaoDB->Data[0]['SESSAO_UID'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['DATAINICIO'] = $tmp_ConexaoDB->Data[0]['DATAINICIO'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['DATAMODIFICACAO'] = $tmp_ConexaoDB->Data[0]['DATAMODIFICACAO'];
            //var_dump($this->SISTEMA_); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
          }
          if ($tmp_ConexaoDB->Data[0]['CODIGO'] == !null)
            $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'] = $tmp_ConexaoDB->Data[0]['CODIGO'];
        }
      }
    }
    unset($tmp_ConexaoDB);
    unset($tmp_cfg_bd);
    unset($tmp_SQL_IDSessaoAbertaUsuario);
  }
  /**
   * Obt�m-se o ID da sessao aberta pelo Usuario
   * access private
   */
  private function getDadosSessao()
  {

    if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'])) {
      $tmp_ConexaoDB = $this->DataBaseLink;
      $tmp_cfg_bd = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE'];
      $tmp_SQL = "select
      
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CODIGO,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".USUARIO,
       " . $tmp_cfg_bd['ENTIDADE_USUARIO'] . ".NOME,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".SESSAO_UID,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CLIENTENOME,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".IPCLIENTE,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAINICIO,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAMODIFICACAO,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAFIM,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".MULTI_ACESSO,
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".EXP_INFINITA
      from
          " . $tmp_cfg_bd['ENTIDADE_DB'] . "
      join " . $tmp_cfg_bd['ENTIDADE_USUARIO'] . " on " . $tmp_cfg_bd['ENTIDADE_DB'] . ".USUARIO = " . $tmp_cfg_bd['ENTIDADE_USUARIO'] . ".CODIGO
      where
        " . $tmp_cfg_bd['ENTIDADE_DB'] . ".sessao_uid='" . $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'] . "'" .
        " limit 1";

      $tmp_ConexaoDB->Executar($tmp_SQL);
      $tmp_ConexaoDB->ResultConsult();
      if (is_array($tmp_ConexaoDB->Data)) {
        if ($tmp_ConexaoDB->Data != "") {
          if ($tmp_ConexaoDB->Data[0]['CODIGO'] == !null) {
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['SESSAO_UID'] = $tmp_ConexaoDB->Data[0]['SESSAO_UID'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['SESSAO_ID'] = $tmp_ConexaoDB->Data[0]['SESSAO_UID'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'] = $tmp_ConexaoDB->Data[0]['CODIGO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['SESSAO_CODIGO'] = $tmp_ConexaoDB->Data[0]['CODIGO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['USUARIO'] = $tmp_ConexaoDB->Data[0]['USUARIO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['SISTEMANOME'] = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['NOME'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['USUARIOLOGIN'] = $tmp_ConexaoDB->Data[0]['NOME'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CLIENTENOME'] = $tmp_ConexaoDB->Data[0]['CLIENTENOME'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['IPCLIENTE'] = $tmp_ConexaoDB->Data[0]['IPCLIENTE'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['DATAINICIO'] = $tmp_ConexaoDB->Data[0]['DATAINICIO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['DATAMODIFICACAO'] = $tmp_ConexaoDB->Data[0]['DATAMODIFICACAO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['DATAFIM'] = $tmp_ConexaoDB->Data[0]['DATAFIM'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['MULTI_ACESSO'] = $tmp_ConexaoDB->Data[0]['MULTI_ACESSO'];
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['EXP_INFINITA'] = $tmp_ConexaoDB->Data[0]['EXP_INFINITA'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'] = $tmp_ConexaoDB->Data[0]['SESSAO_UID'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'] = $tmp_ConexaoDB->Data[0]['CODIGO'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['DATAINICIO'] = $tmp_ConexaoDB->Data[0]['DATAINICIO'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['DATAMODIFICACAO'] = $tmp_ConexaoDB->Data[0]['DATAMODIFICACAO'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['DATAFIM'] = $tmp_ConexaoDB->Data[0]['DATAFIM'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['MULTI_ACESSO'] = $tmp_ConexaoDB->Data[0]['MULTI_ACESSO'];
            $this->SISTEMA_['SESSAO']['CLIENTE']['EXP_INFINITA'] = $tmp_ConexaoDB->Data[0]['EXP_INFINITA'];
            $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'] = $tmp_ConexaoDB->Data[0]['USUARIO'];
            $this->set('CODIGO', $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO']);
            $this->set('DATAINICIO', $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['DATAINICIO']);

          } else {
            $this->SISTEMA_['SESSAO']['DATABASE']['DATA'] = null;
          }

        }
      }
      unset($tmp_ConexaoDB);
    }
  }

  public function ConectaDB()
  {
    $tmp_cfg_bd = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE'];
    $tmp_ConexaoDB = new ConexaoDB(
      $tmp_cfg_bd['HOSTNAME']
      ,
      $tmp_cfg_bd['USERNAME']
      ,
      $tmp_cfg_bd['PASSWORD']
      ,
      $tmp_cfg_bd['DATABASENAME']
      ,
      $tmp_cfg_bd['TIPODB']
    );
    $this->DataBaseLink = $tmp_ConexaoDB;

  }


  public function SessaoExiste($p_SESSAO_UID)
  {

    $tmp_ConexaoDB = $this->DataBaseLink;
    $tmp_cfg_bd = $this->Config['DATABASE'];

    $tmp_SQL_SessaoExiste = "select
      
       " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CODIGO
      from
          " . $tmp_cfg_bd['ENTIDADE_DB'] . "
      where
          " . $tmp_cfg_bd['ENTIDADE_DB'] . ".sessao_uid='" . $p_SESSAO_UID . "'";

    $tmp_ConexaoDB->Executar($tmp_SQL_SessaoExiste);
    $tmp_ConexaoDB->ResultConsult();
    $tmp_Result = null;
    if (is_array($tmp_ConexaoDB->Data))
      if ($tmp_ConexaoDB->Data != "")
        if ($tmp_ConexaoDB->Data[0]['CODIGO'] != null)
          $tmp_Result = $tmp_ConexaoDB->Data[0]['CODIGO'];
    return $tmp_Result;
  }


  // Grava a sessao com as informa��es de data inicial, usuario e UID; 

  public function GravaSessao()
  {

    $tmp_ConexaoDB = $this->DataBaseLink;
    unset($tmp_ConexaoDB->Data);
    $tmp_ConexaoDB->Data['USUARIO'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $tmp_ConexaoDB->Data['SESSAO_UID'] = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
    $tmp_ConexaoDB->Data['IPCLIENTE'] = $this->getIP();
    $tmp_ConexaoDB->Data['CLIENTENOME'] = $this->SISTEMA_['SESSAO']['USUARIO']['NOME'] . "@" . $tmp_ConexaoDB->Data['IPCLIENTE'];
    //$tmp_ConexaoDB->Data['DATAINICIO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);


    $tmp_ConexaoDB->Insert($this->SISTEMA_['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_DB']);
    $this->ID = $tmp_ConexaoDB->Id();
    $this->set('SESSAO_CODIGO', $this->ID);
    $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'] = $this->ID;
    unset($tmp_ConexaoDB);
  }

  private function FecharSessao($p_CODIGO)
  {

    $tmp_cfg_bd = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE'];
    $tmp_ConexaoDB = $this->DataBaseLink;
    $tmp_SessaoCodigo = $p_CODIGO;

    $tmp_SQL_GravaDataFinal =
      "update " . $tmp_cfg_bd['ENTIDADE_DB'] . " SET
        " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAFIM = NOW()
      where
          " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CODIGO=" . $tmp_SessaoCodigo;

    $tmp_ConexaoDB->Executar($tmp_SQL_GravaDataFinal);

  }

  /**
   * Obt�m-se a Sessão teve seu tempo expirado ou n�o.
   * access public
   */
  public function getExpirado()
  {
    $tmpResult = false;
    $tmpUltimoEvento = strtotime($this->SISTEMA_['SESSAO']['CLIENTE']['DATAMODIFICACAO']);
    $tmpTempoExpiracao = $this->SISTEMA_['CONFIG']['SESSAO']['GERAL']['TEMPO_EXPIRACAO'] * 60;
    $TempoFinal = $tmpUltimoEvento + $tmpTempoExpiracao;


    if ($TempoFinal < time())
      $tmpResult = true;
    if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['EXP_INFINITA']))
      if ($this->SISTEMA_['SESSAO']['CLIENTE']['EXP_INFINITA'] == '1')
        $tmpResult = false;
    return $tmpResult;

  }
  /**
   * Libera a Ses�o Corrente.
   * access public
   */
  public function Liberar()
  {
    $this->Autenticado = true;                                    # Seta-se o valor de Autenticado
    $this->set('Autenticado', true);               				  # Seta-se o valor de Autenticado na Sessão
    $this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = true;
    $this->setAutenticado();                                      # Seta-se o valor de Autenticado
    //$this->setID();


    //$this->IPCliente = $_SERVER['REMOTE_ADDR'];
    //$this->set('IP',$this->IPCliente);
  }
  /**
   * Bloqueia a Ses�o Corrente.
   * access private
   */
  public function Bloquear()
  {
    $this->Autenticado = false;                                   # Seta-se o valor de Autenticado
    $this->set('Autenticado', $this->Autenticado);                 # Seta-se o valor de Autenticado na Sessão
    $this->setAutenticado();                                      # Seta-se o valor de Autenticado
  }
  /**
   * Autentica a Ses�o Corrente.
   * access public
   */
  public function Autenticar()
  {
    /*
     echo "<script type=\"text/javascript\">
      parent.window.location = '".$this->AutenticacaoURL."';
    </script>";
    */
    /*		if ($this->AutenticacaoURL !=  ){
           header('HTTP/1.0 204 No Content');
           header('Content-Length: 0',true);
           header('Content-Type: text/html',true);
          //header('Location:'.$this->AutenticacaoURL);
      //	}
        //include_once($this->AutenticacaoURL);
           //die($this->AutenticacaoURL);                        # Chama URL para Autentica��o
        */
  }

  ############################################################################
#                                  setAutenticado                          #
#--------------------------------------------------------------------------#
# Descrição: Seta-se o valor de Autenticao.                                #
#                                                                          #
#--------------------------------------------------------------------------#
#                                   |                                      #
############################################################################
  private function setAutenticado()
  {
    if ($this->Autenticado == "")                              # Verifica se Autenticado est� vazio
    {
      $this->Autenticado = false;                           # Caso seja vazio seta-se o valor "false"
    }
    $this->set('Autenticado', $this->Autenticado);             # Seta-se o valor de Autenticado na Sessão
  }
  ############################################################################
#                                getAutenticado                            #
#--------------------------------------------------------------------------#
# Descrição: Obt�m-se o valor de Autenticado                               #
#                                                                          #
#--------------------------------------------------------------------------#
#                                   |                                      #
############################################################################
  public function getAutenticado()
  {
    $this->Autenticado = $this->get('Autenticado');            # Obt�m-se o valor de Autenticado da Sessão
    if ($this->Autenticado == "")                              # Verifica se Autenticado est� vazio
    {
      $this->Autenticado = false;                            # Caso esteja vazio ent�o seta-se o valor "false"
    }

    if (!$this->Autenticacao)
      $this->Autenticado = true;

    return $this->Autenticado;                                 # Retornar o valor de Autenticado do M�todo
  }
  /**
   * Seta o local onde ser�o salvos os arquivos da Sessão.
   * access private
   */
  private function setDirSaveSessoes()
  {
    if ($this->DirSaveSessoes == '') {                                # Verifica se o Diret�rio dos Arquivos de Sessão est� definido
      $this->DirSaveSessoes = session_save_path();               # Caso n�o esteja definido obt�m-se o valor padr�o PHP
    } else {
      if ($this->DirSaveSessoes) {                                 # Caso esteja definido ent�o
        session_save_path($this->DirSaveSessoes);              # Seta-se o endere�o do diret�rio de arquivos de Sessão
        $this->set('DirSessao', $this->DirSaveSessoes);
      }
    }
    ini_set('session.save_path', $this->DirSaveSessoes);
  }
  /**
   * Seta o o Tempo para a expira��o 
   * access private
   */
  private function setTempoExpiracao()
  {
    if ($this->TempoExpiracao == '') {                                                        # Verifica se o Tempo de Expira��o foi definido
      $this->TempoExpiracao = session_cache_expire();                                    # Caso n�o seja setado, obt�m-se a configura��o padr�o
      $this->set('TempoExpiracao', $this->TempoExpiracao);                               # Seta na Sessão o tempo da expira��o
    } else {
      if (is_int($this->TempoExpiracao))                                                 # Caso o Tempo de expira��o tenha sido setado, e o valor sendo inteiro
      {
        @$this->set('TempoExpiracao', session_cache_expire($this->TempoExpiracao));     # Seta-se o tempo da expira��o para a Sessão e define o mesmo para a Sessão
      }
    }
  }
  /**
   * Seta o ID da Sessão.
   * access private
   */
  private function setSID()
  {
    $tmp_SID = "";
    if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID']))
      $tmp_SID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

    if ((isset($_REQUEST['SID'])) && ($tmp_SID == ""))
      $tmp_SID = $_REQUEST['SID'];

    if ($tmp_SID == "") {

      $tmp_SID = geraAPIKey($this->SISTEMA_['CONFIG']['SESSAO']['GERAL']['PALAVRA_CHAVE']);

    }

    $this->SID = $tmp_SID;
    $this->set('SID', $this->ID);

    $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'] = $this->SID;
  }


  public function getID()
  {
    if (!$this->is_set('SID'))                           # Verifica se a Sessão existe e o Id da mesma
      $this->setID();
    $this->ID = $this->get('SID');                                                      # Obt�m-se o ID da Sessão
    return $this->ID;
  }
  /**
   * Obtem o IP do Cliente da Sessão.
   * access private
   */
  private function getIP()
  {
    if ($this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO'] == 0) {
      if (isset($_SERVER['REMOTE_ADDR'])) {
        $tmp_IPCliente = $_SERVER['REMOTE_ADDR'];
      } else {
        $tmp_IPCliente = "127.0.0.1";
      }


    }
    if ($this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO'] == 2) {
      $tmp_IPCliente = $_SERVER['REMOTE_ADDR'];
    }
    if ($this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO'] == 1) {
      $tmp_arrayIP = explode(" ", $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME']);
      $this->SISTEMA_['TERMINAL']['CLIENTE']['IP'] = $tmp_arrayIP[0];
      if ($this->SISTEMA_['TERMINAL']['CLIENTE']['USERAGENT'] == "SHELL_SSH") {
        $tmp_IPCliente = $_SERVER['SSH_CLIENT'];

      } else {
        $tmp_IPCliente = $_SERVER['USER'];
      }
    } else {
      $tmp_IPCliente = $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'];
      $this->SISTEMA_['TERMINAL']['CLIENTE']['IP'] = $tmp_IPCliente;
    }
    $this->IPCliente = $tmp_IPCliente;
    if (strlen($this->IPCliente) < 5)
      $this->IPCliente = "127.0.0.1";
    return $this->IPCliente;
  }


  protected function GravaUltimaModificacao()
  {
    $tmp_cfg_bd = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE'];
    $tmp_ConexaoDB = $this->DataBaseLink;
    $tmp_SessaoCodigo = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_CODIGO'];

    $tmp_SQL_GravaUltimaModificacao =
      "update " . $tmp_cfg_bd['ENTIDADE_DB'] . " SET
      " . $tmp_cfg_bd['ENTIDADE_DB'] . ".DATAMODIFICACAO = NOW()
    where
        " . $tmp_cfg_bd['ENTIDADE_DB'] . ".CODIGO=" . $tmp_SessaoCodigo;



    $tmp_ConexaoDB->Executar($tmp_SQL_GravaUltimaModificacao);
  }
  ############################################################################
#                            setDataFechamento                             #
#--------------------------------------------------------------------------#
# Descrição: Seta a data que foi encerrada a Sessão                        #
#                                                                          #
#--------------------------------------------------------------------------#
#                                   |                                      #
############################################################################   
  private function setDataFechamento()
  {
    $this->DataFechamento = time();                                                       # Seta-se a Data/Hora que a Sessão foi encerrada
    if ($this->is_set($this->Nome))                                                   # Verifica se a Sessão existe
    {
      $this->set('DataFechamento', $this->DataFechamento);                               # Seta-se a Data/Hora do encerramento da Sessão
    }
  }
  ############################################################################
#                               setUltimoEvento                            #
#--------------------------------------------------------------------------#
# Descrição: Seta a Data/Hora do �ltimo evento na Sessão.                  #
#                                                                          #
#--------------------------------------------------------------------------#
#                                   |                                      #
############################################################################
  private function setUltimoEvento()
  {
    $this->UltimoEvento = time();                                         # Seta-se a Data/Hora do �ltimo evendo da Sessão
    $this->set('UltimoEvento', $this->UltimoEvento);                       # Seta-se a Data/Hora do �ltimo evendo na Sessão
  }
  /**
   * Obtem a data de Cria��o da Sessão.
   * access private
   */
  private function getDataCriacao()
  {
    $this->DataCriacao = $this->get('DataCriacao');                      # Obt�m-se a Data/Hora da Inicializa��o da Sessão
  }
  /**
   * Seta a Data/Hora da inicializa��o da Sessão.
   * access private
   */
  private function setDataCriacao()
  {
    $this->DataCriacao = time();                                       # Seta-se a Data/Hora da Inicializa��o da Sessão
    $this->set('DataCriacao', $this->DataCriacao);                      # Seta-se a Data/Hora da Inicializa��o na Sessão
  }
  /**
   * Seta o Nome da Sessão.
   * access private
   */
  private function setNome()
  {
    if ($this->Nome == '')
      die("� Necess�rio informar o nome da Sessão.");       # Verifica se o nome foi setado
    session_name($this->Nome);         # Seta-se o nome da Sessão
  }
  /**
   * Seta o tipo Limiter (cache) da Sessão.
   * access private
   */
  private function setLimiter()
  {
    if ($this->Limitacao != '') {                                   # Verifica se a Limita��o foi setada
      session_cache_limiter($this->Limitacao);                # Caso tenha sido, ent�o seta-se a Limita��o do Cache da Sessão
    } else {
      $this->Limitacao = session_cache_limiter();             # Sen�o obt�m-se o valor Padr�o
    }
  }
  /**
   * Seta um valor a uma determinada Chave. 
   * access public
   */
  public function set($p_chave, $p_valor)
  {
    $_SESSION[$this->Nome][$p_chave] = $p_valor;                         # Seta o valor na Chave Informada
  }
  /**
   * Apaga um valor de uma determinada Chave.
   * access public
   */
  public function un_set($p_chave)
  {
    unset($_SESSION[$this->Nome][$p_chave]);                           # Apaga-se o valor e chave determinado
  }
  /**
   * Metodo destrutor da classe.
   * access public
   */
  public function destroy()
  {
    unset($_SESSION);                                     # Apaga-se todas os valores e chaves da Sessão
    @session_destroy(); 									 # Destr�i todos os dados registrados em uma Sessão
  }
  /**
   * Metodo para obter valores das chaves fornecida.
   * access public
   */
  public function get($p_chave)
  {
    if ($this->is_set($p_chave)) {                  # Verifica se a Chave existe e est� setada
      return $_SESSION[$this->Nome][$p_chave];              # Obt�m-se o valor da chave fornecida
    }
  }

  /**
   * Fecha a Sessão e limpa os valores e seta hora fechamento.
   * access public
   */
  public function logout()
  {
    $this->setUltimoEvento();
    $this->setDataFechamento();
    $this->GravaFechamento();
    $this->Autenticado = false;
    $this->destroy();
  }

  /**
   * Grava a data/hora do fechamento da Sessão.
   * access public
   */
  public function GravaFechamento()
  {
    if ($this->is_set('SESSAO_CODIGO')) {
      //include_once($this->CaminhoConfigEntidade);
      //include_once($this->CaminhoEntidade);	
      //$tblSessao = new ConexaoDB();
      //$tblSessao->consultar($this->get('SESSAO_CODIGO'));
      //$tblSessao->setDATAFIM(date(SYS_DATA_HORA_ARMAZENAMENTO_FORMATO));
      //$tblSessao->alterar();
    }
  }
  /**
   * Identifica o tipo de browser do cliente- user agent
   * @return void
   * @access private
   */
  private function IdentificarUserAgent()
  {
    //print_r($_SERVER);
    $tmp_Agente = 'WEB - HTML 4.0';
    $tmp_TipoSaida = 0; // 0-HTML5;1-TEXTO;2-JSON(API);3-Windows
    /* Condicoes para Terminal SHELL  */
    if (array_key_exists('TERM', $_SERVER)) {
      if (array_key_exists('SHELL', $_SERVER)) {
        $tmp_Agente = 'SHELL';
        $tmp_TipoSaida = 1;
        $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['USER'];
        /* Condicoes para Terminal SHELL -SSH */
        if (array_key_exists('SSH_CLIENT', $_SERVER)) {
          $tmp_Agente = 'SHELL_SSH';
          $tmp_TipoSaida = 1;
          $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['SSH_CLIENT'];
        }
        /* Condicoes para Terminal SHELL - GRAFICO */
        if (array_key_exists('WINDOWID', $_SERVER)) {
          $tmp_Agente = 'SHELL_GRAFICO';
          $tmp_TipoSaida = 1;
          $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['USER'];
        }
      }
    }

    /* Condicoes para Terminal API  
    # A implementar
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
      if (strpos($_SERVER['HTTP_USER_AGENT'], 'Indy')) {
        $tmp_Agente = 'XMLDELPHI';
        $tmp_TipoSaida = 2;
        $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['REMOTE_ADDR'];
      }
    }
    */
    /* Condicoes para Terminal Windows */
    if (array_key_exists('OS', $_SERVER)) {
      if (str_contains($_SERVER['OS'], 'Windows')) {
        $tmp_Agente = 'CMD_WINDOWS';
        $tmp_TipoSaida = 3;
        $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['COMPUTERNAME'];
      }
    }

    //echo $tmp_Agente;
    //print_r($_SERVER);
    $this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO'] = $tmp_TipoSaida;
    $this->SISTEMA_['TERMINAL']['CLIENTE']['USERAGENT'] = $tmp_Agente;
    if ($tmp_TipoSaida == 0) {
      if (isset($_SERVER['REMOTE_ADDR'])) {
        $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = $_SERVER['REMOTE_ADDR'];
      } else {
        $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'] = "127.0.0.1";
      }
    }
    $this->IPCliente = $this->SISTEMA_['TERMINAL']['CLIENTE']['CLIENTE_NOME'];
    $this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO_SAIDA'] = $tmp_TipoSaida;
    $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_MODELO'][$tmp_TipoSaida];
    $this->SISTEMA_['LAYOUT'] = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'];

  }

}
