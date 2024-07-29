<?php
//print_r($_REQUEST);

$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('</textarea>','[@textarea>',$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
          " 
<section class=\"content\">
  <div class=\"row\" style=\"width=700px\">
    <div class=\"col-md-11\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Editar Arquivo</h3>
          <div class=\"box-tools pull-right\">
            <button class=\"btn btn-box-tool\" data-widget=\"remove\" onclick=\"DIV_CONTEUDO_AUXILIAR.innerHTML=''\"><i class=\"fa fa-times\"></i></button>
          </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ARQUIVO_CONTEUDO\" name=\"FORM_ENTIDADEACAO_ARQUIVO_CONTEUDO\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_CONTEUDO_AUXILIAR','FORM_ENTIDADEACAO_ARQUIVO_CONTEUDO')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"SALVAR_ARQUIVO\"> 
              <div class=\"form-group\">
                <label for=\"TXT_ENTIDADEACAO_ARQUIVO_NOME\" class=\"col-sm-1 control-label\">Arquivo</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ARQUIVO_NOME\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ARQUIVO_NOME\" value=\"".@$VAR_ENTIDADEACAO_ARQUIVO_NOME."\" required=\"\" readonly>
                </div>
                <div class=\"col-sm-1\">
                  <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\">Salvar</button>
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" class=\"col-sm-1 control-label\">Conteudo</label>
                <div class=\"col-sm-11\">
                 <textarea rows=\"30\" cols=\"170\" class=\"form-control\"  name=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" id=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" style=\"background-color:#000000; color:#11CC11; font-family:Courier New; font-size:12px;\">".@$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO."</textarea>
                </div>
                
              </div>
               
          </form>
          
          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div>
  </div>
</section>
";
?>