<?php
/**
* @file padrao.def.php
* @name padrao
* @desc
*   Definiчуo dos campos no Banco de Dados e Seta-se o UID da Sessуo
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    padrao
* @subpackage Def
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/
/* UID DA SESSУO */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include("padrao.idioma.".strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']).".def.php");

/*  DEFINIЧеES DOS CAMPOS NO BANCO DE DADOS   */
$EntidadePadraoCampos['TXT_PADRAO_CODIGO']=array('NOME' =>'CODIGO'            , 'TIPO'=>'CODIGO'  , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>false , 'TAMANHO'=>0);

/*BUSCAR_NO_BD*/
$EntidadePadraoCampos['TXT_PADRAO_SESSAO']=array('NOME' =>'SESSAO'            , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_USUARIO']=array('NOME' =>'USUARIO'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_USUARIO_NOME']=array('NOME' =>'USUARIO_NOME'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_DATACRIACAO']=array('NOME' =>'DATACRIACAO'  , 'TIPO'=>'DATA'          , 'EXIBIR'=>true  , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>20);
$EntidadePadraoCampos['TXT_PADRAO_REG_ATIVO']=array('NOME' =>'REG_ATIVO'      , 'TIPO'=>'TIPO'          , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>1);

?>