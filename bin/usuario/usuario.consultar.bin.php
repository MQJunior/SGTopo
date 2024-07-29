<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/
//print_r($this->SISTEMA_);

$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTA";

if (isset($_REQUEST['txtChaveRegistro'])){
  $VAR_USUARIO_ID =$_REQUEST['txtChaveRegistro'];
}
$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'] =$VAR_USUARIO_ID;

$this->ExecutarComando();

//print_r($this->SISTEMA_['ENTIDADE']);die();
$tmpVARS =$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS'];
$VAR_USUARIO_CODIGO = $tmpVARS['CODIGO'];
$VAR_USUARIO_NOME = $tmpVARS['NOME'];
$VAR_USUARIO_NOME_EXIBIR = $tmpVARS['NOME_EXIBIR'];
$VAR_USUARIO_EMAIL = $tmpVARS['EMAIL'];
$VAR_USUARIO_FUNCAO = $tmpVARS['FUNCAO'];
$VAR_USUARIO_TITULO = $tmpVARS['TITULO'];
$VAR_USUARIO_DESCRICAO = $tmpVARS['DESCRICAO'];
$VAR_USUARIO_IMAGEM = $tmpVARS['IMAGEM'];
$VAR_USUARIO_DATACRIACAO = $tmpVARS['DATACRIACAO'];
$VAR_USUARIO_SESSAO = $tmpVARS['SESSAO'];
$VAR_USUARIO_USUARIO_CRIOU = $tmpVARS['USUARIO_CRIOU'];
$VAR_USUARIO_REG_ATIVO = $tmpVARS['REG_ATIVO'];
$VAR_IMAGEM_LINK=$tmpVARS['IMAGEM_LINK'];

$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
  
require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.consultar.layout.php");
?>