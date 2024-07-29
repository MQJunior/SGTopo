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

/**
 * @var string $SISTEMA['INCLUDES']['DIR']['CONFIG'] - Define o endereco do Diretorio conf;
 */
$SISTEMA['INCLUDES']['DIR']['CONFIG'] = '/sistema/Sistemas/SGPadrao/conf/';
require_once($SISTEMA['INCLUDES']['DIR']['CONFIG'].'sgpadrao.def.conf.php');

$SISTEMA["SESSAO"]["SESSAO_AUTENTICACAO"] = false;
$SISTEMA['SESSAO']['CLIENTE']['SESSAO_UID']="";

$Z2Sessao = new Sessao($SISTEMA);
$SISTEMA = $Z2Sessao->getSISTEMA();

//require_once($SISTEMA['INCLUDES']['CLASSES']['SISTEMA']);
$SISTEMA["LAYOUT"]="";

 
?>