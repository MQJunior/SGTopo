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


$tmpTABELASESSAO  = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_DB'];

$tmpTABELAUSUARIO = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

$tmpOptionTabela="";
foreach($VAR_SISTEMA_TABELA_DADOS as $tmpTabelas){
  $tmpNomeTabela=trim($tmpTabelas['NOME']);
  $tmpOptionTabela.="<option value=\"$tmpNomeTabela\">$tmpNomeTabela</option>";
}

//echo $tmpOptionTabela;

$this->SISTEMA_['SAIDA']['EXIBIR'] = "
        <div class=\"box-header\">
          <h3 class=\"box-title\">Análise do arquivo</h3>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_GERAR_SQL\" name=\"FORM_SISTEMA_GERAR_SQL\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_SISTEMA_TABELA_GERAR_SQL',this.name)\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"TABELA_CSV_GERAR_SQL\">
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-3 control-label\">Primeira Linha</label>
              <div class=\"col-sm-11\">
              <h6>$VAR_ARQUIVO_INFO</h6>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_TABELA_NOME\" class=\"col-sm-3 control-label\">Nome da Tabela</label>
              <div class=\"col-sm-5\">
              <input type=\"text\" class=\"form-control\" id=\"TXT_TABELA_NOME\" name=\"TXT_TABELA_NOME\" VALUE=\"\"></input>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo 0</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[0]\" name=\"TXT_CAMPO[0]\" VALUE=\"CODIGO\" readonly>
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[0]\" name=\"TXT_DOMINIO[0]\">
                  <option value=\"CODIGO\">CODIGO</option>
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA[0]\" name=\"TXT_REFERENCIA[0]\" style=\"display:none\">
                    <option value=\"0\">NENHUMA</option>
                  </select>
              </div>
              <div class=\"col-sm-2\">
                  <h6><b>Auto Incremento</b></h6>
              </div>
            </div>
            ";
            for($i=0; $i<$tmpQtdeCampos; $i++){
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo ". ($i+1) ."</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[". ($i+1) ."]\" name=\"TXT_CAMPO[". ($i+1) ."]\">
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[". ($i+1) ."]\" name=\"TXT_DOMINIO[". ($i+1) ."]\" onchange=\"if(this.value=='CODIGO_LINK'){TXT_REFERENCIA_".($i+1).".style='display:block';}else{TXT_REFERENCIA_".($i+1).".style='display:none';}\">
                  <option value=\"\">--- INATIVO --- </option>
              ";
              foreach($VAR_SISTEMA_DOMINIOS_DADOS as $tmpDominio)
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
                <option value=\"".trim($tmpDominio['DOMINIO'])."\">".trim($tmpDominio['DOMINIO'])."</option>
              ";
              
$this->SISTEMA_['SAIDA']['EXIBIR'] .=            "
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA_".($i+1)."\" name=\"TXT_REFERENCIA[".($i+1)."]\" style=\"display:none\">
                    <option value=\"0\">NENHUMA</option>
                    $tmpOptionTabela
                  </select>
              </div>
              <div class=\"col-sm-2\">
                <h6>".$tmpConteudoCampos[$i]."</h6>
              </div>
            </div>";
            }
            
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo ". (++$i) ."</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[$i]\" name=\"TXT_CAMPO[$i]\" VALUE=\"SESSAO\" readonly>
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[$i]\" name=\"TXT_DOMINIO[$i]\" readonly>
                  <option value=\"CODIGO_LINK\">CODIGO_LINK</option>
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA[$i]\" name=\"TXT_REFERENCIA[$i]\" readonly>
                    <option value=\"$tmpTABELASESSAO\">$tmpTABELASESSAO</option>
                  </select>
              </div>
              <div class=\"col-sm-2\">
                <h6><b>Referencia</b></h6>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo ". (++$i) ."</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[$i]\" name=\"TXT_CAMPO[$i]\" VALUE=\"DATACRIACAO\" readonly>
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[$i]\" name=\"TXT_DOMINIO[$i]\" readonly>
                  <option value=\"DATA\">DATA</option> 
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA[$i]\" name=\"TXT_REFERENCIA[$i]\" style=\"display:none\"readonly>
                    <option value=\"0\">NENHUMA</option>
                  </select>
              </div>
              <div class=\"col-sm-2\">
                <h6>Automático</h6>
              </div>
            </div>
            
            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo ". (++$i) ."</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[$i]\" name=\"TXT_CAMPO[$i]\" VALUE=\"USUARIO\" readonly>
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[$i]\" name=\"TXT_DOMINIO[$i]\" readonly>
                  <option value=\"CODIGO_LINK\">CODIGO_LINK</option>
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA[$i]\" name=\"TXT_REFERENCIA[$i]\" readonly>
                    <option value=\"$tmpTABELAUSUARIO\">$tmpTABELAUSUARIO</option>
                  </select>
              </div>
              <div class=\"col-sm-2\">
                <h6><b>Referencia</b></h6>
              </div>
            </div>

            <div class=\"form-group\">
              <label for=\"\" class=\"col-sm-2 control-label\">Campo ". (++$i) ."</label>
              <div class=\"col-sm-3\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_CAMPO[$i]\" name=\"TXT_CAMPO[$i]\" VALUE=\"REG_ATIVO\" readonly>
              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" id=\"TXT_DOMINIO[$i]\" name=\"TXT_DOMINIO[$i]\" readonly>
                  <option value=\"TIPO\">TIPO</option>
                </select>
              </div>
              <div class=\"col-sm-2\">
                  <select class=\"form-control\" id=\"TXT_REFERENCIA[$i]\" name=\"TXT_REFERENCIA[$i]\" style=\"display:none\" readonly>
                    <option value=\"0\">NENHUMA</option>
                  </select>
              </div>
              <div class=\"col-sm-2\">
                <h6>1</h6>
              </div>
            </div>
            <div class=\"form-group\">
              <div class=\"col-sm-offset-5 col-sm-7\"><button type=\"submit\" style=\"display:none\" id=\"BTN_FORM_SUBMIT\"  name=\"BTN_FORM_SUBMIT\"></button>
                <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"BTN_FORM_SUBMIT.click()\"><i class=\"fa fa-floppy-o\"></i> <b> GERAR</b></a>
              </div>
            </div>
          </form>
        </div>
        <div id=\"DIV_SISTEMA_TABELA_GERAR_SQL\"></div>
";



?>