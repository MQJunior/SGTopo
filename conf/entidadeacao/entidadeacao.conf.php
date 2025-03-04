<?php
/**
* sgpadrao.entidadeacao.conf.php
*
* Sistema - Configuracao de Entidade Acao
*
* Definiçoes para Entidade Acao
*
* @date   2018-02-18
*
* @author       Marcio Queiroz Jr <mqjunior@gmail.com>
* @version      1.0
* @copyright    Copyright © 2006, Marcio Queiroz Jr.
* @package      SGPadrao
* @subpackage   Config
* @category     EntidadeAcao
*/


$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];

$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['CONF']['DATABASE']['TBL_ENTIDADE'] = 'TBL_SYS_ENTIDADES';
$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['CONF']['DATABASE']['TBL_ACAO']     = 'TBL_SYS_ACOES';

?>