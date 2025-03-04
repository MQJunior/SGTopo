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



$USUARIO_ = new usuario($this->SISTEMA_);    
(isset($_REQUEST['TXT_USUARIO_PESQUISAR']))?$VAR_USUARIO_LISTAR =$USUARIO_->PesquisarTodos(strtoupper(utf8_decode($_REQUEST['TXT_USUARIO_PESQUISAR'])),true):$VAR_USUARIO_LISTAR = $USUARIO_->PesquisarTodos('',true);
if(!empty($VAR_USUARIO_LISTAR))
  $VAR_USUARIO_LISTAR = $USUARIO_->BD_CONEXAO->FORMATA_DADOS($VAR_USUARIO_LISTAR,"DATACRIACAO",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
unset($USUARIO_);

if (!isset($_REQUEST['TXT_USUARIO_PESQUISAR']))
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.pesquisar.layout.php");
else
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.pesquisa.layout.php");
  
?>