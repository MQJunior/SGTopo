<?php
$Conteudo_Titulo = "Usuário";
$Conteudo_Subtitulo = "Perfil";
$Conteudo_Icone = "fa-user";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";


$Conteudo_Usuario_Perfil_Codigo = $VAR_USUARIO_CODIGO;
$Conteudo_Usuario_Perfil_NomeCompleto = $VAR_USUARIO_NOME;

$Conteudo_Usuario_Perfil_Imagem = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO']."dist/img/user2-160x160.jpg";

$Conteudo_Usuario_Perfil_NomeCurto = $VAR_USUARIO_NOME_EXIBIR;
$Conteudo_Usuario_Perfil_Funcao = $VAR_USUARIO_FUNCAO;
$Conteudo_Usuario_Perfil_Titulo = $VAR_USUARIO_TITULO;
$Usuario_Perfil_DataCadastro = "Membro desde: ".$VAR_USUARIO_DATACRIACAO;

$Conteudo_Usuario_Perfil_Email = $VAR_USUARIO_EMAIL;

if (($VAR_IMAGEM_LINK == null)||($VAR_IMAGEM_LINK == ""))
  $Conteudo_Usuario_Imagem = "<img class=\"profile-user-img img-responsive img-circle\" src=\"".$Conteudo_Usuario_Perfil_Imagem."\" alt=\"Imagem do Perfil do Usuário\">";
else
  $Conteudo_Usuario_Imagem = "<img class=\"profile-user-img img-responsive img-circle\" src=\"".$VAR_IMAGEM_LINK."\" alt=\"Imagem do Perfil do Usuário\">";
 

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
" 
    <div class=\"col-md-3\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-body box-profile\">
            <form class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_ALTERAR_IMAGEM\" name=\"FORM_USUARIO_ALTERAR_IMAGEM\" accept-charset=\"ISO-8859-1\" >
              <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
              <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR_IMAGEM\">
              <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
            <label for=\"ID_FOTO_PERFIL\" class=\"img-responsive img-circle pointer\" style=\"cursor:pointer\" ID=\"LBL_USUARIO_IMAGEM\">
              ".$Conteudo_Usuario_Imagem."
            </label>
              <input type=\"file\" name=\"txtFotoPerfil\" id=\"ID_FOTO_PERFIL\" accept=\"image/*\" style=\"display:none\" onChange=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','LBL_USUARIO_IMAGEM','FORM_USUARIO_ALTERAR_IMAGEM')\">
            </form>

          <h3 class=\"profile-username text-center\">".$Conteudo_Usuario_Perfil_NomeCurto."</h3>
          <p class=\"text-muted text-center\">".$Conteudo_Usuario_Perfil_Funcao."</p>
          <h6 class=\"text-muted text-center\">".$Usuario_Perfil_DataCadastro."</h6>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class=\"col-md-9\">
      <!-- /.nav-tabs-custom -->
      <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_PERFIL\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Informações do Usuário</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_PERFIL\" name=\"FORM_USUARIO_PERFIL\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_CONTEUDO','FORM_USUARIO_PERFIL')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR_PERFIL\">
            <input type=\"hidden\" name=\"TXT_USUARIO_PERFIL_CODIGO\" value=\"".$VAR_USUARIO_CODIGO."\">
            <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_NOME\" class=\"col-sm-2 control-label\">Nome Completo</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_PERFIL_NOME\" placeholder=\"Name\" name=\"TXT_USUARIO_PERFIL_NOME\" value=\"".$Conteudo_Usuario_Perfil_NomeCompleto."\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_EMAIL\" class=\"col-sm-2 control-label\">Email</label>
                <div class=\"col-sm-10\">
                  <input type=\"email\" class=\"form-control\" id=\"TXT_USUARIO_PERFIL_EMAIL\" placeholder=\"Email\" disabled name=\"TXT_USUARIO_PERFIL_EMAIL\" value=\"".$Conteudo_Usuario_Perfil_Email."\">
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_NOMECURTO\" class=\"col-sm-2 control-label\">Nome Curto</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_PERFIL_NOMECURTO\" placeholder=\"Name\" name=\"TXT_USUARIO_PERFIL_NOMECURTO\" value=\"".$Conteudo_Usuario_Perfil_NomeCurto."\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_FUNCAO\" class=\"col-sm-2 control-label\">Função</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_PERFIL_FUNCAO\" placeholder=\"Função\" name=\"TXT_USUARIO_PERFIL_FUNCAO\" value=\"".$Conteudo_Usuario_Perfil_Funcao."\">
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_TITULO\" class=\"col-sm-2 control-label\">Título</label>
                <div class=\"col-sm-10\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_PERFIL_TITULO\" placeholder=\"Título\" name=\"TXT_USUARIO_PERFIL_TITULO\" value=\"".$Conteudo_Usuario_Perfil_Titulo."\">
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-offset-2 col-sm-10\">
                <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                </div>
              </div>
          </form>        
        </div>
      </div>
      
      <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_SENHA_ALTERAR\" > 
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Alterar Senha</h3>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_SENHA_ALTERAR\" name=\"FORM_USUARIO_SENHA_ALTERAR\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_CONTEUDO','FORM_USUARIO_SENHA_ALTERAR')\">
              <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
              <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR_SENHA\">
              <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_EMAIL_ALTERAR_SENHA\" class=\"col-sm-2 control-label\">Email</label>
                <div class=\"col-sm-10\">
                  <input type=\"email\" class=\"form-control\" id=\"TXT_USUARIO_EMAIL_ALTERAR_SENHA\" placeholder=\"Email\" readonly=\"readonly\" name=\"TXT_USUARIO_EMAIL_ALTERAR_SENHA\" value=\"".$Conteudo_Usuario_Perfil_Email."\" >
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_SENHAATUAL\" class=\"col-sm-2 control-label\">Senha Atual</label>
                <div class=\"col-sm-10\">
                  <input type=\"password\" class=\"form-control\" id=\"TXT_USUARIO_SENHAATUAL\" placeholder=\"Password\" name=\"TXT_USUARIO_SENHAATUAL\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_SENHANOVA\" class=\"col-sm-2 control-label\">Nova Senha</label>
                <div class=\"col-sm-10\">
                  <input type=\"password\" class=\"form-control\" id=\"TXT_USUARIO_SENHANOVA\" placeholder=\"Password\" name=\"TXT_USUARIO_SENHANOVA\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_USUARIO_SENHACONFIRMA\" class=\"col-sm-2 control-label\">Repita Nova Senha</label>
                <div class=\"col-sm-10\">
                  <input type=\"password\" class=\"form-control\" id=\"TXT_USUARIO_SENHACONFIRMA\" placeholder=\"Password\" name=\"TXT_USUARIO_SENHACONFIRMA\" required>
                </div>
              </div>
              <div class=\"form-group\">
                  <div class=\"col-sm-offset-2 col-sm-10\">
                  <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                  </div>
              </div>
          </form>        
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