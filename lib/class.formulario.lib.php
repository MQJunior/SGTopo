<?php
/**
 * @file class.formulario.lib.php
 * @name formulario
 * @desc
 *   Gerenciador de formularios
 *
 * @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, M�rcio Queiroz Jr.
 * @package    Formulario
 * @subpackage Classe
 * @todo       
 *
 *
 * @date 2018-02-23  v. 0.0.0
 *
 */

class formulario
{
  /**
   * @var	array $SISTEMA_ Variavel Sistema
   * @access private
   */
  private $SISTEMA_ = null;

  /**
   * Metodo Construtor, executado ao ser instanciado.
   * @param array $p_Config Configuracoes da sessao
   * access public
   */
  public function __construct($p_Sistema)
  {
    $this->SISTEMA_ = $p_Sistema;
    $this->ExibirFormulario();
  }
  /**
   * Retorna o Vetor Sistema apos processa-lo
   * @return array Array Sistema
   * access public
   */
  public function getSISTEMA()
  {
    return $this->SISTEMA_;
  }
  /**
   * Exibe o formulario na tela
   * access public
   */
  public function ExibirFormulario()
  {
    switch ($this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO']) {
      case 0:
        $this->ExibirFormTipo0();
        break;
      case 1:
        $this->ExibirFormTipo1();
        break;
      case 2:
        $this->ExibirFormTipo2();
        break;
    }

    $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'] = null;
    $this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIOID'] = null;
    $this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIONOME'] = null;
    //$this->SISTEMA_['GOTO']['INICIO']= true;
    //print_r($this->SISTEMA_['EXECUTAR']);
    if (isset($this->SISTEMA_['EXECUTAR']['PROXIMO_COMANDO'])) {
      //      var_dump($this->SISTEMA_); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
      unset($this->SISTEMA_['EXECUTAR']['COMANDO']);
      $this->SISTEMA_['EXECUTAR']['COMANDO'] = $this->SISTEMA_['EXECUTAR']['PROXIMO_COMANDO'];
      unset($this->SISTEMA_['EXECUTAR']['PROXIMO_COMANDO']);
      $this->SISTEMA_['GOTO']['INICIO'] = true;
    }
    /*
    if (isset($this->SISTEMA_['EXECUTAR']['COMANDO'])){
      if ($this->SISTEMA_['EXECUTAR']['COMANDO']!="")
        $this->SISTEMA_['GOTO']['INICIO']= true;
    }
    */

  }
  /**
   * Exibe o formulario na tela
   * access public
   */
  public function MontarFormulario()
  {
    if (isset($this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIOID'])) {
      if ($this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIOID'] > 0) {
        $tmp_Database_cfg = $this->SISTEMA_['CONFIG']['FORMULARIO']['DATABASE'];

        $tmp_ConexaoDB = new ConexaoDB(
          $tmp_Database_cfg['HOSTNAME']
          ,
          $tmp_Database_cfg['USERNAME']
          ,
          $tmp_Database_cfg['PASSWORD']
          ,
          $tmp_Database_cfg['DATABASENAME']
          ,
          $tmp_Database_cfg['TIPODB']
        );
        $tmp_ConexaoDB->Executar("select " . $tmp_Database_cfg['SCRIPT_ENTIDADE_DB'] . ".script, " . $tmp_Database_cfg['SCRIPT_ENTIDADE_DB'] . ".arquivo
        from " . $tmp_Database_cfg['SCRIPT_ENTIDADE_DB'] . "
        where " . $tmp_Database_cfg['SCRIPT_ENTIDADE_DB'] . ".formulario='" . $this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIOID'] . "' and " . $tmp_Database_cfg['SCRIPT_ENTIDADE_DB'] . ".tiposaida=" . $this->SISTEMA_['TERMINAL']['CLIENTE']['TIPO']);
        $TMP = $tmp_ConexaoDB->ResultConsult();
        if ($tmp_ConexaoDB->Data[0]['ARQUIVO'] == "") {
          $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'] = $tmp_ConexaoDB->Data[0]['SCRIPT'];
        } else {
          include_once ($tmp_ConexaoDB->Data[0]['ARQUIVO']);
          //$tmp_Saida_Include = file_get_contents($tmp_ConexaoDB->Data[0]['ARQUIVO']);

          //var_dump($tmp_Saida_Include);
          //die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");

          //eval("\$tmp_Saida_Include = \"$tmp_Saida_Include\";");

          $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'] = $tmp_Saida_Include;
          unset($tmp_Saida_Include);
        }

        unset($tmp_ConexaoDB);
      } else {
        array_push($this->SISTEMA_['DEBUG']['MENSAGEM'], "FORMULARIO DESCONHECIDO!");
      }
    } else {
      //unset($this->SISTEMA_['GOTO']['INICIO']);
      $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'] = null;
      $this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIOID'] = null;
      $this->SISTEMA_['TERMINAL']['SAIDA']['FORMULARIONOME'] = null;
      //array_push($this->SISTEMA_['DEBUG']['MENSAGEM'],"FORMULARIO DESCONHECIDO!");
    }
  }
  /**
   * Exibe o formulario na tela
   * access public
   */
  public function ExibirFormTipo0()
  {
    $this->MontarFormulario();
    if (isset($this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'])) {
      echo $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'];
      //unset($this->SISTEMA_['EXECUTAR']['COMANDO']);
      unset($this->SISTEMA_['GOTO']['INICIO']);
    }
    unset($this->SISTEMA_['GOTO']['INICIO']);
  }
  /**
   * Exibe o formulario na tela
   * access public
   */
  public function ExibirFormTipo1()
  {
    $this->MontarFormulario();
    if (isset($this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT']))
      eval ($this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT']);
  }
  /**
   * Exibe o formulario na tela
   * access public
   */
  public function ExibirFormTipo2()
  {
    $this->MontarFormulario();
    if (isset($this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT']))
      echo $this->SISTEMA_['TERMINAL']['SAIDA']['SCRIPT'];
  }
}
?>