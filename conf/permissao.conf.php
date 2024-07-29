<?php
/**
* sgpadrao.permissao.conf.php
*
* Sistema - Configuração Permissao
*
* Definições da Sessao
*
* @date   2018-02-04
*
* @author       Marcio Queiroz Jr <mqjunior@gmail.com>
* @version      1.0
* @copyright    Copyright © 2006, Marcio Queiroz Jr.
* @package      SGPadrao
* @subpackage   Config
* @category     Permissao
*/


/** @var string $SISTEMA['INCLUDES']['PERMISSAO']['ARQUIVO'] - Define a LIB que gerencia permissao; */
$SISTEMA['INCLUDES']['CLASSES']['PERMISSAO'] = $SISTEMA['INCLUDES']['DIR']['LIB'].'class.permissao.lib.php';

$SISTEMA['CONFIG']['PERMISSAO']['DATABASE'] = $SISTEMA['CONFIG']['SISTEMA']['DATABASE'];

$SISTEMA['CONFIG']['PERMISSAO']['DATABASE']['ENTIDADE_DB']['TBL_ENTIDADE'] = 'TBL_SYS_ENTIDADES';
$SISTEMA['CONFIG']['PERMISSAO']['DATABASE']['ENTIDADE_DB']['TBL_ACAO'] = 'TBL_SYS_ACOES';
$SISTEMA['CONFIG']['PERMISSAO']['DATABASE']['ENTIDADE_DB']['TBL_PERMISSAO'] = 'TBL_SYS_PERMISSOES';




?>