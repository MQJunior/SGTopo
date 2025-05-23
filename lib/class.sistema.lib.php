<?php
/**
 * Sistema
 *
 * Classe interpretadora de comandos
 * API para manipula��o de Comandos
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @copyright Copyright � 2006, Marcio Queiroz Jr.
 * @package sistema
 * @date 2015-07-09
 *
 * @Update 2017-09-25
 *
 * @todo
 *   -
 */

class sistema
{
    private $SISTEMA_;

    /**
     * Retorna o Vetor Sistema apos processa-lo
     * @return array Array Sistema
     * access public
     */
    public function getSISTEMA()
    {
        return $this->SISTEMA_;
    }

    public function __construct($p_SISTEMA)
    {
        $this->SISTEMA_ = $p_SISTEMA;
        //$this->ExecutarSistema($p_SISTEMA);
        //print_r($this->SISTEMA_);
        //die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");
        $this->setEntradainSistema();
    }

    /**
     * Retorna o Vetor Sistema com os comandos passados pelo usuario
     * access private
     */
    public function setEntradainSistema()
    {
        $this->SISTEMA_['EXECUTAR']['COMANDO']['AUTORIZADO'] = true;
        $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']   = "";
        $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO']       = "";
        if ((isset($_REQUEST['SysEntidade'])) && (isset($_REQUEST['SysEntidadeAcao']))) {
            foreach ($_REQUEST as $tmp_Key => $tmp_Valor) {
                if ($tmp_Key == "SysEntidade") {
                    $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $_REQUEST['SysEntidade'];
                } else if ($tmp_Key == "SysEntidadeAcao") {
                    $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = $_REQUEST['SysEntidadeAcao'];
                } else {
                    $this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS'][$tmp_Key] = $tmp_Valor;
                }
            }
        }
        if ($this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] == "") {
            $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADEPADRAO'];
            $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO']     = $this->SISTEMA_['CONFIG']['SISTEMA']['ACAOPADRAO'];
        }
    }
    /**
     * Executa o comando passado por parametro
     * @param    string $p_Comando    Nome do comando
     * @param    array $p_Parametros    Parametros de entrada do comando{ ['chave'] = 'valor'}
     * @return void
     * @access public
     */
    //public function ExecutarComando($p_Comando,$p_Parametros=''){
    public function ExecutarComando($p_SISTEMA = null)
    {
        if ($p_SISTEMA == null) {
            $p_SISTEMA = $this->SISTEMA_;
        }

        //include($this->CaminhoComando($p_SISTEMA));
        $this->CaminhoComando($p_SISTEMA);
    }
    /**
     * Executa o comando passado por parametro
     * @param    string $p_Comando    Nome do comando
     * @param    array $p_Parametros    Parametros de entrada do comando{ ['chave'] = 'valor'}
     * @return string Caminho do arquivo do comando Entidade Acao
     * @access public
     */
    public function CaminhoComando($p_SISTEMA = null)
    {
        if ($p_SISTEMA == null) {
            $p_SISTEMA = $this->SISTEMA_;
        }

        if (($this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] == "") || ($this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] == "")) {
            $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADEPADRAO'];
            $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO']     = $this->SISTEMA_['CONFIG']['SISTEMA']['ACAOPADRAO'];
        }
        if (class_exists('logAtividade')) {
            $tmp_var_LOG = new logAtividade($this->SISTEMA_);
            if (isset($_REQUEST['txtChaveRegistro'])) {
                $tmp_var_LOG->ChaveRegistro = $_REQUEST['txtChaveRegistro'];
            }

            $tmp_var_LOG->GravarLog();
            unset($tmp_var_LOG);
        }
        $tmpEntidade  = $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'];
        $tmpEntidade_ = strtolower($tmpEntidade);
        $tmpAcao      = $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'];
        $tmpAcao      = str_replace("_", ".", $tmpAcao);
        $tmpAcao_     = strtolower($tmpAcao);
        $tmpArquivo   = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN'] . $tmpEntidade_ . "/" . $tmpEntidade_ . "." . $tmpAcao_ . ".bin.php";

        if (file_exists($tmpArquivo)) {
            $tmpArquivoConf = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['CONF'] . $tmpEntidade_ . "/" . $tmpEntidade_ . ".conf.php";
            if (file_exists($tmpArquivoConf)) {
                include $tmpArquivoConf;
            }

            $tmpArquivoDef = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DEF'] . $tmpEntidade_ . "/" . $tmpEntidade_ . ".def.php";
            if (file_exists($tmpArquivoDef)) {
                include $tmpArquivoDef;
            }

            $tmpArquivoDefLayout = $this->SISTEMA_['LAYOUT'] . "/layout.def.php";
            if (file_exists($tmpArquivoDefLayout)) {
                include $tmpArquivoDefLayout;
            }

            $tmpArquivoDefLayoutEntidade = $this->SISTEMA_['LAYOUT'] . $tmpEntidade_ . "/" . $tmpEntidade_ . ".layout.def.php";
            if (file_exists($tmpArquivoDefLayoutEntidade)) {
                include $tmpArquivoDefLayoutEntidade;
            }

            $tmpArquivoLib = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LIB'] . "class." . $tmpEntidade_ . ".lib.php";
            if (file_exists($tmpArquivoLib)) {
                require_once $tmpArquivoLib;
            }

            include $tmpArquivo;
        } else {
            header("Content-Type: application/json");
            header("Expires: 0");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            die("\nEntidade: " . $tmpEntidade . " -> " . $tmpAcao . "  - N�O EXITE\n = " . $tmpArquivo);
        }

    }
    /**
     * Atribui o parametro sistema na Variavel de Controle
     * @param    array $p_SISTEMA    Variavel Sistema
     * @return void
     * @access public
     */
    //public function ExecutarComando($p_Comando,$p_Parametros=''){
    public function ExecutarSistema($p_SISTEMA = null)
    {
        if ($p_SISTEMA == null) {
            $p_SISTEMA = $this->SISTEMA_;
        }

        $this->SISTEMA_ = $p_SISTEMA;
        //$this->setEntradainSistema();
        $this->ExecutarComando();

    }

    /////////////////////////////////////////////////////////////////
    public function ExibirSaida($p_Capturar = false)
    {

        if (isset($this->SISTEMA_['ERROR']['PERMISSAO'])) {
            $this->SISTEMA_['SAIDA']['EXIBIR'] = $this->SISTEMA_['ERROR']['PERMISSAO']['MENSAGEM'];
        }

        if (isset($this->SISTEMA_['MENSAGEM']['SUCESSO'])) {
            $SysRtl_Mensagem_Sucesso_Titulo = $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO'];
            $SysRtl_Mensagem_Sucesso        = $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM'];
            //die(print_r($this->SISTEMA_['MENSAGEM']['SUCESSO'],false));
            $this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO'] = str_replace('{SysRtl_Mensagem_Sucesso_Titulo}', $SysRtl_Mensagem_Sucesso_Titulo, $this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO']);
            $this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA']  = str_replace('{SaidaInformacaoSucesso}', $SysRtl_Mensagem_Sucesso, $this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO']);
            //$this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA'] = $this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO'];
            //eval("\$this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA'] = \"".$this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO']."\";");
            //die($this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA']);
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= $this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA'];
        }

        //print_r($this->SISTEMA_['SAIDA']['APP']);
        if (isset($this->SISTEMA_['SAIDA']['APP']) || ($this->SISTEMA_['SAIDA']['MODE'] == 'app')) {
            echo json_encode($this->SISTEMA_['SAIDA']['APP'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            die();
        }

        $SAIDA_Sistema = trim($this->SISTEMA_['SAIDA']['EXIBIR']);
        if (isset($_REQUEST["XMLHTML"]) || ($this->SISTEMA_['SAIDA']['MODE'] == 'api')) {
            header("Content-Type: application/json");
            header("Expires: 0");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Access-Control-Allow-Origin: *");
            //$SAIDA_Sistema = GerarXMLAjax($SAIDA_Sistema);
            $TMP_SESSION_ID = null;
            if (isset($this->SISTEMA_['SESSAO']['SAIDA_UID']['SESSAO_UID'])) {
                $TMP_SESSION_ID = $this->SISTEMA_['SESSAO']['SAIDA_UID']['SESSAO_UID'];
            }

            (isset($this->SISTEMA_['SAIDA']['PAGINA'])) ? $SAIDA_Sistema = GerarJSONAjax('', $this->SISTEMA_['SAIDA']['PAGINA'], $TMP_SESSION_ID) : $SAIDA_Sistema = GerarJSONAjax($SAIDA_Sistema, null, $TMP_SESSION_ID);
        } else {
            header("Content-Type: text/html; charset=ISO-8859-1", true);
            $SAIDA_Sistema = $SAIDA_Sistema;
        }

        if ($p_Capturar) {
            return trim($SAIDA_Sistema);
        } else {
            echo trim($SAIDA_Sistema);
        }

    }
    ///////////////////////////////////////////////////  
    public function ImportarEntidade($p_Entidade)
    {
        $p_Entidade     = strtolower($p_Entidade);
        $tmpArquivoConf = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['CONF'] . $p_Entidade . "/" . $p_Entidade . ".conf.php";
        if (file_exists($tmpArquivoConf)) {
            require_once $tmpArquivoConf;
        }

        $tmpArquivoDef = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DEF'] . $p_Entidade . "/" . $p_Entidade . ".def.php";
        if (file_exists($tmpArquivoDef)) {
            require_once $tmpArquivoDef;
        }

        $tmpArquivoLib = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LIB'] . "class." . $p_Entidade . ".lib.php";
        if (file_exists($tmpArquivoLib)) {
            require_once $tmpArquivoLib;
        }

    }

    /////////////////////////////////////////////////////////////////
    public function ExibirSaidaApp($p_Capturar = false)
    {

        if (isset($this->SISTEMA_['ERROR']['PERMISSAO'])) {
            $this->SISTEMA_['SAIDA']['EXIBIR'] = $this->SISTEMA_['ERROR']['PERMISSAO']['MENSAGEM'];
        }

        //$SAIDA_Sistema = trim($this->SISTEMA_['SAIDA']['EXIBIR']);
        $SAIDA_SistemaArray = [];

        if ($this->SISTEMA_['SAIDA']['MODE'] == 'app') {
            // Primeiro, aplica os dados principais da resposta
            if (isset($this->SISTEMA_['SAIDA']['APP']) && ($this->SISTEMA_['SAIDA']['MODE'] == 'app')) {
                $SAIDA_APP          = $this->SISTEMA_['SAIDA']['APP'];
                $SAIDA_SistemaArray = $SAIDA_APP;
            }

            // Depois, adiciona o SID fora do array original
            if (isset($this->SISTEMA_['SESSAO']['SAIDA_UID']['SESSAO_UID'])) {
                $SAIDA_SistemaArray['sid'] = $this->SISTEMA_['SESSAO']['SAIDA_UID']['SESSAO_UID'];
            }

            if (isset($this->SISTEMA_['ERROR'])) {
                $SAIDA_SistemaArray['SysError'] = $this->SISTEMA_['ERROR'];
            }
        }
        if (isset($this->SISTEMA_['MENSAGEM']['APP'])) {

            // Responde com SID
            http_response_code(200);
            header('Content-Type: application/json');

            //$this->SISTEMA_['SAIDA']['EXIBIR'] .= $this->SISTEMA_['MENSAGEM']['SUCESSO']['SAIDA'];
            $SAIDA_SistemaArray['SysMensagem'] = $this->SISTEMA_['MENSAGEM']['APP'];
        }
        //print_r($this->SISTEMA_);

        $SAIDA_Sistema = json_encode($SAIDA_SistemaArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if ($p_Capturar) {
            return trim($SAIDA_Sistema);
        } else {
            echo trim($SAIDA_Sistema);
        }

    }

}
