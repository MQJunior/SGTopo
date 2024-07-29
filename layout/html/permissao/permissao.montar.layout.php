<?php
/*
$VAR_PERMISSAO_LISTA ;
$VAR_PERMISSAO_ENTIDADES ;
*/
$PermissoesMontarLayout = "<!-- conteudo das permissoes -->
      
      <div class=\"box-body\" > 
        <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PERMISSAO_INCLUIR\" name=\"FORM_PERMISSAO_INCLUIR\" accept-charset=\"ISO-8859-1\">
          <input type=\"hidden\" name=\"SysEntidade\" value=\"PERMISSAO\">
          <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
          <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"".$VAR_USUARIO_CODIGO."\">
          <div class=\"col-sm-12\">";
foreach($VAR_PERMISSAO_ENTIDADES as $tmp_mnt_Entidade){
  $PermissoesMontarLayout .= "<div class=\"form-group\">
    <h4>Entidade: <i>".$tmp_mnt_Entidade."</i></h4>";
  
  foreach($VAR_PERMISSAO_LISTA[$tmp_mnt_Entidade] as $tmp_mnt_Acoes){
    $tmpAcaoNome =ucwords(strtolower(str_replace("_"," ",$tmp_mnt_Acoes['ACAO'])));
    (in_array($tmp_mnt_Acoes['CODIGO'],$VAR_USUARIO_PERMISSOES_CODIGO))?$tmpSelecionado = "Checked":$tmpSelecionado = "";
    $PermissoesMontarLayout .= "<div class=\"col-sm-4\">
      <div class=\"checkbox\">
        <label>
          <input type=\"checkbox\" name=\"txtPermissaoCodigo[]\" value=\"".$tmp_mnt_Acoes['CODIGO']."\" ".$tmpSelecionado.">
          ".$tmpAcaoNome."
        </label>
      </div>
    </div>";
  }
  $PermissoesMontarLayout .="</div>";
}
$PermissoesMontarLayout .=          "</div>                  
        </form>
      </div>
      
      <div class=\"box-footer\">
        <div class=\"col-sm-offset-5 col-sm-7\">
          <button type=\"button\" class=\"btn btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=".$TMP_SESSAO_UID ."','','DIV_FORM_PERMISSAO_INCLUIR','FORM_PERMISSAO_INCLUIR');//PesquisaDados('.?XMLHTML=true&SysEntidade=MENU&SysEntidadeAcao=RELOAD&SID=".$TMP_SESSAO_UID ."','','DIV_MENU_ESQUERDO',null);\">Salvar</button>
        </div>
      </div>
      <!-- /. fim conteudo das permissoes -->
";
?>