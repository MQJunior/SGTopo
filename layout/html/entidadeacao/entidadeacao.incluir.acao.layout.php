<?php

$VAR_ENTIDADEACAO_ACAO_ENTIDADE = strtoupper($this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ACAO_ENTIDADE']); 

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"   <div class=\"col-md-6\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Criar Ação</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=LISTAR_ACAO&TXT_ENTIDADEACAO_ENTIDADE_NOME=".$VAR_ENTIDADEACAO_ACAO_ENTIDADE."','','DIV_ENTIDADEACAO_ACAO',null)\" >Listar</button>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ENTIDADE_INCLUIR\" name=\"FORM_ENTIDADEACAO_ENTIDADE_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_ENTIDADEACAO_ACAO','FORM_ENTIDADEACAO_ENTIDADE_INCLUIR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR_ACAO\">
            <div class=\"form-group\">
            <label for=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" class=\"col-sm-4 control-label\">Entidade</label>
              <div class=\"col-sm-7\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_ENTIDADE\" value=\"".$VAR_ENTIDADEACAO_ACAO_ENTIDADE."\" required readonly>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ACAO_NOME\" class=\"col-sm-4 control-label\">Nome da Ação</label>
              <div class=\"col-sm-7\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_NOME\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_NOME\" value=\"\" required>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" class=\"col-sm-4 control-label\">Nível</label>
              <div class=\"col-sm-2\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ACAO_NIVEL\" value=\"0\" maxlength=\"1\" required>
              </div>
              <label for=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\" class=\"col-sm-2 control-label\">Restrito</label>
              <div class=\"col-sm-1\">
                <input type=\"checkbox\"  id=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\"  name=\"TXT_ENTIDADEACAO_ACAO_RESTRITO\" checked>
              </div>
            </div>
            
            <div class=\"form-group\">
              <div class=\"col-sm-offset-3 col-sm-9\">
              <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
              </div>
            </div>
          </form> 
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
        
";

?>