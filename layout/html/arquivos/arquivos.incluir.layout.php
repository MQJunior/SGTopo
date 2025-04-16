<?php
/**
 * 📄 arquivos.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeArquivosCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_ARQUIVOS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Arquivos_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ARQUIVOS_INCLUIR\" name=\"FORM_ARQUIVOS_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"ARQUIVOS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_NOME\" placeholder=\"$SysRtl_Arquivos_Campos_NOME\" name=\"TXT_ARQUIVOS_NOME\" value=\"\" $TXT_ARQUIVOS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_PROJETO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_PROJETO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_PROJETO\" placeholder=\"$SysRtl_Arquivos_Campos_PROJETO\" name=\"TXT_ARQUIVOS_PROJETO\" value=\"\" $TXT_ARQUIVOS_PROJETO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_DOCUMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_DOCUMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_DOCUMENTO\" placeholder=\"$SysRtl_Arquivos_Campos_DOCUMENTO\" name=\"TXT_ARQUIVOS_DOCUMENTO\" value=\"\" $TXT_ARQUIVOS_DOCUMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_TIPO\" placeholder=\"$SysRtl_Arquivos_Campos_TIPO\" name=\"TXT_ARQUIVOS_TIPO\" value=\"\" $TXT_ARQUIVOS_TIPO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_CAMINHO\" placeholder=\"$SysRtl_Arquivos_Campos_CAMINHO\" name=\"TXT_ARQUIVOS_CAMINHO\" value=\"\" $TXT_ARQUIVOS_CAMINHO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_STATUS\" placeholder=\"$SysRtl_Arquivos_Campos_STATUS\" name=\"TXT_ARQUIVOS_STATUS\" value=\"\" $TXT_ARQUIVOS_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_DATAHORA_UPLOAD</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" placeholder=\"$SysRtl_Arquivos_Campos_DATAHORA_UPLOAD\" name=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" value=\"\" $TXT_ARQUIVOS_DATAHORA_UPLOAD_required>
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
  LBL_TITULO.innerText='$SysRtl_Arquivos_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Arquivos_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Arquivos_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Arquivos_Incluir_Cabecalho_Icone\"></i> $SysRtl_Arquivos_Incluir_Cabecalho_Titulo</a>';
</script>";
