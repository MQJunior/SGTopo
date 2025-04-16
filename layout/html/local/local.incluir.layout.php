<?php
/**
 * 📄 local.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: local | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeLocalCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOCAL', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOCAL&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_LOCAL\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Local_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_LOCAL_INCLUIR\" name=\"FORM_LOCAL_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"LOCAL\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_LOCAL_PROJETO\" class=\"col-sm-2 control-label\">$SysRtl_Local_Campos_PROJETO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_LOCAL_PROJETO\" placeholder=\"$SysRtl_Local_Campos_PROJETO\" name=\"TXT_LOCAL_PROJETO\" value=\"\" $TXT_LOCAL_PROJETO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_LOCAL_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Local_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_LOCAL_DESCRICAO\" placeholder=\"$SysRtl_Local_Campos_DESCRICAO\" name=\"TXT_LOCAL_DESCRICAO\" value=\"\" $TXT_LOCAL_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_LOCAL_COORDENADAS\" class=\"col-sm-2 control-label\">$SysRtl_Local_Campos_COORDENADAS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_LOCAL_COORDENADAS\" placeholder=\"$SysRtl_Local_Campos_COORDENADAS\" name=\"TXT_LOCAL_COORDENADAS\" value=\"\" $TXT_LOCAL_COORDENADAS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_LOCAL_BAIRRO\" class=\"col-sm-2 control-label\">$SysRtl_Local_Campos_BAIRRO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_LOCAL_BAIRRO\" placeholder=\"$SysRtl_Local_Campos_BAIRRO\" name=\"TXT_LOCAL_BAIRRO\" value=\"\" $TXT_LOCAL_BAIRRO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_LOCAL_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Local_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_LOCAL_CAMINHO\" placeholder=\"$SysRtl_Local_Campos_CAMINHO\" name=\"TXT_LOCAL_CAMINHO\" value=\"\" $TXT_LOCAL_CAMINHO_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\"><button type=\"submit\" style=\"display:none\" id=\"BTN_FORM_SUBMIT\"  name=\"BTN_FORM_SUBMIT\"></button>
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"BTN_FORM_SUBMIT.click()\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Local_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Local_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Local_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Local_Incluir_Cabecalho_Icone\"></i> $SysRtl_Local_Incluir_Cabecalho_Titulo</a>';
</script>";
