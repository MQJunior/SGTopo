<?php
/**
 * 📄 agendamento.consultar.layout.php - Layout para o formulário de consulta
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: Layout
 */

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeAgendamentoCampos;

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor) {
    $tmpVar  = "VAR_AGENDAMENTO_" . $tmpValor['NOME'];
    $$tmpVar = $this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//
/* Formata o campo DATACRIACAO */
$VAR_AGENDAMENTO_DATACRIACAO = FORMATA_CAMPO($VAR_AGENDAMENTO_DATACRIACAO, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'], 'data');

/* Verifica se o registro foi desativado */
if ($VAR_AGENDAMENTO_REG_ATIVO == '1') {
    $VAR_AGENDAMENTO_REG_ATIVO = true;
    $VAR_REGISTRO_INATIVO      = "";
} else {
    $VAR_AGENDAMENTO_REG_ATIVO = false;
    $VAR_REGISTRO_INATIVO      = " <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            <b class=\"text-yellow\">$SysRtl_Registro_Inativo</b>
          </div>
          <div class=\"col-sm-5\">
          </div>";
}
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão exibir detalhes do log do registro */
$tmpLogAtividade = "<i class=\"fa fa-info-circle\"></i>";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'INFORMACAO')) {
    $tmpLogAtividade = "<a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOGATIVIDADE&SysEntidadeAcao=INFORMACAO&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO&TXT_LOGATIVIDADE_ENTIDADE=AGENDAMENTO&SID=$SistemaSessaoUID','','DIV_LOG_INFO',null)\">
              <i class=\"fa fa-info-circle\"></i>
            </a> ";
}
/* Permissão exibir Data de Criação do registro e o Usuário que criou*/
$tmpLogVer = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER')) {
    $tmpLogVer = "<h6 class=\"text-muted\">
            $tmpLogAtividade
            <i>$SysRtl_Agendamento_Campos_USUARIO_NOME:</i><b> $VAR_AGENDAMENTO_USUARIO_NOME</b> - <i>$SysRtl_Agendamento_Campos_DATACRIACAO:</i><b> $VAR_AGENDAMENTO_DATACRIACAO</b></h6>";
}

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

/* Permissão para o botão Cancelar */
$btn_cancelar = "";
if ($VAR_AGENDAMENTO_STATUS != "CANCELADO") {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'CANCELAR')) {
        $btn_cancelar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=CANCELAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Cancelar</b></a>";
    }
}

/* Permissão para o botão Pender */
$btn_pender = "";
if ($VAR_AGENDAMENTO_STATUS != "PENDENTE") {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'PENDER')) {
        $btn_pender = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=PENDER&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Pender</b></a>";
    }
}

/* Permissão para o botão Pender */
$btn_concluir = "";
if ($VAR_AGENDAMENTO_STATUS != "CONCLUIDO") {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'CONCLUIR')) {
        $btn_concluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=CONCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Concluir</b></a>";
    }
}

/* Permissão para o botão ativar */
$btn_ativar = "";
if (! $VAR_AGENDAMENTO_REG_ATIVO) {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'ATIVAR')) {
        $btn_ativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_AGENDAMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";
    }
}

/* Permissão para o botão editar */
$btn_editar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'AGENDAMENTO', 'ALTERAR')) {
    $btn_editar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=AGENDAMENTO&SysEntidadeAcao=ALTERAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_AGENDAMENTO_CONSULTAR')\"><i class=\"fa fa-edit\"></i> <b>$SysRtl_Btn_Editar</b></a>";
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

unset($PERMISSAO_);
// -------------------- EXIBIÇÃO DO FORMULARIO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_AGENDAMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Agendamento_Consultar_Conteudo_Titulo</h3>

      <div class=\"btn-group pull-right\">
        $btn_excluir
        $btn_desativar
        $btn_ativar
        $btn_editar
        $btn_novo
        $btn_pesquisar
      </div>

    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_AGENDAMENTO_CONSULTAR\" name=\"FORM_AGENDAMENTO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" id=\"SysEntidade\" name=\"SysEntidade\" value=\"AGENDAMENTO\">
        <input type=\"hidden\" id=\"SysEntidadeAcao\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_AGENDAMENTO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_DATA</label>
          <div class=\"col-sm-4\">
           <b class=\"form-control\">" . FormatoDataBR($VAR_AGENDAMENTO_DATA) . "</b>
          </div>

          <label for=\"TXT_AGENDAMENTO_HORA\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_HORA</label>
          <div class=\"col-sm-3\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_HORA</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_ENDERECO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_ENDERECO</label>
          <div class=\"col-sm-9\">
            <b class=\"form-control\">$VAR_AGENDAMENTO_ENDERECO</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_DESCRICAO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_CONTATO\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_CONTATO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_CONTATO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_LOCAL\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_LOCAL</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_LOCAL</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_OBSERVACOES\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_OBSERVACOES</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_OBSERVACOES</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_AGENDAMENTO_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Agendamento_Campos_STATUS</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_AGENDAMENTO_STATUS</b>
          </div>
        </div>
        <div class=\"form-group text-right\" style=\"margin-top: 20px; padding-right: 15px;\">
          $btn_cancelar
          $btn_pender
          $btn_concluir
        </div>
        $VAR_REGISTRO_INATIVO
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            $tmpLogVer
          </div>
          <di class=\"col-sm-9\" >
          </di>
        </div>
      </form>
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Agendamento_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Agendamento_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Agendamento_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Agendamento_Consultar_Cabecalho_Icone\"></i> $SysRtl_Agendamento_Consultar_Cabecalho_Titulo</a>';
</script>";
