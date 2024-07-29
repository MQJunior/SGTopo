<?php
/**
 * sessao.sgpadrao.conf.php
 *
 * Sistema - Configuração Sessão
 *
 * Definições da Sessao
 *
 * @date   2017-09-30
 *
 * @author       Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version      1.0
 * @copyright    Copyright © 2006, Marcio Queiroz Jr.
 * @package      SGPadrao
 * @subpackage   Config
 * @category     Sessao
 */

$SISTEMA['INCLUDES']['CLASSES']['SESSAO'] = $SISTEMA['INCLUDES']['DIR']['LIB'] . 'class.sessao.lib.php'; // Define a LIB que gerencia sessao

$SISTEMA['CONFIG']['SESSAO']['GERAL']['PROCEDIMENTO'] = 'FINALIZAR'; // Define se a sessao deve continuar ou finalizar { CONTINUAR | FINALIZAR }

$SISTEMA['CONFIG']['SESSAO']['GERAL']['NOME'] = 'SESSAO_SGPADRAO'; // Define o NOME da Sessao

$SISTEMA['CONFIG']['SESSAO']['GERAL']['TEMPO_EXPIRACAO'] = 100; // Define o Tempo de Expiração da Sessão em Minutos

$SISTEMA['CONFIG']['SESSAO']['GERAL']['LIMITACAO'] = 'private'; // Define a Limitação (none/nocache/private/private_no_expire/public)

$SISTEMA['CONFIG']['SESSAO']['GERAL']['LOCAL_DIR'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['LOCAL'] . 'tmp/sessions/'; // Define o Local onde será salvo os arquivos de sessão caso não seja setado, será o diretório Definido no PHP.ini

$SISTEMA['CONFIG']['SESSAO']['GERAL']['SESSAO_AUTENTICACAO'] = true; // Define se a Sessão é autenticada (Protegida por senha)

$SISTEMA['CONFIG']['SESSAO']['GERAL']['PALAVRA_CHAVE'] = $SISTEMA['CONFIG']['SISTEMA']['GERAL']['NOME'];

$SISTEMA['CONFIG']['SESSAO']['DATABASE'] = $SISTEMA['CONFIG']['SISTEMA']['DATABASE'];

$SISTEMA['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_DB'] = 'TBL_SYS_SESSOES'; // Define o nome da tabela no banco de dados

$SISTEMA['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_USUARIO'] = 'TBL_USUARIOS'; // tabela Usuarios

$SISTEMA['SESSAO']['DATABASE']['DATA']['CODIGO'] = null;

$SISTEMA['SESSAO']['DATABASE']['DATA']['USUARIO'] = null; // Campos da tabela no banco de dados - USUARIO

$SISTEMA['SESSAO']['DATABASE']['DATA']['SESSAO_ID'] = null; // Campos da tabela no banco de dados - SESSAO_ID

$SISTEMA['SESSAO']['DATABASE']['DATA']['IPCLIENTE'] = null; // Campos da tabela no banco de dados - IPCLIENTE

$SISTEMA['SESSAO']['DATABASE']['DATA']['DATAINICIO'] = null; // Campos da tabela no banco de dados - DATAINICIO

$SISTEMA['SESSAO']['DATABASE']['DATA']['DATAFIM'] = null; // Campos da tabela no banco de dados - DATAFIM

$SISTEMA['SESSAO']['DATABASE']['DATA']['USUARIOLOGIN'] = null; // Campos da tabela no banco de dados - USUARIOLOGIN

$SISTEMA['SESSAO']['DATABASE']['DATA']['SISTEMANOME'] = null; // Campos da tabela no banco de dados - SISTEMANOME
