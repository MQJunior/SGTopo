<?php
/**
* @file sistema.tabela.csv.gerar.sql.layout.php
* @name sistema.tabela.csv.gerar.sql
* @desc
*   Formulário contendo o script para criação de tabelas
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    padrao
* @subpackage bin
* @todo       
*   Adicionar novos campos
*
* @date 2018-02-28  v. 0.0.0
*
*/

$this->SISTEMA_['SAIDA']['EXIBIR'] = "
        <div class=\"box-header\">
          <h3 class=\"box-title\">Gerar SQL</h3>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_CRIAR_TABELA_CSV\" name=\"FORM_SISTEMA_CRIAR_TABELA_CSV\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"CRIAR_TABELA_SQL\">
            <div class=\"form-group\">
              <label for=\"TXT_SQL_TABELA_GENERATOR\" class=\"col-sm-3 control-label\">SQL - GENERATOR </label>
              <div class=\"col-sm-8\">
              <textarea class=\"form-control\" name=\"TXT_SQL_TABELA_GENERATOR\" id=\"TXT_SQL_TABELA_GENERATOR\" rows=\"2\">$VAR_SQL_TABELA_GENERATOR</textarea>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_SQL_TABELA_CAMPOS\" class=\"col-sm-3 control-label\">SQL CAMPOS</label>
              <div class=\"col-sm-8\">
              <textarea class=\"form-control\" name=\"TXT_SQL_TABELA_CAMPOS\" id=\"TXT_SQL_TABELA_CAMPOS\" rows=\"10\">$VAR_SQL_TABELA_CAMPOS</textarea>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_SQL_TABELA_PRIMARY_KEY\" class=\"col-sm-3 control-label\">SQL CAMPO - PRIMARY KEY</label>
              <div class=\"col-sm-8\">
              <textarea class=\"form-control\" name=\"TXT_SQL_TABELA_PRIMARY_KEY\" id=\"TXT_SQL_TABELA_PRIMARY_KEY\" rows=\"2\">$VAR_SQL_TABELA_PRIMARY_KEY</textarea>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_SQL_TABELA_FOREING_KEY\" class=\"col-sm-3 control-label\">SQL CAMPOS - FOREING KEY</label>
              <div class=\"col-sm-8\">
              <textarea class=\"form-control\" name=\"TXT_SQL_TABELA_FOREING_KEY\" id=\"TXT_SQL_TABELA_FOREING_KEY\" rows=\"5\">$VAR_SQL_TABELA_FOREING_KEY</textarea>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_SQL_TABELA_TRIGGER\" class=\"col-sm-3 control-label\">SQL TRIGGER</label>
              <div class=\"col-sm-8\">
              <textarea class=\"form-control\" name=\"TXT_SQL_TABELA_TRIGGER\" id=\"TXT_SQL_TABELA_TRIGGER\" rows=\"3\">$VAR_SQL_TABELA_TRIGGER</textarea>
              </div>
            </div>
            <div class=\"form-group\">
              <div class=\"col-sm-offset-5 col-sm-7\"><button type=\"submit\" style=\"display:none\" id=\"BTN_FORM_SUBMIT_TABELA_CSV\"  name=\"BTN_FORM_SUBMIT_TABELA_CSV\"></button>
                <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"BTN_FORM_SUBMIT_TABELA_CSV.click()\"><i class=\"fa fa-floppy-o\"></i> <b> GERAR</b></a>
              </div>
            </div>
          </form>
        </div>
        <DIV id=\"DIV_SISTEMA_CRIAR_TABELA_CSV\">
        </DIV>";

?>