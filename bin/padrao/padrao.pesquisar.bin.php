<?php
/**
 * @file padrao.pesquisar.bin.php
 * @name padrao.pesquisar
 * @desc
 *   Realiza a pesquisa de registro no Banco de Dados pelo nome
 *
 * @author     Márcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Márcio Queiroz Jr.
 * @package    padrao
 * @subpackage bin
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */

/* Pesquisa para registro inativos */
(isset($_REQUEST['TXT_REGISTROS_INATIVOS'])) ? $tmpRegInativos = $_REQUEST['TXT_REGISTROS_INATIVOS'] : $tmpRegInativos = false;

/* Realiza a pesquisa no Banco de Dados */
$PADRAO_ = new Padrao($this->SISTEMA_);
(isset($_REQUEST['TXT_PADRAO_PESQUISAR'])) ? $PADRAO_->Pesquisar($_REQUEST['TXT_PESQUISA_CAMPO'], $_REQUEST['TXT_PADRAO_PESQUISAR'], $tmpRegInativos, $_REQUEST['TXT_REGISTROS_QUANTIDADE']) : $PADRAO_->PesquisarNome(null, null, false, 20);
$this->SISTEMA_ = $PADRAO_->getSISTEMA();
unset($PADRAO_);


if (isset($_REQUEST['TXT_PADRAO_PESQUISAR']))
  require ($this->SISTEMA_['LAYOUT'] . "../basic/padrao/padrao.pesquisa.layout.php");  // Layout Resumido
else
  require ($this->SISTEMA_['LAYOUT'] . "../basic/padrao/padrao.pesquisar.layout.php"); // Layout Completo
?>