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


if (!isset($VAR_USUARIO_ID) || $VAR_USUARIO_ID==""){
  if(isset($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'])){
    $VAR_USUARIO_ID =$this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}




$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$USUARIO_ = new usuario($this->SISTEMA_);
//die($VAR_USUARIO_ID." -- ");
$USUARIO_->consultar($VAR_USUARIO_ID);


$VAR_USUARIO_CODIGO = $USUARIO_->CODIGO;
$VAR_USUARIO_NOME = $USUARIO_->NOME;
$VAR_USUARIO_NOME_EXIBIR = $USUARIO_->NOME_EXIBIR;
$VAR_USUARIO_EMAIL = $USUARIO_->EMAIL;
$VAR_USUARIO_FUNCAO = $USUARIO_->FUNCAO;
$VAR_USUARIO_TITULO = $USUARIO_->TITULO;
$VAR_USUARIO_DESCRICAO = $USUARIO_->DESCRICAO;
$VAR_USUARIO_IMAGEM = $USUARIO_->IMAGEM;
$VAR_USUARIO_DATACRIACAO = $USUARIO_->DATACRIACAO;
$VAR_USUARIO_SESSAO = $USUARIO_->SESSAO;
$VAR_USUARIO_USUARIO_CRIOU = $USUARIO_->USUARIO_CRIOU;

$VAR_IMAGEM_LINK = $USUARIO_->ExibirImagem();

unset($USUARIO_);

require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.perfil.layout.php");
?>