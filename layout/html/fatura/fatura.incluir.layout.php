<?php
/**
 * 📄 fatura.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeFaturaCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_FATURA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Fatura_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_FATURA_INCLUIR\" name=\"FORM_FATURA_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"FATURA\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_FATURA_SOLICITANTE\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_SOLICITANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_SOLICITANTE\" placeholder=\"$SysRtl_Fatura_Campos_SOLICITANTE\" name=\"TXT_FATURA_SOLICITANTE\" value=\"\" $TXT_FATURA_SOLICITANTE_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_DATA_EMISSAO\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_DATA_EMISSAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_DATA_EMISSAO\" placeholder=\"$SysRtl_Fatura_Campos_DATA_EMISSAO\" name=\"TXT_FATURA_DATA_EMISSAO\" value=\"\" $TXT_FATURA_DATA_EMISSAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_DATA_VENCIMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_DATA_VENCIMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_DATA_VENCIMENTO\" placeholder=\"$SysRtl_Fatura_Campos_DATA_VENCIMENTO\" name=\"TXT_FATURA_DATA_VENCIMENTO\" value=\"\" $TXT_FATURA_DATA_VENCIMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_VALORTOTAL\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_VALORTOTAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_VALORTOTAL\" placeholder=\"$SysRtl_Fatura_Campos_VALORTOTAL\" name=\"TXT_FATURA_VALORTOTAL\" value=\"\" $TXT_FATURA_VALORTOTAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_STATUS\" placeholder=\"$SysRtl_Fatura_Campos_STATUS\" name=\"TXT_FATURA_STATUS\" value=\"\" $TXT_FATURA_STATUS_required >
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
  LBL_TITULO.innerText='$SysRtl_Fatura_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Fatura_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Fatura_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Fatura_Incluir_Cabecalho_Icone\"></i> $SysRtl_Fatura_Incluir_Cabecalho_Titulo</a>';
</script>";
