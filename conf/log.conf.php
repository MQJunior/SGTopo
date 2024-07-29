<?php
/**
 * sgpadrao.log.conf.php
 *
 * Sistema - Configuração de Logs
 *
 * Definições da Sessao
 *
 * @date   2018-02-10
 *
 * @author       Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version      1.0
 * @copyright    Copyright © 2006, Marcio Queiroz Jr.
 * @package      SGPadrao
 * @subpackage   Config
 * @category     Logs
 */


/** @var string $SISTEMA['INCLUDES']['PERMISSAO']['ARQUIVO'] - Define a LIB que gerencia permissao; */
$SISTEMA['INCLUDES']['CLASSES']['LOG'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.log.lib.php';

$SISTEMA['CONFIG']['LOG']['DATABASE'] = $SISTEMA['CONFIG']['SISTEMA']['DATABASE'];

$SISTEMA['CONFIG']['LOG']['DATABASE']['ENTIDADE_DB']['TBL_LOG'] = 'TBL_SYS_LOGS';

$SISTEMA['CONFIG']['LOG']['LOCAL']['DIR'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'logs/';
$SISTEMA['CONFIG']['LOG']['LOCAL']['ARQUIVO_NOME'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['NOME'];
//$SISTEMA['CONFIG']['LOG']['LOCAL']['SALVAR_ARQUIVO'] = true;
$SISTEMA['CONFIG']['LOG']['LOCAL']['SALVAR_ARQUIVO'] = false;

?>