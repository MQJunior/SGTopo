<?php



$VAR_ENTIDADEACAO_ENTIDADE_TABELAS_LISTA = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_TABELAS_LISTA']; 

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"
    <div class=\"col-md-5\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Criar Nova Entidade</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=ENTIDADEACAO&SysEntidadeAcao=PESQUISAR','','DIV_CONTEUDO',null)\" >Pesquisar</button>
        </div>
        <div class=\"box-body\" id=\"DIV_ENTIDADEACAO_ENTIDADE\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ENTIDADEACAO_ENTIDADE_INCLUIR\" name=\"FORM_ENTIDADEACAO_ENTIDADE_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_CONTEUDO','FORM_ENTIDADEACAO_ENTIDADE_INCLUIR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"ENTIDADEACAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR_ENTIDADE\">
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" class=\"col-sm-4 control-label\">Nome da Entidade</label>
              <div class=\"col-sm-7\">
                <input type=\"text\" class=\"form-control\" id=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" placeholder=\"Name\" name=\"TXT_ENTIDADEACAO_ENTIDADE_NOME\" value=\"\" required>
              </div>
            </div>
            <div class=\"form-group\">
              <label for=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" class=\"col-sm-4 control-label\">Tabela no DataBase</label>
              <div class=\"col-sm-7\">
                  <select class=\"form-control\" id=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" name=\"TXT_ENTIDADEACAO_ENTIDADE_TABELA\" placeholder=\"Escolha\" required>
                  ";
                    
                        foreach ($VAR_ENTIDADEACAO_ENTIDADE_TABELAS_LISTA as $tmp_Select){
                              $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"".$tmp_Select['NOME']."\" >".$tmp_Select['NOME']."</option>";
                        }  
                      
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
              </div>
            </div>
            <div class=\"form-group\">
              <div class=\"col-sm-offset-3 col-sm-9\">
              <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
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
$Conteudo_Titulo = "Entidade / Ação";
$Conteudo_Subtitulo = "Incluir Entidade";

$Conteudo_Icone = "fa-cubes";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";
?>