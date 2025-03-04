<?php
/**
* @file sgpadrao.principal.bin.php
* @name principal
* @desc
*   Script que exibe o conteudo principal de acordo com a configuraчуo
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright й 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-16  v. 0.0.0
*/

if (isset($this->SISTEMA_['CONFIG']['WEB'])){
  $url_Layout = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT'];
  $url_Layout_Font = $this->SISTEMA_['CONFIG']['WEB']['FONTS'];
  $url_Layout_Ajax = $this->SISTEMA_['CONFIG']['WEB']['AJAX'];
  $url_Layout_Padrao = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO'];
  
  //$dir_Layout ="/sistema/www/Layout/";
  $dir_Layout_Padrao = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'];
  //echo "aqui";
}

if (!isset($SAIDA_MENSAGEM_ERROR))$SAIDA_MENSAGEM_ERROR ="";
if (isset($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'])){
  
  $VAR_USUARIO_ID = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  $VAR_SISTEMA_ID = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['SISTEMAID'];
  include_once($this->SISTEMA_['DEFINICOES']['COMANDOS']['MENU_MONTAR']);
  
  //busca os dados do perfil de Usuario
  $VAR_USUARIO_ID_PERFIL = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  include_once($this->SISTEMA_['DEFINICOES']['COMANDOS']['USUARIO_PERFIL_CONSULTAR']);
  
// monta o conteudo principal
  // Menu Esquerdo  
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.menuEsquerdo.php");
  // Topo da Pсgina 
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.Topo.php");
  // Conteudo central da Pсgina 
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.ConteudoBranco.php");
  // Conteudo Barra de Configuracoes
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.barraConfiguracoes.php");
  
  // Chama o Layout principal
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."layout.principal.php");
  //echo __FILE__." ".__LINE__;
}

?>