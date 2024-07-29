<?php
/**
 * sgpadrao.arquivo.conf.php
 *
 * Sistema - Configuração de arquivos
 *
 * Definições para a classe arquivo
 *
 * @date   2018-02-13
 *
 * @author       Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version      1.0
 * @copyright    Copyright © 2006, Marcio Queiroz Jr.
 * @package      SGPadrao
 * @subpackage   Config
 * @category     Arquivo
 */


//include_once($SISTEMA['INCLUDES']['DIR']['CONFIG'].'sgpadrao.db.conf.php');

/** @var string $SISTEMA['INCLUDES']['PERMISSAO']['ARQUIVO'] - Define a LIB que gerencia permissao; */
$SISTEMA['INCLUDES']['CLASSES']['ARQUIVO'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.arquivo.lib.php';

$SISTEMA['CONFIG']['ARQUIVO']['DATABASE'] = $SISTEMA['CONFIG']['SISTEMA']['DATABASE'];

$SISTEMA['CONFIG']['ARQUIVO']['DATABASE']['ENTIDADE_DB']['TBL_ARQUIVO'] = 'TBL_ARQUIVOS';

$SISTEMA['CONFIG']['ARQUIVO']['LOCAL']['ARMAZENAR'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'datafiles/';
$SISTEMA['CONFIG']['ARQUIVO']['LOCAL']['EXIBIR'] = '/sistema/www/SGPadrao/files/';
isset($_SERVER["SERVER_ADDR"]) ? $SISTEMA['CONFIG']['ARQUIVO']['LOCAL']['LINK'] = 'http://' . $_SERVER["SERVER_ADDR"] . '/SGPadrao/files/' : $SISTEMA['CONFIG']['ARQUIVO']['LOCAL']['LINK'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'files/';

$SISTEMA['CONFIG']['ARQUIVO']['GERAR_NOME_HASH'] = true;
//$SISTEMA['CONFIG']['LOG']['LOCAL']['SALVAR_ARQUIVO'] = true;

?>