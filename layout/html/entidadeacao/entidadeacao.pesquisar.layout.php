<?php
$Conteudo_Titulo = "Entidade / Ação";
$Conteudo_Subtitulo = "Pesquisar";
$Conteudo_Icone = "fa-cubes";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";


$this->SISTEMA_['SAIDA']['EXIBIR'] =
  "  
    <div class=\"col-md-5\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Entidades do Sistema</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=" . $TMP_SESSAO_UID . "&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=INCLUIR_ENTIDADE','','DIV_CONTEUDO',null)\" >Nova Entidade</button>
        </div>
        <div class=\"box-body\" id=\"DIV_ENTIDADEACAO_ENTIDADE\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ENTIDADE_PESQUISAR\" name=\"FORM_ENTIDADEACAO_ENTIDADE_PESQUISAR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=" . $TMP_SESSAO_UID . "','','DIV_CONTEUDO','FORM_ENTIDADEACAO_ENTIDADE_PESQUISAR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"CONSULTAR_ENTIDADE\">
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" class=\"col-sm-3 control-label\">Entidade</label>
              <div class=\"col-sm-8\">
                  <select class=\"form-control\" id=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" name=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" placeholder=\"Escolha\" required onChange=\"PesquisaDados('.?XMLHTML=true&SID=" . $TMP_SESSAO_UID . "','','DIV_ENTIDADEACAO_ENTIDADE_CONSULTA','FORM_ENTIDADEACAO_ENTIDADE_PESQUISAR')\">
                    <option value=\"\">Nenhuma</option>
                  ";

foreach ($VAR_ENTIDADEACAO_ENTIDADE_LISTA as $tmp_Select) {
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"" . $tmp_Select['NOME'] . "\" >" . $tmp_Select['NOME'] . "</option>";
}

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "</select>
              </div>
            </div>
            <div id=\"DIV_ENTIDADEACAO_ENTIDADE_CONSULTA\">
              
            </div>
          </form> 
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div id=\"DIV_ENTIDADEACAO_ACOES_LISTAR\">
    
    </div>
";

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";

/*
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_TITULO']['TEXT'] = $Conteudo_Titulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_SUBTITULO']['TEXT'] = $Conteudo_Subtitulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_SUBTITULO_LOCAL']['TEXT'] = $Conteudo_Subtitulo;
$this->SISTEMA_['SAIDA']['FORMULARIO']['COMPONENTES']['LBL_ARVORE_LOCAL']['TEXT'] = $Conteudo_ArvoreLocal;
*/