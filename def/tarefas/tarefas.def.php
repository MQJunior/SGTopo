<?php
/**
* @file tarefas.def.php
* @name tarefas
* @desc
*   Definiчуo dos campos no Banco de Dados e Seta-se o UID da Sessуo
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    tarefas
* @subpackage Def
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/
/* UID DA SESSУO */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include("tarefas.idioma.".strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']).".def.php");

/*  DEFINIЧеES DOS CAMPOS NO BANCO DE DADOS   */
$EntidadeTarefasCampos['TXT_TAREFAS_CODIGO']=array('NOME' =>'CODIGO'            , 'TIPO'=>'CODIGO'  , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>false , 'TAMANHO'=>0);

$EntidadeTarefasCampos['TXT_TAREFAS_NOME']=array('NOME' =>'NOME'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeTarefasCampos['TXT_TAREFAS_DATA']=array('NOME' =>'DATA'     , 'TIPO'=>'DATA'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>20);
$EntidadeTarefasCampos['TXT_TAREFAS_REPETIR']=array('NOME' =>'REPETIR'     , 'TIPO'=>'STRING20'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_HORA']=array('NOME' =>'HORA'     , 'TIPO'=>'NOMESIMPLES'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_REPETIR_SEMANA']=array('NOME' =>'REPETIR_SEMANA'     , 'TIPO'=>'NOMESIMPLES'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_DURACAO']=array('NOME' =>'DURACAO'     , 'TIPO'=>'TEMPO'    , 'EXIBIR'=>false , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>8);
$EntidadeTarefasCampos['TXT_TAREFAS_DESCRICAO']=array('NOME' =>'DESCRICAO'     , 'TIPO'=>'TEXTO'    , 'EXIBIR'=>false , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_ENTIDADEACAO']=array('NOME' =>'ENTIDADEACAO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeTarefasCampos['TXT_TAREFAS_PARAMETRO']=array('NOME' =>'PARAMETRO'     , 'TIPO'=>'TEXTO'    , 'EXIBIR'=>false , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_REPETIR_VEZES']=array('NOME' =>'REPETIR_VEZES'     , 'TIPO'=>'NUMERO'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>1);
$EntidadeTarefasCampos['TXT_TAREFAS_DATA_FINAL']=array('NOME' =>'DATA_FINAL'     , 'TIPO'=>'DATA'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>20);
$EntidadeTarefasCampos['TXT_TAREFAS_ATIVA']=array('NOME' =>'ATIVA'     , 'TIPO'=>'ESCOLHA'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>1);

$EntidadeTarefasCampos['TXT_TAREFAS_SESSAO']=array('NOME' =>'SESSAO'            , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeTarefasCampos['TXT_TAREFAS_USUARIO']=array('NOME' =>'USUARIO'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeTarefasCampos['TXT_TAREFAS_USUARIO_NOME']=array('NOME' =>'USUARIO_NOME'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeTarefasCampos['TXT_TAREFAS_DATACRIACAO']=array('NOME' =>'DATACRIACAO'  , 'TIPO'=>'DATA'          , 'EXIBIR'=>false  , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>20);
$EntidadeTarefasCampos['TXT_TAREFAS_REG_ATIVO']=array('NOME' =>'REG_ATIVO'      , 'TIPO'=>'TIPO'          , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>1);

?>