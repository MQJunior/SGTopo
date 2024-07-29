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

$USUARIO_ = new usuario($this->SISTEMA_);
$USUARIO_->AlterarImagem();
$VAR_IMAGEM_LINK = $USUARIO_->ExibirImagem();
$this->SISTEMA_ = $USUARIO_->getSISTEMA();
unset($USUARIO_);
require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."usuario/usuario.perfil.imagem.layout.php");

?>