<?php
/**
* @file sistema.criar.tabela.layout.php
* @name sistema.criar.tabela
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


/* Layout do Formulário Pesquisar */
$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"   <div class=\"col-md-7\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">Criar Tabela</h3>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_CRIAR_TABELA\" name=\"FORM_SISTEMA_CRIAR_TABELA\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"TABELA_CARREGAR_CSV\">
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-3 control-label\">Arquivo CSV</label>
              <div class=\"col-sm-3\">
                <input type=\"file\" accept=\"text/csv\" class=\"form-control\" id=\"TXT_ARQUIVO_CSV\" placeholder=\"Arquivo CSV\" name=\"TXT_ARQUIVO_CSV\" onchange=\"PesquisaDados('.?XMLHTML=true&SID=$TMP_SESSAO_UID','','DIV_SISTEMA_TABELA_CARREGAR_CSV','FORM_SISTEMA_CRIAR_TABELA')\">
              </div>
            </div>  
          </form>
        </div>
        <div id=\"DIV_SISTEMA_TABELA_CARREGAR_CSV\"></div>
      </div>
    </div>
";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='Sistema';
  LBL_SUBTITULO.innerText='Criar Tabela';
  LBL_SUBTITULO_LOCAL.innerText='Criar Tabela';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa \"></i> Sistema</a>';
</script>";

?>