<?php
/**
 * Arquivo
 *
 * API para manipulacao de arquivos
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0.1
 * @copyright Copyright © 2006, Marcio Queiroz Jr.
 * @package sistema
 * @subpackage arquivo
 *
 * @date 2011-10-23
 * @update 2016-07-27
 *   - Modificacao da documentacao
 * @update 2016-07-28
 *   - Remocao da funcao: __toString
 *
 *
 * @todo   
 *      Implementar funcoes para Upload
 *
 */
class logAtividade
{
  private $SISTEMA_;

  private $TBL_LOG = "";
  private $LOCAL_LOG = "";
  private $ARQUIVO_NOME_LOG = "";

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

  private $UsuarioCodigo = -1;
  private $IpCliente = null;
  private $SessaoCodigo = null;
  private $EntidadeNome = null;
  private $AcaoNome = null;
  public $ChaveRegistro = null;



  public function getSISTEMA()
  {
    return $this->SISTEMA_;
  }

  function __construct($p_SISTEMA)
  {
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['LOG']['DATABASE'];
    $this->TBL_LOG = $this->DataBaseConfig['ENTIDADE_DB']['TBL_LOG'];
    $this->LOCAL_LOG = $this->SISTEMA_['CONFIG']['LOG']['LOCAL']['DIR'];
    $this->ARQUIVO_NOME_LOG = $this->SISTEMA_['CONFIG']['LOG']['LOCAL']['ARQUIVO_NOME'];
  }
  function __destruct()
  {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }
  private function ConectaDB()
  {
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['LOG']['DATABASE'];
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
  private function SalvarArquivo()
  {
    $fp = @fopen($this->LOCAL_LOG . $this->ARQUIVO_NOME_LOG . "_" . $this->SessaoCodigo . '.log', 'a');
    $ConteudoArquivo = implode('', array_map(create_function('$key, $value', 'return $key.":".$value." # ";'), array_keys($this->DataBaseLink->Data), array_values($this->DataBaseLink->Data)));
    if (isset($this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS'])) {
      $tmpParametros = $this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS'];
      unset($tmpParametros['XMLHTML']);
      unset($tmpParametros['SID']);
      unset($tmpParametros['method']);
      unset($tmpParametros['txtChaveRegistro']);
      if (is_array($tmpParametros))
        $ConteudoArquivo .= "{" . implode('', array_map(create_function('$key, $value', 'if(is_array($value))$value=implode(\';\',$value); return $key."=".$value." # ";'), array_keys($tmpParametros), array_values($tmpParametros))) . "}";
    }
    $ConteudoArquivo .= ";\n";
    @fwrite($fp, $ConteudoArquivo);
    @fclose($fp);
  }

  private function InserirLog()
  {
    $this->ConectaDB();
    $this->DataBaseLink->Data['DATACRIACAO'] = date('Y-m-d H:i:s');
    $this->DataBaseLink->Data['IPCLIENTE'] = $this->IpCliente;
    $this->DataBaseLink->Data['USUARIO'] = $this->UsuarioCodigo;
    $this->DataBaseLink->Data['SESSAO'] = $this->SessaoCodigo;
    $this->DataBaseLink->Data['ENTIDADE'] = $this->EntidadeNome;
    $this->DataBaseLink->Data['ACAO'] = $this->AcaoNome;
    $this->DataBaseLink->Data['CHAVE_REGISTRO'] = $this->ChaveRegistro;
    $this->DataBaseLink->Insert($this->TBL_LOG);
    if ($this->SISTEMA_['CONFIG']['LOG']['LOCAL']['SALVAR_ARQUIVO'])
      $this->SalvarArquivo();
  }



  public function GravarLog()
  {
    $tmpGravar = true;
    if (isset($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'])) {
      $this->UsuarioCodigo = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
      if ($this->UsuarioCodigo <= 0) {
        $tmpGravar = false;
      }
      if (isset($this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'])) {
        $this->SessaoCodigo = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
      } else {
        $tmpGravar = false;
      }
      if (isset($this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'])) {
        $this->EntidadeNome = $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'];
      } else {
        $tmpGravar = false;
      }
      if (isset($this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'])) {
        $this->AcaoNome = $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'];
      } else {
        $tmpGravar = false;
      }
      if (isset($this->SISTEMA_['TERMINAL']['CLIENTE']['IP'])) {
        $this->IpCliente = $this->SISTEMA_['TERMINAL']['CLIENTE']['IP'];
        if (strlen($this->IpCliente) < 5)
          $this->IpCliente = "127.0.0.1";
      } else {
        $tmpGravar = false;
      }
    } else {
      $tmpGravar = false;
    }
    $tmp_defLog = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DEF'] . "logatividade/logatividade.def.php";
    if (file_exists($tmp_defLog)) {
      include($tmp_defLog);
      if (isset($VAR_DEF_LOG_NAO_GRAVAR[$this->EntidadeNome][$this->AcaoNome]))
        $tmpGravar = false;
    }
    if ($tmpGravar)
      $this->InserirLog();

  }
}
?>