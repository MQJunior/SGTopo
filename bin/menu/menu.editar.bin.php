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
//print_r($this->SISTEMA_);
$TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];


$tmp_MenuNome = "";
$tmp_MenuEntidade = "";
$tmp_MenuEntidadeAcao = "";
$tmp_MenuItens = "";
$tmp_SessaoUID = "";
$tmpChaveRegistro = "";

$TMP_SESSAO_UID = "";
if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID']))
  $TMP_SESSAO_UID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
function MontarMenu($p_MenuArray, $p_Layout, $p_SessaoUID = "")
{
  $tmp_Saida = "";
  $tmp_Eval_Saida = "";
  $tmp_MenuCodigo = "";
  $tmp_MenuNome = "";
  $tmp_MenuEntidade = "";
  $tmp_MenuIcone = "";
  $tmp_MenuEntidadeAcao = "";
  $tmp_MenuItens = "";
  $tmp_Nivel = 0;
  $tmp_LayoutMaxIdx = count($p_Layout) - 1;
  $tmp_SessaoUID = $p_SessaoUID;
  $tmpChaveRegistro = "";

  for ($i = 0; $i < count($p_MenuArray); $i++) {
    $tmp_Nivel = $p_MenuArray[$i]['NIVEL'];
    if ($tmp_Nivel > $tmp_LayoutMaxIdx)
      $tmp_Nivel = $tmp_LayoutMaxIdx;
    $tmp_MenuNome = $p_MenuArray[$i]['NOME'];
    $tmp_MenuCodigo = $p_MenuArray[$i]['CODIGO'];
    $tmpChaveRegistro = $p_MenuArray[$i]['CODIGO'];
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

//require($this->SISTEMA_['INCLUDES']['DIR']['DEF']."sgpadrao.menu.geral.def.php");
$MENU_ = new MenuSys($this->SISTEMA_);
$VAR_MENU_GERAL = $MENU_->ListarMenu(true);
$VAR_MENU_GERAL = $MENU_->GerarVarMenu($VAR_MENU_GERAL);



$VAR_LAYOUT_MENU[0]['MENU'] = '<li class=\"treeview\"><a href=\"javascript::;\" onclick=\"PesquisaDados(\'?XMLHTML=true&SID=$tmp_SessaoUID&SysEntidade=MENU&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpChaveRegistro\',\'\',\'DIV_FORM_MENU_ALTERAR\',null)\"><span>$tmp_MenuNome</span></a></li>\n';
$VAR_LAYOUT_MENU[0]['ITENS'] = '<li class=\"treeview\"><a href=\"javascript::;\" onclick=\"PesquisaDados(\'?XMLHTML=true&SID=$tmp_SessaoUID&SysEntidade=MENU&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpChaveRegistro\',\'\',\'DIV_FORM_MENU_ALTERAR\',null)\"> <span>$tmp_MenuNome</span></a></li>\n$tmp_MenuItens\n';

$VAR_LAYOUT_MENU[1]['MENU'] = '<li class=\"treeview\"><a href=\"javascript::;\" onclick=\"PesquisaDados(\'?XMLHTML=true&SID=$tmp_SessaoUID&SysEntidade=MENU&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpChaveRegistro\',\'\',\'DIV_FORM_MENU_ALTERAR\',null)\"><i class=\"fa $tmp_MenuIcone\"></i> <span>$tmp_MenuNome</span></a></li>\n';
$VAR_LAYOUT_MENU[1]['ITENS'] = '<li class=\"treeview\">
              <a href=\"javascript::;\" onclick=\"PesquisaDados(\'?XMLHTML=true&SID=$tmp_SessaoUID&SysEntidade=MENU&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpChaveRegistro\',\'\',\'DIV_FORM_MENU_ALTERAR\',null)\">
                <i class=\"fa $tmp_MenuIcone\"></i> <span>$tmp_MenuNome</span>
                <i class=\"fa fa-angle-left pull-right\"></i>
              </a>
              <ul class=\"treeview\">
                $tmp_MenuItens
              </ul>
            </li>\n';


$VAR_SISTEMA_MENU = MontarMenu($VAR_MENU_GERAL, $VAR_LAYOUT_MENU, $TMP_SESSAO_UID);
//print_r($VAR_SISTEMA_MENU);
//die();
$VAR_MENU_CODIGO = null;

$VAR_MENU_PAI_LISTA = $MENU_->ListarMenuPai(true);
$VAR_MENU_ENTIDADE_ACAO_LISTA = $MENU_->ListarEntidadeAcao(true);
//$VAR_MENU_PAI_LISTA = $MENU_->GerarVarMenu($VAR_MENU_PAI_LISTA);
unset($MENU_);

require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'] . "menu/menu.editar.layout.php");

//$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($VAR_MENU_PAI_LISTA,true);
