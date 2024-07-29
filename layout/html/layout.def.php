<?php
/**
* @file layout.def.php
* @name layout
* @desc
*   Descrição padrão
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    layout
* @subpackage Def
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/


require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DEF'].'idioma.'.strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']).'.def.php');

$SistemaLayoutSkin="yellow"; //Amarelo

$SistemaLayoutCor="warning"; //Amarelo

$SistemaLayoutRegInativoCor="yellow"; //Amarelo

$hashDiv = sha1(date('Y-m-d H:i:s'));
$this->SISTEMA_['MENSAGEM']['LAYOUT']['SUCESSO']="
<script language=\"text/javascript\">
   DIV_CONTEUDO_MENSAGEM.innerHTML= '<div id=\"DIV_MENSAGEM_SUCESSO_$hashDiv\" >    <div class=\"alert alert-success alert-dismissable\" >   <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\" onclick=\"DIV_MENSAGEM_SUCESSO_$hashDiv.innerHTML=\'\';\">×</button>      <h4>	<i class=\"icon fa fa-check\"></i> {SysRtl_Mensagem_Sucesso_Titulo}</h4>      {SaidaInformacaoSucesso}    </div>  </div>';
  
  var fechar_$hashDiv = setInterval(FECHAR_DIV_$hashDiv, 5000);
  function FECHAR_DIV_$hashDiv(){
    //if (isset(DIV_MENSAGEM_SUCESSO_$hashDiv))
      DIV_MENSAGEM_SUCESSO_$hashDiv.innerHTML='';
  }
  unset(fechar_$hashDiv);
</script>";
?>