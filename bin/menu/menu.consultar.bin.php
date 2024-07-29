<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/
//print_r($this->SISTEMA_);
$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

if (isset($_REQUEST['txtChaveRegistro']))
  $VAR_MENU_CODIGO = $_REQUEST['txtChaveRegistro'];

$MENU_ = new MenuSys($this->SISTEMA_);
$MENU_->Consultar($VAR_MENU_CODIGO);

$VAR_MENU_NOME = $MENU_->Nome;
$VAR_MENU_PAI = $MENU_->MenuPai;
$VAR_MENU_ICONE = $MENU_->Icone;
$VAR_MENU_ENTIDADE_ACAO = $MENU_->EntidadeAcao;
$VAR_MENU_TIPO = $MENU_->Tipo;
$VAR_MENU_ATIVO = $MENU_->Ativo;
$VAR_MENU_ORDEM = $MENU_->Ordem;

$VAR_MENU_PAI_LISTA = $MENU_->ListarMenuPai(true);
$VAR_MENU_ENTIDADE_ACAO_LISTA = $MENU_->ListarEntidadeAcao(true);
$VAR_MENU_GERAL_LISTA = $MENU_->ListarMenu();

$VAR_MENU_possuiItens=$MENU_->possuiItens($VAR_MENU_GERAL_LISTA,$VAR_MENU_CODIGO);

$VAR_MENU_ORDEM_primeiro=true;
$VAR_MENU_ORDEM_ultimo=true;
foreach($VAR_MENU_GERAL_LISTA as $tmpListaMenu){
  if($tmpListaMenu['MENU_PAI']==$VAR_MENU_PAI){
    if($tmpListaMenu['ORDEM']>$VAR_MENU_ORDEM)
      $VAR_MENU_ORDEM_ultimo=false;
    if($tmpListaMenu['ORDEM']<$VAR_MENU_ORDEM)
      $VAR_MENU_ORDEM_primeiro=false;
  }
}

unset($MENU_);

require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."menu/menu.consultar.layout.php");

?>