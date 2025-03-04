<?php
$Conteudo_Titulo = "Usuário";
$Conteudo_Subtitulo = "Incluir";
$Conteudo_Icone = "fa-user";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"
   <div class=\"col-md-8 col-sm-offset-2\">
    
<!-- Profile Image -->
<div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_PERFIL\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Criar um novo Usuário</h3>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_INCLUIR\" name=\"FORM_USUARIO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_CONTEUDO','FORM_USUARIO_INCLUIR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
            
              <div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_NOME\" placeholder=\"Nome Completo\" name=\"TXT_USUARIO_NOME\" value=\"\" required>
                </div>
              </div>
              <div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_NOME_EXIBIR\" placeholder=\"Nome Curto\" name=\"TXT_USUARIO_NOME_EXIBIR\" value=\"\" required>
                </div>
              </div><div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"email\" class=\"form-control\" id=\"TXT_USUARIO_EMAIL\" placeholder=\"Email\" name=\"TXT_USUARIO_EMAIL\" value=\"\" required>
                </div>
              </div>
              <div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"password\" class=\"form-control\" id=\"TXT_USUARIO_SENHA\" placeholder=\"Senha\" name=\"TXT_USUARIO_SENHA\" value=\"\" required>
                </div>
              </div>

              <div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_FUNCAO\" placeholder=\"Função\" name=\"TXT_USUARIO_FUNCAO\" value=\"\">
                </div>
              </div>
              <div class=\"form-group\">
                
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_TITULO\" placeholder=\"Título\" name=\"TXT_USUARIO_TITULO\" value=\"\">
                </div>
              </div>
              
          <div class=\"form-group\">
    <div class=\"col-sm-12\">
    	<textarea class=\"form-control\" rows=\"3\" placeholder=\"Descrição\" name=\"TXT_USUARIO_DESCRICAO\"></textarea>
    </div>
</div>
<div class=\"form-group\">
                <div class=\"col-sm-offset-5 col-sm-7\">
                <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                </div>
              </div></form>        
        </div>
      </div>

   </div>
  
";
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";
?>