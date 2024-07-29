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
$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if(isset($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME'])){
  $VAR_ENTIDADEACAO_ARQUIVO_NOME = $_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME'];
  $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = file_get_contents($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME']);
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.visualizar.arquivo.layout.php");
}
?>