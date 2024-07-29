<?php
$Conteudo_Titulo = "Menu";
$Conteudo_Subtitulo = "Editar";
$Conteudo_Icone = "fa-list";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";


require_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."mapa.icones.def.php");
 

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"
    <div class=\"col-md-5\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Menu do Sistema</h3>
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor pull-right\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=MENU&SysEntidadeAcao=EDITAR','','DIV_CONTEUDO',null)\" >Novo Item</button>
        </div>
        <div class=\"box-body\" id=\"DIV_MENU_EXIBIR\">
          <ul class=\"treeview\">
            ".$VAR_SISTEMA_MENU."
          </ul>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    
    <div class=\"col-md-7\">
      <!-- /.nav-tabs-custom -->
      <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_MENU_ALTERAR\">
        <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Informações do Item</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_MENU_INCLUIR\" name=\"FORM_USUARIO_PERFIL\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_MENU_EXIBIR','FORM_MENU_INCLUIR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"MENU\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
              <div class=\"form-group\">
                <label for=\"TXT_MENU_NOME\" class=\"col-sm-3 control-label\">Nome</label>
                <div class=\"col-sm-8\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_MENU_NOME\" placeholder=\"Name\" name=\"TXT_MENU_NOME\" value=\"\" required>
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_TIPO\" class=\"col-sm-3 control-label\">Delimitador</label>
                <div class=\"col-sm-8\">
                      <input type=\"checkbox\" id=\"TXT_MENU_TIPO\" name=\"TXT_MENU_TIPO\" >
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_PAI\" class=\"col-sm-3 control-label\">Dentro de</label>
                <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"TXT_MENU_PAI\" placeholder=\"Escolha \" name=\"TXT_MENU_PAI\" required>
                      <option value='0'>/</option>
                    ";
                      
                          foreach ($VAR_MENU_PAI_LISTA as $tmp_Select){
                                $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"".$tmp_Select['CODIGO']."\" >".str_repeat("--",$tmp_Select['NIVEL']*2).">".$tmp_Select['NOME']."</option>";
                          }  
                        
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_MENU_ICONE\" class=\"col-sm-3 control-label\">Icone</label>
                <div class=\"col-sm-8\">
                  <div class=\"col-sm-4\">
                    <select class=\"form-control\" id=\"TXT_MENU_ICONE\" placeholder=\"Padrao \" name=\"TXT_MENU_ICONE\" style=\"font-family: 'FontAwesome'\" onChange=\"if(this.value==-1){TXT_MENU_ICONE_NOME.disabled=false;}else{TXT_MENU_ICONE_NOME.value=this.value;TXT_MENU_ICONE_NOME.disabled=true;}\">TXT_MENU_ICONE_NOME.enabled=false;
                    <option value=''>Não Possui</option>
                    <option value='-1'>Digite o nome:</option>
                    ";
                      foreach($MAPA_ICONES as $arrayIcones){
                        $tmpSelected = "";
                        $tmpIcone = $arrayIcones['CODE'];
                        $tmpNome = $arrayIcones['NOME'];
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                      <option value=\"".$tmpNome."\" ".$tmpSelected.">".$tmpIcone."; ".$tmpNome."</option>";
                      }
                      
                        
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                  </div>
                  <div class=\"col-sm-8\">
                    <input type=\"text\" class=\"form-control\" id=\"TXT_MENU_ICONE_NOME\" placeholder=\"Nome\" name=\"TXT_MENU_ICONE_NOME\" value=\"\" disabled>
                  </div> 
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_ENTIDADE_ACAO\" class=\"col-sm-3 control-label\">Entidade / Ação</label>
                <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"TXT_MENU_ENTIDADE_ACAO\" placeholder=\"Padrao \" name=\"TXT_MENU_ENTIDADE_ACAO\" >
                      <option value='0'>Não Possui</option>";
                      $I=0;
                      foreach($VAR_MENU_ENTIDADE_ACAO_LISTA as $arrayEntidadeAcao){
                        $tmpArrayGrupo[$arrayEntidadeAcao['ENTIDADE']][]=$arrayEntidadeAcao;
                      }
                      $tmp_var_Entidades = array_keys($tmpArrayGrupo);
                      foreach($tmp_var_Entidades as $tmpEntidadeNome){
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="<optgroup label=\"".$tmpEntidadeNome."\">";
                          foreach($tmpArrayGrupo[$tmpEntidadeNome] as $tmpEntidadeAcao){
                            $tmpSelected = "";
                            $tmpCodigo = $tmpEntidadeAcao['CODIGO'];
                            $tmpNome = ucwords(strtolower(str_replace("_"," ",$tmpEntidadeAcao['NOME'])));
                            $tmpEntidade = ucwords(strtolower($tmpEntidadeAcao['ENTIDADE']));
                            $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                      <option value=\"".$tmpCodigo."\" ".$tmpSelected.">".$tmpEntidade." / ".$tmpNome."</option>";
                          }
                            
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="</optgroup>";
                        
                      }
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                </div>
              </div>
              
              <div class=\"form-group\">
                <div class=\"col-sm-offset-3 col-sm-9\">
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