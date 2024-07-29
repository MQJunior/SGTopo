<?php
/**
* @file entidadeacao.importar.modelo.layout.php
* @name entidadeacao.importar.modelo
* @desc
*   Layout de saida para o modelo importado
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    EntidadeAcao
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-03-01  v. 0.0.0
*
*/


$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('</textarea>','[@textarea>',$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
$this->SISTEMA_['SAIDA']['EXIBIR'] = "<textarea rows=\"12\" cols=\"70\" class=\"form-control\"  name=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" id=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" style=\"background-color:#000000; color:#11CC11; font-family:Courier New; font-size:12px;\">".@$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO."</textarea>";

?>