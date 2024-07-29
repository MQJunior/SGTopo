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
  

  $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "MENU";
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "MONTAR";
  $this->ExecutarComando();
  
  //busca os dados do perfil de Usuario
  $VAR_USUARIO_ID = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'] = $VAR_USUARIO_ID;
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "CONSULTA";
  $this->ExecutarComando();
  
 
  // Chama o Layout principal
  include_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."sistema/sistema.principal.layout.php");
  //echo __FILE__." ".__LINE__;
}

?>