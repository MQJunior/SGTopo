<?php
/**
 * @file sistema.backup.restore.idioma.brasil.def.php
 * @name sistema.backup.restore.idioma.brasil
 * @desc
 *   Arquivo com as legendas dos campos, formul�rios, mensagens e bot�es. <idioma portugu�s-Brasil>
 *
 * @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, M�rcio Queiroz Jr.
 * @package    sistema.backupRestore
 * @subpackage Def.Idioma
 * @todo       
 *   Descricao todo
 *
 * @date 2018-04-02  v. 0.0.0
 *
 */

/* 
  Legendas dos Bot�es
*/
$SysRtl_Btn_Alterar = "Alterar";
$SysRtl_Btn_Ativar = "Ativar";
$SysRtl_Btn_Buscar = "Buscar";
$SysRtl_Btn_Consultar = "Consultar";
$SysRtl_Btn_Desativar = "Desativar";
$SysRtl_Btn_Editar = "Editar";
$SysRtl_Btn_Excluir = "Excluir";
$SysRtl_Btn_Incluir = "Incluir";
$SysRtl_Btn_Novo = "Novo";
$SysRtl_Btn_Pesquisar = "Pesquisar";
$SysRtl_Btn_Salvar = "Salvar";
$SysRtl_Btn_Backup_Executar = "Executar";

/* Legendas da mensagem de sucesso */
$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['MENSAGEM'] = "Informa��es salva com sucesso!";
$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['EXCLUSAO'] = "Registro exclu�do com sucesso!";
$this->SISTEMA_['ENTIDADE']['BACKUP']['MENSAGEM']['SUCESSO']['TITULO'] = "Gerenciador de Backup";

/* Legendas dos Campos do Banco de Dados */
$SysRtl_Backup_Campos_CODIGO = "Código";
$SysRtl_Backup_Campos_SESSAO = "Sessão";
$SysRtl_Backup_Campos_DATACRIACAO = "Dt Criação";
$SysRtl_Backup_Campos_USUARIO = "Usuário";
$SysRtl_Backup_Campos_USUARIO_NOME = "Criado por";
$SysRtl_Backup_Campos_REG_ATIVO = "Ativo";
//----------------------//
$SysRtl_Backup_Campos_NOME = "Nome";
$SysRtl_Backup_Campos_TIPO = "Tipo";
$SysRtl_Backup_Campos_ORIGEM = "Origem";
$SysRtl_Backup_Campos_DESTINO = "Destino";
$SysRtl_Backup_Campos_DATABASENAME = "Base de Dados";
$SysRtl_Backup_Campos_USUARIO_DB = "Usuário DB";
$SysRtl_Backup_Campos_SENHA_DB = "Senha DB";
$SysRtl_Backup_Campos_COMPACTAR = "Compactar";
$SysRtl_Backup_Campos_PARAMETROS = "Parametros";

/* Legendas do formul�rio pesquisar */
$SysRtl_Backup_Pesquisar_Cabecalho_Titulo = "Backup";
$SysRtl_Backup_Pesquisar_Cabecalho_Subtitulo = "Listagem";
$SysRtl_Backup_Pesquisar_Cabecalho_Icone = "fa-hdd-o";
$SysRtl_Backup_Pesquisar_Conteudo_Titulo = "Listagem de Backups";
//----------------------//

$SysRtl_Backup_Incluir_Cabecalho_Titulo = "Backup";
$SysRtl_Backup_Incluir_Cabecalho_Subtitulo = "Incluir";
$SysRtl_Backup_Incluir_Cabecalho_Icone = "fa-hdd-o";
$SysRtl_Backup_Incluir_Conteudo_Titulo = "Incluir Backup";
//----------------------//

/* Legendas do formul�rio consultar */
$SysRtl_Backup_Consultar_Cabecalho_Titulo = "Backup";
$SysRtl_Backup_Consultar_Cabecalho_Subtitulo = "Consultar";
$SysRtl_Backup_Consultar_Cabecalho_Icone = "fa-hdd-o";
$SysRtl_Backup_Consultar_Conteudo_Titulo = "Consulta Backup";
//----------------------//

/* Legendas do formul�rio alterar */
$SysRtl_Backup_Alterar_Cabecalho_Titulo = "Backup";
$SysRtl_Backup_Alterar_Cabecalho_Subtitulo = "Alterar";
$SysRtl_Backup_Alterar_Cabecalho_Icone = "fa-hdd-o";
$SysRtl_Backup_Alterar_Conteudo_Titulo = "Altera��o Backup";
//----------------------//
/* Legendas do formul�rio executar */
$SysRtl_Backup_Executar_Cabecalho_Titulo = "Backup";
$SysRtl_Backup_Executar_Cabecalho_Subtitulo = "Executar";
$SysRtl_Backup_Executar_Cabecalho_Icone = "fa-gear";
$SysRtl_Backup_Executar_Conteudo_Titulo = "Executar Backup";
//----------------------//

/* Legendas do formul�rio Login */
$SysRtl_Sistema_Logar_Mensagem_BoaVindas = "Entre para iniciar uma nova sessao!";
$SysRtl_Sistema_Logar_TxtManterConectado = "Manter-me conectado";

/* Op��es dos campos do Tipo */
$SysOpt_Backup_TIPO['OPCOES'] = array(
  array('VALOR' => '1', 'LEGENDA' => 'ARQUIVO'),
  array('VALOR' => '2', 'LEGENDA' => 'FIREBIRD'),
  array('VALOR' => '3', 'LEGENDA' => 'MySQL')
);
?>