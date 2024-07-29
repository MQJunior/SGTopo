<?php
/**
* sgpadrao.php
*
* SGPadrao
*
* Sistema de Gerenciamento Padrao
*
* @date 2018-01-10
* @author Marcio Queiroz Jr <mqjunior@gmail.com>
* @version 1.0
* @package SGPadrao
*
* @uses ./conf/def.sgpadrao.conf.php Arquivo de definicao das Includes
*
*/

require_once('/sistema/Sistemas/SGPadrao/sbin/sgpadrao.sbin.php');

$SISTEMA_ = new sistema($SISTEMA);
$SISTEMA_->ImportarEntidade("PADRAO");
$SISTEMA = $SISTEMA_->getSISTEMA();

unset($SISTEMA_);
$PADRAO_ = new Padrao($SISTEMA);
	$PADRAO_->ListarTrailingON();
	$SISTEMA = $PADRAO_->getSISTEMA();
/* ------------------------------------------------ */	
	
	
	
/* ------------------------------------------------ */	
unset($PADRAO_);

 
?>