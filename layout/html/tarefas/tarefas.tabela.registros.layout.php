<?php
/**
* @file tarefas.pesquisa.layout.php
* @name tarefas.pesquisa
* @desc
*   Linhas da tabela de dados da pesquisa
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-07-21  v. 0.0.0
*
*/

/* Monta as linhas do resultado da pesquisa */
$this->SISTEMA_['SAIDA']['EXIBIR'] .="<label for=\"TXT_TAREFAS_PARAMETRO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_PARAMETRO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" id=\"TXT_TAREFAS_PARAMETRO\" name=\"TXT_TAREFAS_PARAMETRO\" placeholder=\"$SysRtl_Tarefas_Campos_PARAMETRO\" required>";
            
foreach ($this->SISTEMA_['ENTIDADE']['TAREFAS']['TABELAS']['DADOS'] as $tmpTabelaDados){
  $tmpSelected = "";
  //if ($tmpTabelaDados['CODIGO'] == $VAR_TAREFAS_PARAMETRO)
   // $tmpSelected = "selected";
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "              <option value=\"".$tmpTabelaDados['CODIGO']."\" $tmpSelected>".$tmpTabelaDados['CODIGO']." - ".$tmpTabelaDados['NOME']."</option>";
}
  
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "            </select>            
          </div>";
?>