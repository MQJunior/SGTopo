<?php
/**
 * 📄 projeto.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeProjetoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PROJETO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Projeto_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PROJETO_INCLUIR\" name=\"FORM_PROJETO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PROJETO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_PROJETO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_NOME\" placeholder=\"$SysRtl_Projeto_Campos_NOME\" name=\"TXT_PROJETO_NOME\" value=\"\" $TXT_PROJETO_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_DESCRICAO\" placeholder=\"$SysRtl_Projeto_Campos_DESCRICAO\" name=\"TXT_PROJETO_DESCRICAO\" value=\"\" $TXT_PROJETO_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_INICIO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_INICIO</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PROJETO_DATA_INICIO\" placeholder=\"$SysRtl_Projeto_Campos_DATA_INICIO\" name=\"TXT_PROJETO_DATA_INICIO\" value=\"\" $TXT_PROJETO_DATA_INICIO_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_FIM\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_FIM</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PROJETO_DATA_FIM\" placeholder=\"$SysRtl_Projeto_Campos_DATA_FIM\" name=\"TXT_PROJETO_DATA_FIM\" value=\"\" $TXT_PROJETO_DATA_FIM_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_STATUS\" placeholder=\"$SysRtl_Projeto_Campos_STATUS\" name=\"TXT_PROJETO_STATUS\" value=\"\" $TXT_PROJETO_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_PAGAMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_PAGAMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_PAGAMENTO\" placeholder=\"$SysRtl_Projeto_Campos_PAGAMENTO\" name=\"TXT_PROJETO_PAGAMENTO\" value=\"\" $TXT_PROJETO_PAGAMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_CAMINHO\" placeholder=\"$SysRtl_Projeto_Campos_CAMINHO\" name=\"TXT_PROJETO_CAMINHO\" value=\"\" $TXT_PROJETO_CAMINHO_required >
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
  LBL_TITULO.innerText='$SysRtl_Projeto_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Projeto_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Projeto_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Projeto_Incluir_Cabecalho_Icone\"></i> $SysRtl_Projeto_Incluir_Cabecalho_Titulo</a>';
</script>";
