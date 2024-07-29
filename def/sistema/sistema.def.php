<?php
/**
* @file sistema.def.php
* @name sistema
* @desc
*   Seta-se o UID da Sessуo
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    sistema
* @subpackage Def
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/
/* UID DA SESSУO */
$SistemaSessaoUID = @$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
$TMP_SESSAO_UID = $SistemaSessaoUID;

include("sistema.idioma.".strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']).".def.php");

/*  DEFINIЧеES DOS CAMPOS NO BANCO DE DADOS   */
$EntidadeBackupCampos['TXT_BACKUP_CODIGO']=array('NOME' =>'CODIGO'            , 'TIPO'=>'CODIGO'  , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeBackupCampos['TXT_BACKUP_NOME']=array('NOME' =>'NOME'                , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeBackupCampos['TXT_BACKUP_TIPO']=array('NOME' =>'TIPO'                , 'TIPO'=>'TIPO'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>3);
$EntidadeBackupCampos['TXT_BACKUP_ORIGEM']=array('NOME' =>'ORIGEM'            , 'TIPO'=>'NOME_TEXTO'    , 'EXIBIR'=>true , 'PESQUISAR'=>false , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeBackupCampos['TXT_BACKUP_DESTINO']=array('NOME' =>'DESTINO'          , 'TIPO'=>'NOME_TEXTO'    , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeBackupCampos['TXT_BACKUP_DATABASENAME']=array('NOME' =>'DATABASENAME'                , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeBackupCampos['TXT_BACKUP_USUARIO_DB']=array('NOME' =>'USUARIO_DB'                , 'TIPO'=>'STRING50'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>50);
$EntidadeBackupCampos['TXT_BACKUP_SENHA_DB']=array('NOME' =>'SENHA_DB'                , 'TIPO'=>'STRING50'    , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>true , 'TAMANHO'=>50);
$EntidadeBackupCampos['TXT_BACKUP_COMPACTAR']=array('NOME' =>'COMPACTAR'                , 'TIPO'=>'ESCOLHA'    , 'EXIBIR'=>true , 'PESQUISAR'=>false , 'REQUERIDO'=>true , 'TAMANHO'=>1);
$EntidadeBackupCampos['TXT_BACKUP_PARAMETROS']=array('NOME' =>'PARAMETROS'                , 'TIPO'=>'TEXTO'    , 'EXIBIR'=>false , 'PESQUISAR'=>false , 'REQUERIDO'=>true , 'TAMANHO'=>100);

$EntidadeBackupCampos['TXT_BACKUP_SESSAO']=array('NOME' =>'SESSAO'            , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeBackupCampos['TXT_BACKUP_USUARIO']=array('NOME' =>'USUARIO'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeBackupCampos['TXT_BACKUP_USUARIO_NOME']=array('NOME' =>'USUARIO_NOME'    , 'TIPO'=>'CODIGO_LINK'   , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeBackupCampos['TXT_BACKUP_DATACRIACAO']=array('NOME' =>'DATACRIACAO'  , 'TIPO'=>'DATA'          , 'EXIBIR'=>true  , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>20);
$EntidadeBackupCampos['TXT_BACKUP_REG_ATIVO']=array('NOME' =>'REG_ATIVO'      , 'TIPO'=>'TIPO'          , 'EXIBIR'=>false , 'PESQUISAR'=>false, 'REQUERIDO'=>false , 'TAMANHO'=>1);

?>