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


if (!isset($VAR_USUARIO_ID)){
  if(isset($this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'])){
    $VAR_USUARIO_ID =$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}

if (isset($this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID']))
  $TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];

$USUARIO_ =new usuario($this->SISTEMA_);
$USUARIO_->consultar($VAR_USUARIO_ID);
$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']=$USUARIO_->BD_CONEXAO->Data[0];
//print_r($this->SISTEMA_['ENTIDADE']);die();
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
$VAR_USUARIO_REG_ATIVO = $USUARIO_->REG_ATIVO;
//print_r($tmp_DADOS);

if ($VAR_USUARIO_IMAGEM == null){
  $VAR_IMAGEM_LINK = null;
}else{
  $VAR_IMAGEM_LINK =$USUARIO_->ExibirImagem();
}
$this->SISTEMA_['ENTIDADE']['USUARIO']['VARS']['IMAGEM_LINK'] = $VAR_IMAGEM_LINK;
unset($USUARIO_);
?>