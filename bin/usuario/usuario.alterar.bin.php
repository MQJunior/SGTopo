<?php
/**
 * @file sgpadrao.login.bin.php
 * @name login
 * @desc
 *   Script para verificar a autenticacao do usuario
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Marcio Queiroz Jr.
 * @package    sgpadrao
 * @subpackage bin
 * @todo       
 *
 *
 * @date 2018-01-12  v. 0.0.0
 */
if (isset($_REQUEST['txtChaveRegistro'])) {
  $VAR_USUARIO_ID = $_REQUEST['txtChaveRegistro'];
}

if (!isset($VAR_USUARIO_ID)) {
  if (isset($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'])) {
    $VAR_USUARIO_ID = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  } else {
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}

$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$tmp_EVAL_ConexaoDB = new ConexaoDB(
  $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['HOSTNAME']
  ,
  $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['USERNAME']
  ,
  $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['PASSWORD']
  ,
  $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['DATABASENAME']
  ,
  $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['TIPODB']
);

$DADOS_ALTERAR['CODIGO'] = $VAR_USUARIO_ID;
$DADOS_ALTERAR['NOME'] = $_REQUEST['TXT_USUARIO_NOME'];
$DADOS_ALTERAR['NOME_EXIBIR'] = $_REQUEST['TXT_USUARIO_NOME_EXIBIR'];
$DADOS_ALTERAR['EMAIL'] = $_REQUEST['TXT_USUARIO_EMAIL'];
$DADOS_ALTERAR['FUNCAO'] = $_REQUEST['TXT_USUARIO_FUNCAO'];
$DADOS_ALTERAR['TITULO'] = $_REQUEST['TXT_USUARIO_TITULO'];
$DADOS_ALTERAR['DESCRICAO'] = $_REQUEST['TXT_USUARIO_DESCRICAO'];

$condicao = " CODIGO = '" . $DADOS_ALTERAR['CODIGO'] . "' ";             # Adiciona a Condi��o no registro, se houver

if ($tmp_EVAL_ConexaoDB->Update($DADOS_ALTERAR, $condicao, "TBL_USUARIOS")) {
  $var_layout_Saida_Mensagem_Titulo = "Sucesso!";
  $var_layout_Saida_Mensagem_Corpo = "Informa��es salva com sucesso!";
  include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "layout/layout.saida.mensagem.layout.php");

} else {
  $var_layout_Saida_Mensagem_Titulo = "Alerta!";
  $var_layout_Saida_Mensagem_Corpo = "As informa��es n�o foram salvas!";
  include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "layout/layout.saida.alerta.layout.php");
}
unset($tmp_EVAL_ConexaoDB);
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTAR";
$VAR_USUARIO_ID = $DADOS_ALTERAR['CODIGO'];
$this->ExecutarComando();


?>