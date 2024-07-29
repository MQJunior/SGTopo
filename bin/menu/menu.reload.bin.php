<?php
/**
 * @file sgpadrao.login.bin.php
 * @name login
 * @desc
 *   Script para verificar a autenticacao do usuario
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Marcio Queiroz Jr.
 * @package    sgpadrao
 * @subpackage bin
 * @todo       
 *
 *
 * @date 2018-01-12  v. 0.0.0
 */

$TMP_SESSAO_UID = "";
if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID']))
  $TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
function MontarMenu($p_MenuArray, $p_Layout, $p_SessaoUID = "")
{
  $tmp_Saida = "";
  $tmp_Eval_Saida = "";
  $tmp_MenuNome = "";
  $tmp_MenuEntidade = "";
  $tmp_MenuEntidadeAcao = "";
  $tmp_MenuIcone = "";
  $tmp_MenuItens = "";
  $tmp_Nivel = 0;
  $tmp_LayoutMaxIdx = count($p_Layout) - 1;
  $tmp_SessaoUID = $p_SessaoUID;

  for ($i = 0; $i < count($p_MenuArray); $i++) {
    $tmp_Nivel = $p_MenuArray[$i]['NIVEL'];
    if ($tmp_Nivel > $tmp_LayoutMaxIdx)
      $tmp_Nivel = $tmp_LayoutMaxIdx;
    $tmp_MenuNome = $p_MenuArray[$i]['NOME'];
    $tmp_MenuEntidade = $p_MenuArray[$i]['ENTIDADE'];
    $tmp_MenuIcone = $p_MenuArray[$i]['ICONE'];
    $tmp_MenuEntidadeAcao = "";
    if (isset($p_MenuArray[$i]['ACAO']))
      $tmp_MenuEntidadeAcao = $p_MenuArray[$i]['ACAO'];
    if (is_array($p_MenuArray[$i]['ITENS'])) {
      $tmp_MenuItens = MontarMenu($p_MenuArray[$i]['ITENS'], $p_Layout, $p_SessaoUID);
      $tmp_Eval_Saida = $p_Layout[$tmp_Nivel]['ITENS'];
    } else {
      $tmp_Eval_Saida = $p_Layout[$tmp_Nivel]['MENU'];
    }
    eval("\$tmp_Eval_Saida = \"$tmp_Eval_Saida\";");
    $tmp_Saida .= $tmp_Eval_Saida;
  }
  return $tmp_Saida;
}

function MontarMenuPermissao($p_MENU, $p_PermissaoUsuario)
{
  //$tmp_MenuRetorno="";
  foreach ($p_MENU as $tmp_MENU) {
    if (is_array($tmp_MENU['ITENS'])) {
      $tmp_MenuPermissao = $tmp_MENU;
      unset($tmp_MenuPermissao['ITENS']);
      $tmp_MenuPermissao['ITENS'] = MontarMenuPermissao($tmp_MENU['ITENS'], $p_PermissaoUsuario);
      (is_array($tmp_MenuPermissao)) ? $tmp_MenuRetorno[] = $tmp_MenuPermissao : null;
    } else {
      if (isset($tmp_MENU['ACAO'])) {
        if (isset($p_PermissaoUsuario[$tmp_MENU['ENTIDADE']][$tmp_MENU['ACAO']])) {
          $tmp_MenuRetorno[] = $tmp_MENU;
        }
      } else {
        $tmp_MenuRetorno[] = $tmp_MENU;
      }
    }
  }
  if (isset($tmp_MenuRetorno))
    return $tmp_MenuRetorno;
}

function LimparMenu($p_MENU)
{
  $tmp_retorno = null;
  foreach ($p_MENU as $tmp_MENU) {
    if (is_array($tmp_MENU['ITENS'])) {
      $tmp_retorno_ = LimparMenu($tmp_MENU['ITENS']);
      if ($tmp_retorno_ != null) {
        $tmp_retorno_Sem_Itens = $tmp_MENU;
        $tmp_retorno_Sem_Itens['ITENS'] = $tmp_retorno_;
        $tmp_retorno_ = $tmp_retorno_Sem_Itens;
        $tmp_retorno[] = $tmp_retorno_;
      }
    } else {
      if (isset($tmp_MENU['ACAO']) || ($tmp_MENU['ENTIDADE_ACAO'] == ''))
        $tmp_retorno[] = $tmp_MENU;
    }

  }
  return $tmp_retorno;
}


require($this->SISTEMA_['INCLUDES']['DIR']['DEF'] . "sgpadrao.menu.geral.def.php");

$MENU_ = new MenuSys($this->SISTEMA_);
$VAR_MENU_GERAL = $MENU_->GerarVarMenu();
unset($MENU_);


$tmp_PERMISSAO = new permissao($this->SISTEMA_);
$tmp_Permissao_Usuario = $tmp_PERMISSAO->UsuarioPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], false);
foreach ($tmp_Permissao_Usuario as $tmp_Permissao_EntidadeAcao)
  $VAR_PERMISSAO_ENTIDADE_ACAO[$tmp_Permissao_EntidadeAcao['ENTIDADE']][$tmp_Permissao_EntidadeAcao['ACAO']] = true;
//$this->SISTEMA_['SAIDA']['EXIBIR'] = print_r($VAR_PERMISSAO_ENTIDADE_ACAO,true);

$VAR_MENU_GERAL_ = MontarMenuPermissao($VAR_MENU_GERAL, $VAR_PERMISSAO_ENTIDADE_ACAO);
$VAR_MENU_GERAL = LimparMenu($VAR_MENU_GERAL_);

$VAR_SISTEMA_MENU = MontarMenu($VAR_MENU_GERAL, $VAR_LAYOUT_MENU, $TMP_SESSAO_UID);
require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "menu/menu.montar.layout.php");

