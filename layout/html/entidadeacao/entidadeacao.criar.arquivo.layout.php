<?php
//print_r($_REQUEST);



$this->SISTEMA_['SAIDA']['EXIBIR'] = 
          " 
<section class=\"content\">
  <div class=\"row\" style=\"width=700px\">
    <div class=\"col-md-11\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Criar Arquivo</h3>
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
                <label for=\"TXT_ENTIDADEACAO_ARQUIVO_MODELO\" class=\"col-sm-3 control-label\">Importar Modelo</label>
                <div class=\"col-sm-6\">
                  <select class=\"form-control\"  name=\"TXT_ENTIDADEACAO_ARQUIVO_MODELO\" id=\"TXT_ENTIDADEACAO_ARQUIVO_MODELO\" onchange=\"PesquisaDados('.?XMLHTML=true&SID=$TMP_SESSAO_UID&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=IMPORTAR_MODELO&TXT_ENTIDADEACAO_ARQUIVO_MODELO='+this.value+'&TXT_ENTIDADEACAO_ARQUIVO_NOME='+TXT_ENTIDADEACAO_ARQUIVO_NOME.value,'','DIV_ENTIDADEACAO_ARQUIVO_CONTEUDO',null,null)\">
                    <option value=\"0\">Nenhum</option>
                    <option value=\"LIB_PADRAO\">LIB_PADRAO</option>
                    <option value=\"CONF_PADRAO\">CONF_PADRAO</option>
                    <option value=\"DEF_PADRAO\">DEF_PADRAO</option>
                    <option value=\"DEF_PADRAO_IDIOMA\">DEF_PADRAO_IDIOMA</option>
                    <option value=\"BIN_PADRAO_ALTERAR\">BIN_PADRAO_ALTERAR</option>
                    <option value=\"BIN_PADRAO_ATIVAR\">BIN_PADRAO_ATIVAR</option>
                    <option value=\"BIN_PADRAO_CONSULTAR\">BIN_PADRAO_CONSULTAR</option>
                    <option value=\"BIN_PADRAO_DESATIVAR\">BIN_PADRAO_DESATIVAR</option>
                    <option value=\"BIN_PADRAO_EXCLUIR\">BIN_PADRAO_EXCLUIR</option>
                    <option value=\"BIN_PADRAO_INCLUIR\">BIN_PADRAO_INCLUIR</option>
                    <option value=\"BIN_PADRAO_PESQUISAR\">BIN_PADRAO_PESQUISAR</option>
                    <option value=\"LAYOUT_HTML_PADRAO_PESQUISAR\">LAYOUT_HTML_PADRAO_PESQUISAR</option>
                    <option value=\"LAYOUT_HTML_PADRAO_PESQUISA\">LAYOUT_HTML_PADRAO_PESQUISA</option>
                    <option value=\"LAYOUT_HTML_PADRAO_ALTERAR\">LAYOUT_HTML_PADRAO_ALTERAR</option>
                    <option value=\"LAYOUT_HTML_PADRAO_INCLUIR\">LAYOUT_HTML_PADRAO_INCLUIR</option>
                    <option value=\"LAYOUT_HTML_PADRAO_CONSULTAR\">LAYOUT_HTML_PADRAO_CONSULTAR</option>
                  </select>
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" class=\"col-sm-1 control-label\">Conteudo</label>
                <div class=\"col-sm-11\" id=\"DIV_ENTIDADEACAO_ARQUIVO_CONTEUDO\">
                 <textarea rows=\"12\" cols=\"70\" class=\"form-control\"  name=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" id=\"TXT_ENTIDADEACAO_ARQUIVO_CONTEUDO\" style=\"background-color:#000000; color:#11CC11; font-family:Courier New; font-size:12px;\">".@$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO."</textarea>
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