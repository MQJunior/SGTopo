<?php
/**
* @file tarefas.idioma.brasil.def.php
* @name tarefas.idioma.brasil
* @desc
*   Arquivo com as legendas dos campos, formulários, mensagens e botões. <idioma português-Brasil>
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Def.Idioma
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

/* 
  Legendas dos Botões
*/
$SysRtl_Btn_Alterar = "Alterar";
$SysRtl_Btn_Ativar = "Ativar";
$SysRtl_Btn_Buscar = "Buscar";
$SysRtl_Btn_Consultar = "Consultar";
$SysRtl_Btn_Desativar = "Desativar";
$SysRtl_Btn_Editar = "Editar";
$SysRtl_Btn_Excluir = "Excluir";
$SysRtl_Btn_Incluir = "Incluir";
$SysRtl_Btn_Novo = "Nova Tarefa";
$SysRtl_Btn_Pesquisar = "Pesquisar";
$SysRtl_Btn_Salvar = "Salvar";

/* Legendas da mensagem de sucesso */
$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['MENSAGEM'] = "Informações salva com sucesso!";
$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['EXCLUSAO'] = "Registro excluído com sucesso!";
$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['TITULO'] = "Entidade Tarefas";

/* Legendas dos Campos do Banco de Dados */
$SysRtl_Tarefas_Campos_CODIGO ="Código";
$SysRtl_Tarefas_Campos_SESSAO ="Sessão";
$SysRtl_Tarefas_Campos_DATACRIACAO ="Dt Criação";
$SysRtl_Tarefas_Campos_USUARIO ="Usuário";
$SysRtl_Tarefas_Campos_USUARIO_NOME ="Criado por";
$SysRtl_Tarefas_Campos_REG_ATIVO ="Ativo";
      //----------------------//
$SysRtl_Tarefas_Campos_NOME ="Nome";
$SysRtl_Tarefas_Campos_DATA ="Data";
$SysRtl_Tarefas_Campos_REPETIR ="Repetir a cada";
$SysRtl_Tarefas_Campos_HORA ="Hora";
$SysRtl_Tarefas_Campos_REPETIR_SEMANA ="Semana";
$SysRtl_Tarefas_Campos_DURACAO ="Duração (min)";
$SysRtl_Tarefas_Campos_DESCRICAO ="Descricao";
$SysRtl_Tarefas_Campos_ENTIDADEACAO ="Entidadeacao";
$SysRtl_Tarefas_Campos_PARAMETRO ="Parametro";
$SysRtl_Tarefas_Campos_REPETIR_VEZES ="Repetir x";
$SysRtl_Tarefas_Campos_DATA_FINAL ="Data final";
$SysRtl_Tarefas_Campos_ATIVA ="Ativa";

/* Legendas do formulário pesquisar */
$SysRtl_Tarefas_Pesquisar_Cabecalho_Titulo = "Tarefas";
$SysRtl_Tarefas_Pesquisar_Cabecalho_Subtitulo = "Pesquisar";
$SysRtl_Tarefas_Pesquisar_Cabecalho_Icone = "fa-user";
$SysRtl_Tarefas_Pesquisar_Conteudo_Titulo = "Pesquisa Tarefas";
      //----------------------//

$SysRtl_Tarefas_Incluir_Cabecalho_Titulo = "Tarefas";
$SysRtl_Tarefas_Incluir_Cabecalho_Subtitulo = "Incluir";
$SysRtl_Tarefas_Incluir_Cabecalho_Icone = "fa-user";
$SysRtl_Tarefas_Incluir_Conteudo_Titulo = "Incluir Tarefas";
      //----------------------//
      
/* Legendas do formulário consultar */
$SysRtl_Tarefas_Consultar_Cabecalho_Titulo = "Tarefas";
$SysRtl_Tarefas_Consultar_Cabecalho_Subtitulo = "Consultar";
$SysRtl_Tarefas_Consultar_Cabecalho_Icone = "fa-user";
$SysRtl_Tarefas_Consultar_Conteudo_Titulo = "Consulta Tarefas";
      //----------------------//
      
/* Legendas do formulário alterar */
$SysRtl_Tarefas_Alterar_Cabecalho_Titulo = "Tarefas";
$SysRtl_Tarefas_Alterar_Cabecalho_Subtitulo = "Alterar";
$SysRtl_Tarefas_Alterar_Cabecalho_Icone = "fa-user";
$SysRtl_Tarefas_Alterar_Conteudo_Titulo = "Alteração Tarefas";
      //----------------------//
      
/* Opções dos campos do Tipo Tipo */
/* $SysOpt_Tarefas_ESCOLHA['OPCOES']= array(
                                    array( 'VALOR'=>'1', 'LEGENDA'=>'OPÇÃO - 01'),
                                    array( 'VALOR'=>'2', 'LEGENDA'=>'OPÇÃO - 02'),
                                    array( 'VALOR'=>'3', 'LEGENDA'=>'OPÇÃO - 03')
                                    ); */
/* Opções dos dias da semana */
$SysOpt_Tarefas_SEMANA['DIAS']= array('DOM','SEG','TER','QUA','QUI','SEX','SAB');
/*                                    array( 'VALOR'=>'0', 'LEGENDA'=>'DOM'),
                                    array( 'VALOR'=>'1', 'LEGENDA'=>'SEG'),
                                    array( 'VALOR'=>'2', 'LEGENDA'=>'TER'),
                                    array( 'VALOR'=>'3', 'LEGENDA'=>'QUA'),
                                    array( 'VALOR'=>'4', 'LEGENDA'=>'QUI'),
                                    array( 'VALOR'=>'5', 'LEGENDA'=>'SEX'),
                                    array( 'VALOR'=>'6', 'LEGENDA'=>'SAB')
                                    ); */
?>