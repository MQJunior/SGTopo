<?php
/**
 * 📄 padrao.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados Obrigatórios
$EntidadeCampos = $EntidadePadraoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
  $tmpRequired = $tmpCampo . "_required";
  $$tmpRequired = $tmpInfoCampos['REQUERIDO'] ? "required" : "";
}

// 🔒 Permissões
$PERMISSAO_ = new permissao($this->SISTEMA_);
$btn_pesquisar = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'PESQUISAR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-search\"></i></a>" : "";
unset($PERMISSAO_);

// 📦 Exibição do Layout
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PADRAO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" id=\"FORM_PADRAO_INCLUIR\" name=\"FORM_PADRAO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        /*MONTAR_LAYOUT*/
        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <button type=\"submit\" style=\"display:none\" id=\"BTN_FORM_SUBMIT\"></button>
            <a class=\"btn btn-$SistemaLayoutCor\" onclick=\"BTN_FORM_SUBMIT.click()\"><i class=\"fa fa-floppy-o\"></i></a>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

// 📜 JavaScript
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script>
  LBL_TITULO.innerText = '$SysRtl_Padrao_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText = '$SysRtl_Padrao_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText = '$SysRtl_Padrao_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML = '<a><i class=\"fa $SysRtl_Padrao_Incluir_Cabecalho_Icone\"></i> $SysRtl_Padrao_Incluir_Cabecalho_Titulo</a>';
</script>";
?>
