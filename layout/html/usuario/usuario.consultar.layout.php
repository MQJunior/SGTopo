<?php
$Conteudo_Titulo = "Usuário";
$Conteudo_Subtitulo = "Consultar";
$Conteudo_Icone = "fa-user";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";

$tmpPermissao = new permissao($this->SISTEMA_);

($VAR_USUARIO_REG_ATIVO==1)?$tmpStatusREG_ATIVO = "Ativo <i class=\"fa fa-unlock text-green\"></i>":$tmpStatusREG_ATIVO = "Bloqueado <i class=\"fa fa-lock text-red\" ></i>";

$tmpBtnAtivar ="";
if ($VAR_USUARIO_REG_ATIVO==1){
  if($tmpPermissao->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'],"USUARIO","BLOQUEAR"))
    $tmpBtnAtivar = "<button class=\"btn btn-block btn-danger btn-xs\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=USUARIO&SysEntidadeAcao=BLOQUEAR&txtChaveRegistro=".$VAR_USUARIO_CODIGO."','','DIV_CONTEUDO',null)\">Bloquear</button>";
}else{
  if($tmpPermissao->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'],"USUARIO","ATIVAR"))
    $tmpBtnAtivar = "<button class=\"btn btn-block btn-success btn-xs\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=USUARIO&SysEntidadeAcao=ATIVAR&txtChaveRegistro=".$VAR_USUARIO_CODIGO."','','DIV_CONTEUDO',null)\">Ativar</button>";
}  


if (($VAR_IMAGEM_LINK == null)||($VAR_IMAGEM_LINK == ""))
  $Usuario_Imagem = $this->SISTEMA_['CONFIG']['WEB']['LAYOUT_PADRAO']."dist/img/user2-160x160.jpg";
else
  $Usuario_Imagem =$VAR_IMAGEM_LINK;


$this->SISTEMA_['SAIDA']['EXIBIR'] = 
" 
      <div class=\"col-md-3\">
        <div class=\"box box-$SistemaLayoutCor\">
          <div class=\"box-body box-profile\">
            <img class=\"profile-user-img img-responsive img-circle\" src=\"".$Usuario_Imagem."\"  alt=\"Imagem do Perfil do Usuário\">
            <h4 class=\"profile-username text-center\">".$VAR_USUARIO_NOME."</h4>
            <h6 class=\"text-muted text-center\">".$VAR_USUARIO_EMAIL."</h6>
            <h6 class=\"text-muted text-center\">Usuário: ".$tmpStatusREG_ATIVO."</h6>
            <h6 class=\"text-muted text-center\">".$tmpBtnAtivar."</h6>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      
      <div class=\"col-md-5\">
        <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_PERFIL\">
          <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Dados do Usuário</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <div class=\"box-body\">
            <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_CONSULTAR\" name=\"FORM_USUARIO_CONSULTAR\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_CONTEUDO','FORM_USUARIO_CONSULTAR')\">
              <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
              <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
              <input type=\"hidden\" name=\"TXT_USUARIO_CODIGO\" value=\"".$VAR_USUARIO_CODIGO."\">
              <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_NOME\" placeholder=\"Nome Completo\" name=\"TXT_USUARIO_NOME\" value=\"".$VAR_USUARIO_NOME."\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_NOME_EXIBIR\" placeholder=\"Nome Curto\" name=\"TXT_USUARIO_NOME_EXIBIR\" value=\"".$VAR_USUARIO_NOME_EXIBIR."\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <input type=\"email\" class=\"form-control\" id=\"TXT_USUARIO_EMAIL\" placeholder=\"Email\" name=\"TXT_USUARIO_EMAIL\" value=\"".$VAR_USUARIO_EMAIL."\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_FUNCAO\" placeholder=\"Função\" name=\"TXT_USUARIO_FUNCAO\" value=\"".$VAR_USUARIO_FUNCAO."\">
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_USUARIO_TITULO\" placeholder=\"Título\" name=\"TXT_USUARIO_TITULO\" value=\"".$VAR_USUARIO_TITULO."\">
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                  <textarea class=\"form-control\" rows=\"5\" placeholder=\"Descrição\" id=\"TXT_USUARIO_DESCRICAO\" name=\"TXT_USUARIO_DESCRICAO\" >".$VAR_USUARIO_DESCRICAO."</textarea>
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-offset-5 col-sm-7\">
                  <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                </div>
              </div>
            </form>        
          </div>
        </div>
      </div>
      <div class=\"col-md-4\">
        <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_REDEFINIR_SENHA\">
          <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Redefinir senha do Usuário</h3>
          </div>
          <div class=\"box-body\">
            <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_USUARIO_REDEFINIR_SENHA\" name=\"FORM_USUARIO_REDEFINIR_SENHA\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_CONTEUDO','FORM_USUARIO_REDEFINIR_SENHA')\">
              <input type=\"hidden\" name=\"SysEntidade\" value=\"USUARIO\">
              <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"REDEFINIR_SENHA\">
              <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
              <div class=\"form-group\">
                <div class=\"col-sm-12\">
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-6\">
                  <input type=\"email\" class=\"form-control\" id=\"TXT_USUARIO_EMAIL\" placeholder=\"Email\" name=\"TXT_USUARIO_EMAIL\" disabled value=\"".$VAR_USUARIO_EMAIL."\">
                </div>
                <div class=\"col-sm-6\">
                  <input type=\"password\" class=\"form-control\" id=\"TXT_USUARIO_SENHA\" placeholder=\"Redefinir Senha\" name=\"TXT_USUARIO_SENHA\" required>
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-offset-5 col-sm-7\">
                  <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                </div>
              </div>
            </form>        
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