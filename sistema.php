<?php

/**
 * sgpadrao.php
 *
 * SGPadrao
 *
 * Sistema de Gerenciamento Padrao
 *
 * @date 2018-01-10
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @package SGPadrao
 *
 * @uses ./conf/def.sgpadrao.conf.php Arquivo de definicao das Includes
 *
 */

error_reporting(E_ALL);

//  Define o endereco do Diretorio conf;
$SISTEMA['INCLUDES']['DIR']['CONFIG'] = '/sistema/SGTopo/conf/';


require_once ($SISTEMA['INCLUDES']['DIR']['CONFIG'] . 'sistema.def.conf.php');
//require_once($SISTEMA['INCLUDES']['CLASSES']['SISTEMA']);


$SISTEMA['DEBUG']['MENSAGEM'] = array();
$SISTEMA['LOGS']['COMANDOS'] = array();
$SISTEMA['SAIDA']['MENSAGEM'] = "";          // ['ERRO'] | ['SUCESSO'] | ['ALERTA']
$SISTEMA['SAIDA']['INFORMACAO'] = "";        // ['NOTIFICACAO'] | ['TAREFAS'] 
$SISTEMA['SAIDA']['CHAT'] = "";              // implementar
$SISTEMA['SAIDA']['EXIBIR'] = "";           //
//$SISTEMA['DEBUG']['MENSAGEM'] = array();


$Z2Sessao = new Sessao($SISTEMA);
$SISTEMA = $Z2Sessao->getSISTEMA();

$SGPadrao = new sistema($SISTEMA);
$SISTEMA = $SGPadrao->getSISTEMA();


$SGPermissao = new permissao($SISTEMA);

$SGPermissao->ChecarPermissaoSys();

$SISTEMA = $SGPermissao->getSISTEMA();
unset($SGPermissao);



$SGPadrao->ExecutarSistema($SISTEMA);

#die(print_r($SISTEMA). __LINE__ .' - '. __FILE__);

//$SISTEMA = $SGPadrao->getSISTEMA();
//print_r($_REQUEST); print_r($SISTEMA); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");  

$SGPadrao->ExibirSaida();
$SISTEMA = $SGPadrao->getSISTEMA();

unset($SGPadrao);
unset($Z2Sessao);


//print_r($_REQUEST);
//@print_r($_SESSION);
//print_r($SISTEMA);
unset($SISTEMA);
unset($SAIDA_Sistema);
