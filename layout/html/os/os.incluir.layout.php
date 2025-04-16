<?php
/**
 * 📄 os.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeOsCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_OS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Os_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_OS_INCLUIR\" name=\"FORM_OS_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"OS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_OS_AGENDAMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_AGENDAMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_AGENDAMENTO\" placeholder=\"$SysRtl_Os_Campos_AGENDAMENTO\" name=\"TXT_OS_AGENDAMENTO\" value=\"\" $TXT_OS_AGENDAMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_LOCAL\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_LOCAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_LOCAL\" placeholder=\"$SysRtl_Os_Campos_LOCAL\" name=\"TXT_OS_LOCAL\" value=\"\" $TXT_OS_LOCAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_PROJETO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_PROJETO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_PROJETO\" placeholder=\"$SysRtl_Os_Campos_PROJETO\" name=\"TXT_OS_PROJETO\" value=\"\" $TXT_OS_PROJETO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_SOLICITANTE\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_SOLICITANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_SOLICITANTE\" placeholder=\"$SysRtl_Os_Campos_SOLICITANTE\" name=\"TXT_OS_SOLICITANTE\" value=\"\" $TXT_OS_SOLICITANTE_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_DESCRICAO\" placeholder=\"$SysRtl_Os_Campos_DESCRICAO\" name=\"TXT_OS_DESCRICAO\" value=\"\" $TXT_OS_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_VALORTOTAL\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_VALORTOTAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_VALORTOTAL\" placeholder=\"$SysRtl_Os_Campos_VALORTOTAL\" name=\"TXT_OS_VALORTOTAL\" value=\"\" $TXT_OS_VALORTOTAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_SITUACAO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_SITUACAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_SITUACAO\" placeholder=\"$SysRtl_Os_Campos_SITUACAO\" name=\"TXT_OS_SITUACAO\" value=\"\" $TXT_OS_SITUACAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_STATUS\" placeholder=\"$SysRtl_Os_Campos_STATUS\" name=\"TXT_OS_STATUS\" value=\"\" $TXT_OS_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_FATURA\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_FATURA</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_FATURA\" placeholder=\"$SysRtl_Os_Campos_FATURA\" name=\"TXT_OS_FATURA\" value=\"\" $TXT_OS_FATURA_required >
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
  LBL_TITULO.innerText='$SysRtl_Os_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Os_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Os_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Os_Incluir_Cabecalho_Icone\"></i> $SysRtl_Os_Incluir_Cabecalho_Titulo</a>';
</script>";
