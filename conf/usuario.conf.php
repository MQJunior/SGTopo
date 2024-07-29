<?php
/**
 * usuario.sistema.conf.php
 *
 * Sistema - Configuração do Gerenciador de Usuarios
 *
 * Definições da Configuracao do gerenciador de usuarios
 *
 * @date   2017-10-06
 *
 * @author       Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version      1.0.0
 * @copyright    Copyright © 2006, Marcio Queiroz Jr.
 * @package      sistema
 * @subpackage   Config
 * @category     Usuarios
 */

/** @var string $SISTEMA['INCLUDES']['CLASSES']['USUARIO'] - Define a LIB que gerencia USUARIOS; */
$SISTEMA['INCLUDES']['CLASSES']['USUARIO'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.usuario.lib.php';

$SISTEMA['CONFIG']['USUARIO']['DATABASE'] = $SISTEMA['CONFIG']['SISTEMA']['DATABASE'];
$SISTEMA['ENTIDADE']['USUARIO']['CONF']['DATABASE'] = $SISTEMA['CONFIG']['USUARIO']['DATABASE'];
/**
 * Define o nome da Tabela no Banco de dados;
 * @global  string    $SISTEMA['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB']
 * @name              $SISTEMA['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB']
 */
$SISTEMA['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'] = 'TBL_USUARIOS';
