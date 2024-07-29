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

if((isset($_REQUEST['TXT_ENTIDADEACAO_ENTIDADE_NOME'])) || (@$_REQUEST['TXT_ENTIDADEACAO_ENTIDADE_NOME']!="")){
  $ENTIDADEACAO_ = new EntidadeAcao($this->SISTEMA_);
  $ENTIDADEACAO_->ConsultarEntidade($_REQUEST['TXT_ENTIDADEACAO_ENTIDADE_NOME']);
  
  $this->SISTEMA_ =$ENTIDADEACAO_->getSISTEMA();
  unset($ENTIDADEACAO_);
}

require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.consultar.entidade.layout.php");
?>