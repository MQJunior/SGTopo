<?php

/**
 * sgpadrao.php
 *
 * SGTopo
 *
 * Sistema de Gerenciamento Padrao
 *
 * @date 2018-01-10
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @package SGTopo
 *
 * @uses ./conf/def.sgpadrao.conf.php Arquivo de definicao das Includes
 *
 */

error_reporting(E_ALL);

if (! isset($SISTEMA['SAIDA']['MODE'])) {
    $SISTEMA['SAIDA']['MODE'] = 'api';
}

//  Define o endereco do Diretorio conf;
$SISTEMA['INCLUDES']['DIR']['CONFIG'] = '/sistema/sistemas/SGTopo/conf/';

require_once $SISTEMA['INCLUDES']['DIR']['CONFIG'] . 'sistema.def.conf.php';

//require_once($SISTEMA['INCLUDES']['CLASSES']['SISTEMA']);

$SISTEMA['DEBUG']['MENSAGEM']   = [];
$SISTEMA['LOGS']['COMANDOS']    = [];
$SISTEMA['SAIDA']['MENSAGEM']   = ""; // ['ERRO'] | ['SUCESSO'] | ['ALERTA']
$SISTEMA['SAIDA']['INFORMACAO'] = ""; // ['NOTIFICACAO'] | ['TAREFAS'] 
$SISTEMA['SAIDA']['CHAT']       = ""; // implementar
$SISTEMA['SAIDA']['EXIBIR']     = ""; //
                                      //$SISTEMA['DEBUG']['MENSAGEM'] = array();

$Z2Sessao = new Sessao($SISTEMA);
$SISTEMA  = $Z2Sessao->getSISTEMA();

$SGTopo  = new sistema($SISTEMA);
$SISTEMA = $SGTopo->getSISTEMA();

$SGPermissao = new permissao($SISTEMA);
$SGPermissao->ChecarPermissaoSys();
$SISTEMA = $SGPermissao->getSISTEMA();
unset($SGPermissao);

$SGTopo->ExecutarSistema($SISTEMA);

#die(print_r($SISTEMA). __LINE__ .' - '. __FILE__);

//$SISTEMA = $SGTopo->getSISTEMA();
//print_r($_REQUEST); print_r($SISTEMA); die("\nArquivo: ".__FILE__." Linha: ".__LINE__."\n");  

if (isset($SISTEMA['SAIDA']['MODE']) && $SISTEMA['SAIDA']['MODE'] == 'app') {

    //print_r($SISTEMA);
    $SGTopo->ExibirSaidaApp();
} else {
    $SGTopo->ExibirSaida();
}

$SISTEMA = $SGTopo->getSISTEMA();

unset($SGTopo);
unset($Z2Sessao);

//print_r($_REQUEST);
//@print_r($_SESSION);
//print_r($SISTEMA);
unset($SISTEMA);
unset($SAIDA_Sistema);
