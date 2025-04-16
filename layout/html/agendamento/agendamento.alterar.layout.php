<?php
/**
 * 📄 agendamento.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: Layout
 */

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeAgendamentoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
    $tmpRequired                                  = $tmpCampo . "_required";
    ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor) {
    $tmpVar  = "VAR_AGENDAMENTO_" . $tmpValor['NOME'];
    $$tmpVar = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_AGENDAMENTO_DATACRIACAO = FORMATA_CAMPO($VAR_AGENDAMENTO_DATACRIACAO, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'], 'data');

/* Verifica se o registro foi desativado */
($VAR_AGENDAMENTO_REG_ATIVO == '1') ? $VAR_AGENDAMENTO_REG_ATIVO = true : $VAR_AGENDAMENTO_REG_ATIVO = false;

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'EXCLUIR')) {
    $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";
}

/* Permissão para o botão desativar */
$btn_desativar = "";
if ($VAR_AGENDAMENTO_REG_ATIVO) {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'DESATIVAR')) {
        $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";
    }
}

/* Permissão para o botão ativar */
$btn_ativar = "";
if (! $VAR_AGENDAMENTO_REG_ATIVO) {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'ATIVAR')) {
        $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";
    }
}

/* Permissão para o botão novo */
$btn_novo = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'INCLUIR')) {
    $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
}

/* Permissão para o botão pesquisar */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

/* Permissão para o botão consultar */
$btn_consultar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'CONSULTAR')) {
    $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>";
}

unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_AGENDAMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Agendamento_Alterar_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_consultar
        $btn_excluir
        $btn_desativar
        $btn_ativar
        $btn_novo
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_AGENDAMENTO_CONSULTAR\" name=\"FORM_AGENDAMENTO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"AGENDAMENTO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_AGENDAMENTO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_DATA</label>
          <div class=\"col-sm-4\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_AGENDAMENTO_DATA\" name=\"TXT_AGENDAMENTO_DATA\" value=\"$VAR_AGENDAMENTO_DATA\" $TXT_AGENDAMENTO_DATA_required >
          </div>

          <label for=\"TXT_AGENDAMENTO_HORA\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_HORA</label>
          <div class=\"col-sm-3\">
            <input type=\"time\" class=\"form-control\" id=\"TXT_AGENDAMENTO_HORA\" name=\"TXT_AGENDAMENTO_HORA\" value=\"$VAR_AGENDAMENTO_HORA\" $TXT_AGENDAMENTO_HORA_required >
          </div>
        </div>
        <div class=\"form-group\">
                  <label for=\"TXT_AGENDAMENTO_ENDERECO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_ENDERECO</label>
                  <div class=\"col-sm-9\">
                    <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_ENDERECO\" placeholder=\"$SysRtl_Agendamento_Campos_ENDERECO\" name=\"TXT_AGENDAMENTO_ENDERECO\" value=\"$VAR_AGENDAMENTO_ENDERECO\" $TXT_AGENDAMENTO_ENDERECO_required >
                  </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" id=\"TXT_AGENDAMENTO_DESCRICAO\"
              name=\"TXT_AGENDAMENTO_DESCRICAO\"
              placeholder=\"$SysRtl_Agendamento_Campos_DESCRICAO\"
              rows=\"4\"
              $TXT_AGENDAMENTO_DESCRICAO_required>$VAR_AGENDAMENTO_DESCRICAO</textarea>
  </div>
</div>


<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_CONTATO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_CONTATO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_CONTATO\" placeholder=\"$SysRtl_Agendamento_Campos_CONTATO\" name=\"TXT_AGENDAMENTO_CONTATO\" value=\"$VAR_AGENDAMENTO_CONTATO\" $TXT_AGENDAMENTO_CONTATO_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_LOCAL\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_LOCAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_AGENDAMENTO_LOCAL\" placeholder=\"$SysRtl_Agendamento_Campos_LOCAL\" name=\"TXT_AGENDAMENTO_LOCAL\" value=\"$VAR_AGENDAMENTO_LOCAL\" $TXT_AGENDAMENTO_LOCAL_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_OBSERVACOES\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_OBSERVACOES</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" id=\"TXT_AGENDAMENTO_OBSERVACOES\"
              name=\"TXT_AGENDAMENTO_OBSERVACOES\"
              placeholder=\"$SysRtl_Agendamento_Campos_OBSERVACOES\"
              rows=\"4\"
              $TXT_AGENDAMENTO_OBSERVACOES_required>$VAR_AGENDAMENTO_OBSERVACOES</textarea>
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_AGENDAMENTO_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Agendamento_Campos_USUARIO_NOME:</i><b> $VAR_AGENDAMENTO_USUARIO_NOME</b> - <i>$SysRtl_Agendamento_Campos_DATACRIACAO:</i><b> $VAR_AGENDAMENTO_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Agendamento_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Agendamento_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Agendamento_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Agendamento_Alterar_Cabecalho_Icone\"></i> $SysRtl_Agendamento_Alterar_Cabecalho_Titulo</a>';
</script>";
