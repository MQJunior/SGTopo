<?php
/**
 * 📄 agendamento.incluir.layout.php - Layout para o formulário de inclusão
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: Layout
 */

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeAgendamentoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_AGENDAMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Agendamento_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_AGENDAMENTO_INCLUIR\" name=\"FORM_AGENDAMENTO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"AGENDAMENTO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
  <label for=\"TXT_AGENDAMENTO_DATA\" class=\"col-sm-2 control-label\">
    $SysRtl_Agendamento_Campos_DATA
  </label>
  <div class=\"col-sm-4\">
    <input type=\"date\" class=\"form-control\" id=\"TXT_AGENDAMENTO_DATA\"
           name=\"TXT_AGENDAMENTO_DATA\" value=\"\" $TXT_AGENDAMENTO_DATA_required >
  </div>

  <label for=\"TXT_AGENDAMENTO_HORA\" class=\"col-sm-2 control-label\">
    $SysRtl_Agendamento_Campos_HORA
  </label>
  <div class=\"col-sm-3\">
    <input type=\"time\" class=\"form-control\" id=\"TXT_AGENDAMENTO_HORA\"
           name=\"TXT_AGENDAMENTO_HORA\" value=\"\" $TXT_AGENDAMENTO_HORA_required >
  </div>
</div>


<div class=\"form-group\">
  <label for=\"TXT_AGENDAMENTO_ENDERECO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_ENDERECO</label>
  <div class=\"col-sm-9\">
    <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_ENDERECO\" placeholder=\"$SysRtl_Agendamento_Campos_ENDERECO\" name=\"TXT_AGENDAMENTO_ENDERECO\" value=\"\" $TXT_AGENDAMENTO_ENDERECO_required >
  </div>
</div>

<div class=\"form-group\">
  <label for=\"TXT_AGENDAMENTO_DESCRICAO\" class=\"col-sm-2 control-label\">
    $SysRtl_Agendamento_Campos_DESCRICAO
  </label>
  <div class=\"col-sm-9\">
    <textarea class=\"form-control\" id=\"TXT_AGENDAMENTO_DESCRICAO\"
              name=\"TXT_AGENDAMENTO_DESCRICAO\"
              placeholder=\"$SysRtl_Agendamento_Campos_DESCRICAO\"
              rows=\"4\"
              $TXT_AGENDAMENTO_DESCRICAO_required></textarea>
  </div>
</div>


<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_CONTATO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_CONTATO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_CONTATO\" placeholder=\"$SysRtl_Agendamento_Campos_CONTATO\" name=\"TXT_AGENDAMENTO_CONTATO\" value=\"\" $TXT_AGENDAMENTO_CONTATO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_LOCAL\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_LOCAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_LOCAL\" placeholder=\"$SysRtl_Agendamento_Campos_LOCAL\" name=\"TXT_AGENDAMENTO_LOCAL\" value=\"\" $TXT_AGENDAMENTO_LOCAL_required >
          </div>
        </div>
<div class=\"form-group\">
  <label for=\"TXT_AGENDAMENTO_OBSERVACOES\" class=\"col-sm-2 control-label\">
    $SysRtl_Agendamento_Campos_OBSERVACOES
  </label>
  <div class=\"col-sm-9\">
    <textarea class=\"form-control\" id=\"TXT_AGENDAMENTO_OBSERVACOES\"
              name=\"TXT_AGENDAMENTO_OBSERVACOES\"
              placeholder=\"$SysRtl_Agendamento_Campos_OBSERVACOES\"
              rows=\"4\"
              $TXT_AGENDAMENTO_OBSERVACOES_required></textarea>
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
  LBL_TITULO.innerText='$SysRtl_Agendamento_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Agendamento_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Agendamento_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Agendamento_Incluir_Cabecalho_Icone\"></i> $SysRtl_Agendamento_Incluir_Cabecalho_Titulo</a>';
</script>";
