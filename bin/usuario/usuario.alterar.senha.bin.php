<?php
/**
* @file sgpadrao.login.bin.php
* @name login
* @desc
*   Script para verificar a autenticacao do usuario
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright й 2006, Marcio Queiroz Jr.
* @package    sgpadrao
* @subpackage bin
* @todo       
*
*
* @date 2018-01-12  v. 0.0.0
*/

//$this->SISTEMA_['SAIDA']['EXIBIR'] = print_r($_REQUEST,true);

if (!isset($VAR_USUARIO_ID)){
  if(isset($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'])){
    $VAR_USUARIO_ID=$this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
  }else{
    die("Faltou Paramentro: VAR_USUARIO_ID");
  }
}


$TMP_SESSAO_UID =$this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];


$USUARIO_ = new usuario($this->SISTEMA_);                                 
@$tmp_EVAL_usuario =   $_REQUEST['TXT_USUARIO_EMAIL_ALTERAR_SENHA'];
$tmp_EVAL_senha =     $_REQUEST['TXT_USUARIO_SENHAATUAL'];
$tmp_EVAL_senhaNova = $_REQUEST['TXT_USUARIO_SENHANOVA'];


if ($_REQUEST['TXT_USUARIO_SENHANOVA'] == $_REQUEST['TXT_USUARIO_SENHACONFIRMA']){
  if ($USUARIO_->alterarSenha($tmp_EVAL_usuario,$tmp_EVAL_senha,$tmp_EVAL_senhaNova)){
    $tmpMensagem = "Senha alterada com Sucesso!";
  }else{
    if (isset($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'])){
      $tmpMensagem = "Senha incorreta!";
      die($tmpMensagem);
    }
  }
}else{
  $tmpMensagem = "Confirmaчуo de senha incorreta!";
}
$this->SISTEMA_ = $USUARIO_->getSISTEMA();
$this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE']= "USUARIO";
$this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "PERFIL";
$this->ExecutarComando();
?>