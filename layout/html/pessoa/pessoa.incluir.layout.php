<?php
/**
 * 📄 pessoa.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadePessoaCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PESSOA', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PESSOA&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PESSOA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Pessoa_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PESSOA_INCLUIR\" name=\"FORM_PESSOA_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PESSOA\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_PESSOA_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Pessoa_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PESSOA_NOME\" placeholder=\"$SysRtl_Pessoa_Campos_NOME\" name=\"TXT_PESSOA_NOME\" value=\"\" $TXT_PESSOA_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PESSOA_CPF_CNPJ\" class=\"col-sm-2 control-label\">$SysRtl_Pessoa_Campos_CPF_CNPJ</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PESSOA_CPF_CNPJ\" placeholder=\"$SysRtl_Pessoa_Campos_CPF_CNPJ\" name=\"TXT_PESSOA_CPF_CNPJ\" value=\"\" $TXT_PESSOA_CPF_CNPJ_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PESSOA_TELEFONE\" class=\"col-sm-2 control-label\">$SysRtl_Pessoa_Campos_TELEFONE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PESSOA_TELEFONE\" placeholder=\"$SysRtl_Pessoa_Campos_TELEFONE\" name=\"TXT_PESSOA_TELEFONE\" value=\"\" $TXT_PESSOA_TELEFONE_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PESSOA_EMAIL\" class=\"col-sm-2 control-label\">$SysRtl_Pessoa_Campos_EMAIL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PESSOA_EMAIL\" placeholder=\"$SysRtl_Pessoa_Campos_EMAIL\" name=\"TXT_PESSOA_EMAIL\" value=\"\" $TXT_PESSOA_EMAIL_required >
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
  LBL_TITULO.innerText='$SysRtl_Pessoa_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Pessoa_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Pessoa_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Pessoa_Incluir_Cabecalho_Icone\"></i> $SysRtl_Pessoa_Incluir_Cabecalho_Titulo</a>';
</script>";
