<?php
/**
 * 📄 projeto.consultar.layout.php - Layout para o formulário de consulta
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: Layout
 */

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeProjetoCampos;

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor) {
    $tmpVar  = "VAR_PROJETO_" . $tmpValor['NOME'];
    $$tmpVar = $this->SISTEMA_['ENTIDADE']['PROJETO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//
/* Formata o campo DATACRIACAO */
$VAR_PROJETO_DATACRIACAO = FORMATA_CAMPO($VAR_PROJETO_DATACRIACAO, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'], 'data');

/* Formata o campo DATA_INICIO */
$VAR_PROJETO_DATA_INICIO = FORMATA_CAMPO($VAR_PROJETO_DATA_INICIO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');
/* Formata o campo DATA_FIM */
$VAR_PROJETO_DATA_FIM = FORMATA_CAMPO($VAR_PROJETO_DATA_FIM,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');


/* Verifica se o registro foi desativado */
if ($VAR_PROJETO_REG_ATIVO == '1') {
    $VAR_PROJETO_REG_ATIVO = true;
    $VAR_REGISTRO_INATIVO = "";
} else {
    $VAR_PROJETO_REG_ATIVO = false;
    $VAR_REGISTRO_INATIVO = " <div class=\"form-group\">
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
    $tmpLogAtividade = "<a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOGATIVIDADE&SysEntidadeAcao=INFORMACAO&txtChaveRegistro=$VAR_PROJETO_CODIGO&TXT_LOGATIVIDADE_ENTIDADE=PROJETO&SID=$SistemaSessaoUID','','DIV_LOG_INFO',null)\">
              <i class=\"fa fa-info-circle\"></i>
            </a> ";
}
/* Permissão exibir Data de Criação do registro e o Usuário que criou*/
$tmpLogVer = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER')) {
    $tmpLogVer = "<h6 class=\"text-muted\">
            $tmpLogAtividade
            <i>$SysRtl_Projeto_Campos_USUARIO_NOME:</i><b> $VAR_PROJETO_USUARIO_NOME</b> - <i>$SysRtl_Projeto_Campos_DATACRIACAO:</i><b> $VAR_PROJETO_DATACRIACAO</b></h6>";
}

/* Permissão para o botão excluir */
$btn_excluir = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'EXCLUIR')) {
    $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";
}

/* Permissão para o botão desativar */
$btn_desativar = "";
if ($VAR_PROJETO_REG_ATIVO) {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'DESATIVAR')) {
        $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";
    }
}

/* Permissão para o botão ativar */
$btn_ativar = "";
if (! $VAR_PROJETO_REG_ATIVO) {
    if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'ATIVAR')) {
        $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";
    }
}

/* Permissão para o botão editar */
$btn_editar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'ALTERAR')) {
    $btn_editar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=ALTERAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_PROJETO_CONSULTAR')\"><i class=\"fa fa-edit\"></i> <b>$SysRtl_Btn_Editar</b></a>";
}

/* Permissão para o botão novo */
$btn_novo = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'INCLUIR')) {
    $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
}

/* Permissão para o botão pesquisar */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'PESQUISAR')) {
    $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";
}

unset($PERMISSAO_);
// -------------------- EXIBIÇÃO DO FORMULARIO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PROJETO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Projeto_Consultar_Conteudo_Titulo</h3>

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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PROJETO_CONSULTAR\" name=\"FORM_PROJETO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" id=\"SysEntidade\" name=\"SysEntidade\" value=\"PROJETO\">
        <input type=\"hidden\" id=\"SysEntidadeAcao\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_PROJETO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_PROJETO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_NOME</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_NOME</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_DESCRICAO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_INICIO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_INICIO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_DATA_INICIO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_FIM\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_FIM</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_DATA_FIM</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_STATUS</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_STATUS</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_PAGAMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_PAGAMENTO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_PAGAMENTO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_PROJETO_CAMINHO</b>
          </div>
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
  LBL_TITULO.innerText='$SysRtl_Projeto_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Projeto_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Projeto_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Projeto_Consultar_Cabecalho_Icone\"></i> $SysRtl_Projeto_Consultar_Cabecalho_Titulo</a>';
</script>";
