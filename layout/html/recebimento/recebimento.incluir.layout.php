<?php
/**
 * 📄 recebimento.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeRecebimentoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_RECEBIMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Recebimento_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_RECEBIMENTO_INCLUIR\" name=\"FORM_RECEBIMENTO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"RECEBIMENTO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_PROJETO_SERVICO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" placeholder=\"$SysRtl_Recebimento_Campos_PROJETO_SERVICO\" name=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" value=\"\" $TXT_RECEBIMENTO_PROJETO_SERVICO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_TIPO\" placeholder=\"$SysRtl_Recebimento_Campos_TIPO\" name=\"TXT_RECEBIMENTO_TIPO\" value=\"\" $TXT_RECEBIMENTO_TIPO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_DATA_RECEBIMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" placeholder=\"$SysRtl_Recebimento_Campos_DATA_RECEBIMENTO\" name=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" value=\"\" $TXT_RECEBIMENTO_DATA_RECEBIMENTO_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_VALOR\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_VALOR</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_VALOR\" placeholder=\"$SysRtl_Recebimento_Campos_VALOR\" name=\"TXT_RECEBIMENTO_VALOR\" value=\"\" $TXT_RECEBIMENTO_VALOR_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_COMPROVANTE\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_COMPROVANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_COMPROVANTE\" placeholder=\"$SysRtl_Recebimento_Campos_COMPROVANTE\" name=\"TXT_RECEBIMENTO_COMPROVANTE\" value=\"\" $TXT_RECEBIMENTO_COMPROVANTE_required >
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
  LBL_TITULO.innerText='$SysRtl_Recebimento_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Recebimento_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Recebimento_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Recebimento_Incluir_Cabecalho_Icone\"></i> $SysRtl_Recebimento_Incluir_Cabecalho_Titulo</a>';
</script>";
