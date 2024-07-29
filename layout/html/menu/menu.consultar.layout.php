<?php
require_once($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."mapa.icones.def.php");

$EntidadeAcaoSomenteLeitura = "";
$TipoSomenteLeitura = "";
$TipoChecked = "";
$AtivoChecked="";
$AtivoOrdemSubir=" disabled";
$AtivoOrdemDescer=" disabled";
if ($VAR_MENU_TIPO=="1"){
  $TipoSomenteLeitura="readonly=\"readonly\" disabled";
  $TipoChecked = "";
}else{
  $TipoChecked = "Checked";
}
if ($VAR_MENU_possuiItens)
  $EntidadeAcaoSomenteLeitura="readonly=\"readonly\" disabled";

if($VAR_MENU_ATIVO)
  $AtivoChecked="Checked";

($VAR_MENU_ORDEM_primeiro)?true:$AtivoOrdemSubir="";
($VAR_MENU_ORDEM_ultimo)?true:$AtivoOrdemDescer="";

$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"       <div class=\"box-header with-border\">
          <h3 class=\"box-title\">Informações do Item</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_MENU_CONSULTAR\" name=\"FORM_MENU_CONSULTAR\" accept-charset=\"ISO-8859-1\" onsubmit=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."','','DIV_MENU_EXIBIR','FORM_MENU_CONSULTAR')\">
            <input type=\"hidden\" name=\"SysEntidade\" value=\"MENU\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
            <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_MENU_CODIGO."\">
              <div class=\"form-group\">
                <label for=\"TXT_MENU_NOME\" class=\"col-sm-3 control-label\">Nome</label>
                <div class=\"col-sm-8\">
                  <input type=\"text\" class=\"form-control\" id=\"TXT_MENU_NOME\" placeholder=\"Nome\" name=\"TXT_MENU_NOME\" value=\"".@$VAR_MENU_NOME."\" required>
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_TIPO\" class=\"col-sm-3 control-label\">Delimitador</label>
                <div class=\"col-sm-8\">
                      <input type=\"checkbox\" id=\"TXT_MENU_TIPO\" name=\"TXT_MENU_TIPO\" ".$TipoSomenteLeitura." ".$TipoChecked.">
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_PAI\" class=\"col-sm-3 control-label\">Dentro de</label>
                <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"TXT_MENU_PAI\" placeholder=\"Escolha \" name=\"TXT_MENU_PAI\" required>
                      <option value='0'>/</option>
                    ";
                      
                          foreach ($VAR_MENU_PAI_LISTA as $tmp_Select){
                            $tmpSelected = "";
                            if (isset($VAR_MENU_PAI)){
                              if (($tmp_Select['MENU_PAI'] !=$VAR_MENU_CODIGO) && ($tmp_Select['CODIGO']!=$VAR_MENU_CODIGO)){
                                if ($tmp_Select['CODIGO'] ==$VAR_MENU_PAI)
                                  $tmpSelected = "selected";
                                $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"".$tmp_Select['CODIGO']."\" ".$tmpSelected.">".str_repeat("--",$tmp_Select['NIVEL']*2).">".$tmp_Select['NOME']."</option>";
                              }  
                            }
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
                      $tmpQtdeSelecionado=0;
                      foreach($MAPA_ICONES as $arrayIcones){
                        $tmpSelected = "";
                        $tmpIcone = $arrayIcones['CODE'];
                        $tmpNome = $arrayIcones['NOME'];
                        if (@$VAR_MENU_ICONE == $tmpNome){
                          $tmpSelected = "selected";
                          $tmpQtdeSelecionado++;
                        }
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                      <option value=\"".$tmpNome."\" ".$tmpSelected.">".$tmpIcone."; ".$tmpNome."</option>";
                      }
                      if (($VAR_MENU_ICONE != "")&&($tmpQtdeSelecionado==0))
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                      <option value=\"".$VAR_MENU_ICONE."\" selected>".$VAR_MENU_ICONE."</option>";
                        
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                  </div>
                  <div class=\"col-sm-8\">
                    <input type=\"text\" class=\"form-control\" id=\"TXT_MENU_ICONE_NOME\" placeholder=\"Nome\" name=\"TXT_MENU_ICONE_NOME\" value=\"".$VAR_MENU_ICONE."\" disabled>
                  </div> 
                </div>
              </div>
              
              <div class=\"form-group\">
                <label for=\"TXT_MENU_ENTIDADE_ACAO\" class=\"col-sm-3 control-label\">Entidade / Ação</label>
                <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"TXT_MENU_ENTIDADE_ACAO\" placeholder=\"Padrao \" name=\"TXT_MENU_ENTIDADE_ACAO\" ".$EntidadeAcaoSomenteLeitura.">
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
                            if ($VAR_MENU_ENTIDADE_ACAO == $tmpCodigo)
                              $tmpSelected = "selected";
                            $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                      <option value=\"".$tmpCodigo."\" ".$tmpSelected.">".$tmpEntidade." / ".$tmpNome."</option>";
                          }
                            
                        $this->SISTEMA_['SAIDA']['EXIBIR'] .="</optgroup>";
                        
                      }
$this->SISTEMA_['SAIDA']['EXIBIR'] .=                    "</select>
                </div>
              </div>
              <div class=\"form-group\">
                <label for=\"TXT_MENU_ORDEM\" class=\"col-sm-3 control-label\">Ordem</label>
                <div class=\"col-sm-8\">
                    <button type=\"button\" class=\"btn btn-default\" ".$AtivoOrdemDescer." onClick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=MENU&SysEntidadeAcao=ORDEM_MUDAR&txtOrdemAcao=DESCER&txtChaveRegistro=".$VAR_MENU_CODIGO."','','DIV_MENU_EXIBIR',null)\"><i class=\"fa fa-chevron-down\" ></i></button>
                    <input type=\"text\" class=\"btn btn-default\" id=\"TXT_MENU_ORDEM\" placeholder=\"Name\" name=\"TXT_MENU_ORDEM\" value=\"".$VAR_MENU_ORDEM."\" required readonly>
                    <button type=\"button\" class=\"btn btn-default\" ".$AtivoOrdemSubir." onClick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID."&SysEntidade=MENU&SysEntidadeAcao=ORDEM_MUDAR&txtOrdemAcao=SUBIR&txtChaveRegistro=".$VAR_MENU_CODIGO."','','DIV_MENU_EXIBIR',null)\"><i class=\"fa fa-chevron-up\" ></i></button>
                </div>
              </div>
               <div class=\"form-group\">
                <label for=\"TXT_MENU_ATIVO\" class=\"col-sm-3 control-label\">Item Ativo</label>
                <div class=\"col-sm-8\">
                      <input type=\"checkbox\" id=\"TXT_MENU_ATIVO\" name=\"TXT_MENU_ATIVO\" ".$AtivoChecked.">
                </div>
              </div>
              <div class=\"form-group\">
                <div class=\"col-sm-offset-3 col-sm-9\">
                <button type=\"submit\" class=\"btn btn-$SistemaLayoutCor\" >Salvar</button>
                </div>
              </div>
          </form>        
        </div>";
?>