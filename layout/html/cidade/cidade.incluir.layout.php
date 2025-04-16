<?php
/**
 * 📄 cidade.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: cidade | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeCidadeCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'CIDADE', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=CIDADE&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_CIDADE\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Cidade_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_CIDADE_INCLUIR\" name=\"FORM_CIDADE_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"CIDADE\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_CIDADE_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Cidade_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_CIDADE_NOME\" placeholder=\"$SysRtl_Cidade_Campos_NOME\" name=\"TXT_CIDADE_NOME\" value=\"\" $TXT_CIDADE_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_CIDADE_ESTADO\" class=\"col-sm-2 control-label\">$SysRtl_Cidade_Campos_ESTADO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_CIDADE_ESTADO\" placeholder=\"$SysRtl_Cidade_Campos_ESTADO\" name=\"TXT_CIDADE_ESTADO\" value=\"\" $TXT_CIDADE_ESTADO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_CIDADE_COORDENADAS\" class=\"col-sm-2 control-label\">$SysRtl_Cidade_Campos_COORDENADAS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_CIDADE_COORDENADAS\" placeholder=\"$SysRtl_Cidade_Campos_COORDENADAS\" name=\"TXT_CIDADE_COORDENADAS\" value=\"\" $TXT_CIDADE_COORDENADAS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_CIDADE_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Cidade_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_CIDADE_CAMINHO\" placeholder=\"$SysRtl_Cidade_Campos_CAMINHO\" name=\"TXT_CIDADE_CAMINHO\" value=\"\" $TXT_CIDADE_CAMINHO_required >
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
  LBL_TITULO.innerText='$SysRtl_Cidade_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Cidade_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Cidade_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Cidade_Incluir_Cabecalho_Icone\"></i> $SysRtl_Cidade_Incluir_Cabecalho_Titulo</a>';
</script>";
