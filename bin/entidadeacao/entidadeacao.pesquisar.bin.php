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

$ENTIDADEACAO_ = new EntidadeAcao($this->SISTEMA_);
$this->SISTEMA_ =$ENTIDADEACAO_->getSISTEMA();
$VAR_ENTIDADEACAO_ENTIDADE_LISTA = $ENTIDADEACAO_->ListarEntidades(true);
unset($ENTIDADEACAO_);

require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.pesquisar.layout.php");
?>