<?php

$Conteudo_Titulo = "Sistema";
$Conteudo_Subtitulo = "Permissões";
$Conteudo_Icone = "fa-lock";
$Conteudo_ArvoreLocal = "<a href=\"javascript::;\"><i class=\"fa $Conteudo_Icone\"></i> $Conteudo_Titulo</a>";


$PermissoesMontarLayout = "";
(!isset($this->SISTEMA_['SAIDA']['EXIBIR']))?$this->SISTEMA_['SAIDA']['EXIBIR']="":null;
if (isset($_REQUEST['txtChaveRegistro'])){
  $VAR_USUARIO_CODIGO = $_REQUEST['txtChaveRegistro'];
  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."permissao/permissao.montar.layout.php");
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= $PermissoesMontarLayout;
}else{

  if (isset($VAR_USUARIO_CODIGO))
    require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."permissao/permissao.montar.layout.php");
  
 
  $this->SISTEMA_['SAIDA']['EXIBIR'] = 
" 
      <div class=\"col-md-8 col-sm-offset-2\">
        <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_USUARIO_PERFIL\">
          <div class=\"box-header with-border\">
            <h3 class=\"box-title\">Permissões por Usuário</h3>
          </div>
        <div class=\"box-header\">
          <div class=\"col-sm-12\">
            <form id=\"FORM_PERMISSAO_USUARIO_SELECT\">
              <label>Usuário</label>
              <select name=\"txtChaveRegistro\" class=\"form-control select2 select2-hidden-accessible\" style=\"width: 100%;\" tabindex=\"-1\" aria-hidden=\"true\" onChange=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."&SysEntidade=PERMISSAO&SysEntidadeAcao=PESQUISAR','','DIV_FORM_PERMISSAO_INCLUIR','FORM_PERMISSAO_USUARIO_SELECT')\">
                <option selected=\"selected\" disabled required>Selecionar</option>";
      foreach($VAR_USUARIO_LISTAR as $VAR_LISTAR_DADOS){
        $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value='".$tmpCODIGO."'>".$VAR_LISTAR_DADOS['EMAIL']."</option>";
        
      }
      $this->SISTEMA_['SAIDA']['EXIBIR'] .= "
              </select>
          </form>
        </div>
      </div>
      <div id=\"DIV_FORM_PERMISSAO_INCLUIR\" >
      ".$PermissoesMontarLayout."
      </div>
      
   
";
}

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<script language=\"text/javascript\">
  LBL_TITULO.innerText='$Conteudo_Titulo';
  LBL_SUBTITULO.innerText='$Conteudo_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$Conteudo_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='$Conteudo_ArvoreLocal';
</script>";
?>