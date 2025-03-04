<?php

/**
 * LaserCount - Defini��es de Includes
 *
 * Defini��es dos endereos de Includes utilizadas no sistema
 *
 * @date 2017-09-19
 *
 * @author Márcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.0
 * @copyright Copyright � 2006, Márcio Queiroz Jr.
 * @package sistema
 * @subpackage Config
 * @category Sistema
 */

//error_reporting(E_ALL);
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] = '/sistema/sistemas/SGTopo/';                                // Define o local onde o sistema está sendo executado
$SISTEMA['INCLUDES']['DIR']['LIB']              = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'lib/';   // Define o endereço da LIB
$SISTEMA['INCLUDES']['DIR']['CONFIG']           = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'conf/';  // Define o endereço do Diretório conf
$SISTEMA['INCLUDES']['DIR']['DEF']              = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'def/';   // Define o endereço do Diretório def - definições e/ou constantes
$SISTEMA['INCLUDES']['CONFIG']['SISTEMA']       = $SISTEMA['INCLUDES']['DIR']['CONFIG'] . 'sistema.conf.php'; // Arquivo de configuração Padrão

//$SISTEMA['INCLUDES']['CLASSES']['ARQUIVO'] = $SISTEMA['INCLUDES']['DIR']['LIB'].'class.arquivo.lib.php'; // Define a LIB que gerencia arquivos
$SISTEMA['INCLUDES']['CLASSES']['GENESIS_LIB'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.debug.lib.php';   // Define a LIB que gerencia arquivos
$SISTEMA['INCLUDES']['CLASSES']['CONEXAODB']   = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.conexao.lib.php'; // Define a LIB que gerencia Banco de Dados

$SISTEMA['INCLUDES']['FUNCOES'][0] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'funcoes.lib.php'; // Define o local do arquivo de funções básicas

require_once $SISTEMA['INCLUDES']['DIR']['CONFIG'] . 'sistema.conf.php';

/* Carrega a lista de arquivos de configuracoes contida na Variavel $SISTEMA['INCLUDES']['CONFIG'] */
foreach (glob($SISTEMA['INCLUDES']['DIR']['CONFIG'] . '*.conf.php') as $tmp_file_conf) {
    require_once $tmp_file_conf;
}

/* Carrega a lista de arquivos de funcoes contida na Variavel $SISTEMA['INCLUDES']['FUNCOES'] */
foreach ($SISTEMA['INCLUDES']['FUNCOES'] as $tmp_funcoes => $tmp_funcoes_files) {
    require_once $tmp_funcoes_files;
}
/* Carrega a lista de arquivos de classes contida na Variavel $SISTEMA['INCLUDES']['CLASSES']*/
foreach ($SISTEMA['INCLUDES']['CLASSES'] as $tmp_classes => $tmp_classes_files) {
    require_once $tmp_classes_files;
}
/* Carrega a lista de arquivos de configuracoes contida na Variavel $SISTEMA['INCLUDES']['CONFIG'] */
foreach (glob($SISTEMA['INCLUDES']['DIR']['DEF'] . '*.def.php') as $tmp_file_conf) {
    require_once $tmp_file_conf;
}

/* Idiomas dispon�veis */
/** @var string $SISTEMA['CONFIG']['SISTEMA']['GERAL']['IDIOMA'] - Idioma do Sistema; */
$SISTEMA['CONFIG']['SISTEMA']['GERAL']['IDIOMAS_OPT'][] = 'BRASIL';
//$SISTEMA['CONFIG']['SISTEMA']['GERAL']['IDIOMAS_OPT'][] = 'INGLES';
