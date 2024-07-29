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
$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if (isset($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME'])) {
  $tmpConteudoArquivo = $_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO'];
  $tmpConteudoArquivo = str_replace('[@textarea>', '</textarea>', $tmpConteudoArquivo);
  file_put_contents($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME'], $tmpConteudoArquivo);
  @chmod($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME'], 0771);
}
$this->SISTEMA_['SAIDA']['EXIBIR'] = "";

?>