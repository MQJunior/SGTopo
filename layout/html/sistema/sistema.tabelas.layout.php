<?php
/**
* @file sistema.tabelas.layout.php
* @name sistema.tabelas
* @desc
*   Formulário de pesquisa das tabelas do banco de dados
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    padrao
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

$VAR_DADOS_PESQUISA =$VAR_SISTEMA_TABELAS_DADOS;

//print_r($VAR_DADOS_PESQUISA);die();

/* Layout do Formulário Pesquisar */
$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"   <div class=\"col-md-4\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">Tabelas do Sistema</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=SISTEMA&SysEntidadeAcao=CRIAR_TABELA','','DIV_SISTEMA_CRIAR_TABELA',null)\" >Criar Tabela</button>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_TABELAS\" name=\"FORM_SISTEMA_TABELAS\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"TABELAS\">
            <div class=\"form-group\">
              <label for=\"TXT_SISTEMA_TABELA_NOME\" class=\"col-sm-3 control-label\">Tabela</label>
              <div class=\"col-sm-8\">
                  <select class=\"form-control\" id=\"TXT_SISTEMA_TABELA_NOME\" name=\"TXT_SISTEMA_TABELA_NOME\" placeholder=\"Escolha\" required onChange=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_CONTEUDO','FORM_SISTEMA_TABELAS')\">
                    <option value=\"\">Nenhuma</option>";
            
  foreach($VAR_DADOS_PESQUISA as $tmpTabelas)
    $this->SISTEMA_['SAIDA']['EXIBIR'] .="<option value=\"".$tmpTabelas['NOME']."\">".$tmpTabelas['NOME']."</option>";

$this->SISTEMA_['SAIDA']['EXIBIR'] .="</select>
              </div>
            </div>
              
          </form>
        </div>
      </div>
    </div>
    <div id=\"DIV_SISTEMA_CRIAR_TABELA\" name=\"DIV_SISTEMA_CRIAR_TABELA\">
    </div>
";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='Sistema';
  LBL_SUBTITULO.innerText='Tabelas';
  LBL_SUBTITULO_LOCAL.innerText='Tabelas';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa \"></i> Sistema</a>';
</script>";

?>