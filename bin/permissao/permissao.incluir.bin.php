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


$this->SISTEMA_['SAIDA']['EXIBIR'] ="";
$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$tmp_VAR_PERMISSAO = new permissao($this->SISTEMA_);    
$VAR_USUARIO_PERMISSOES = array();
$VAR_USUARIO_PERMISSOES_CODIGO = array();
$tmp_ValoresFormulario = array();
$tmp_ValoresExistentes = array();
if (isset($_REQUEST['txtChaveRegistro'])){
  $VAR_USUARIO_CODIGO= $_REQUEST['txtChaveRegistro'];
  $VAR_USUARIO_PERMISSOES = $tmp_VAR_PERMISSAO->UsuarioPermissao($_REQUEST['txtChaveRegistro'], false);
  if (isset($_REQUEST['txtPermissaoCodigo'])){
    $tmp_ValoresFormulario = array_values($_REQUEST['txtPermissaoCodigo']);
    if (is_array($VAR_USUARIO_PERMISSOES))
      foreach ($VAR_USUARIO_PERMISSOES as $tmpPermissoes)
        $tmp_ValoresExistentes[] = $tmpPermissoes['CODIGO'];
    
    $tmp_Adicionar =array_diff($tmp_ValoresFormulario,$tmp_ValoresExistentes);
    foreach($tmp_Adicionar as $tmpPermissaoCodigo)
      $tmp_VAR_PERMISSAO->IncluirPermissaoCodigo($VAR_USUARIO_CODIGO,$tmpPermissaoCodigo);
    
    $tmp_Revogar =array_diff($tmp_ValoresExistentes,$tmp_ValoresFormulario);
    unset($tmpPermissaoCodigo);
    foreach($tmp_Revogar as $tmpPermissaoCodigo)
      $tmp_VAR_PERMISSAO->RevogarPermissaoCodigo($VAR_USUARIO_CODIGO,$tmpPermissaoCodigo);
    
  }
}

unset($tmp_VAR_PERMISSAO);

$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "PERMISSAO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "PESQUISAR";
$this->ExecutarComando();
//require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."permissao/permissao.pesquisar.layout.php");

//$this->SISTEMA_['SAIDA']['EXIBIR'] .= print_r($_REQUEST,true);
?>