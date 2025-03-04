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
$VAR_USUARIO_LISTAR = $USUARIO_->listar();
//$VAR_USUARIO_LISTAR = $tmp_ConexaoDB_Usuario->FORMATA_DADOS($VAR_USUARIO_LISTAR,"DATACRIACAO",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");

$this->SISTEMA_ = $USUARIO_->getSISTEMA();
unset($USUARIO_);

$PERMISSAO_ = new permissao($this->SISTEMA_);    
$VAR_PERMISSAO_LISTA = $PERMISSAO_->EntidadeAcaoDisponiveis();
$this->SISTEMA_ = $PERMISSAO_->getSISTEMA();
$VAR_PERMISSAO_ENTIDADES = array_keys($VAR_PERMISSAO_LISTA);
$VAR_USUARIO_PERMISSOES = array();
$VAR_USUARIO_PERMISSOES_CODIGO = array();

if (isset($_REQUEST['txtChaveRegistro']))
  $VAR_USUARIO_CODIGO = $_REQUEST['txtChaveRegistro'];
if (isset($this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO']))
  $VAR_USUARIO_CODIGO = $this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'];
  
if (isset($VAR_USUARIO_CODIGO)){
  $VAR_USUARIO_PERMISSOES = $PERMISSAO_->UsuarioPermissao($VAR_USUARIO_CODIGO);
  if (is_array($VAR_USUARIO_PERMISSOES))
  foreach($VAR_USUARIO_PERMISSOES as $tmp_UsuarioPermissao)
    if ($tmp_UsuarioPermissao['TIPO_ACESSO'] == '+')
      $VAR_USUARIO_PERMISSOES_CODIGO[]=$tmp_UsuarioPermissao['CODIGO'];
  
}

unset($PERMISSAO_);
require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."permissao/permissao.pesquisar.layout.php");

//$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($VAR_USUARIO_PERMISSOES_CODIGO,true);
?>