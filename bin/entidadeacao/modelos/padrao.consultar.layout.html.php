<?php
/**
 * 📄 padrao.consultar.layout.php - Layout para o formulário de consulta
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados
$EntidadeCampos = $EntidadePadraoCampos;
foreach ($EntidadeCampos as $tmpValor) {
  $tmpVar = "VAR_PADRAO_" . $tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'][$tmpValor['NOME']];
}

// 🛠️ Manipulação
$VAR_PADRAO_DATACRIACAO = FORMATA_CAMPO($VAR_PADRAO_DATACRIACAO, $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'], 'data');
$VAR_PADRAO_REG_ATIVO = $VAR_PADRAO_REG_ATIVO == '1';
$VAR_REGISTRO_INATIVO = !$VAR_PADRAO_REG_ATIVO ? "<div class=\"form-group\"><b class=\"text-yellow\">$SysRtl_Registro_Inativo</b></div>" : "";

// 🔒 Permissões
$PERMISSAO_ = new permissao($this->SISTEMA_);
$tmpLogAtividade = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'INFORMACAO') ?
  "<a class=\"fa fa-info-circle\"></a>" : "<i class=\"fa fa-info-circle\"></i>";

$tmpLogVer = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER') ?
  "<h6 class=\"text-muted\">$tmpLogAtividade <i>$SysRtl_Padrao_Campos_USUARIO_NOME:</i><b> $VAR_PADRAO_USUARIO_NOME</b> - <i>$SysRtl_Padrao_Campos_DATACRIACAO:</i><b> $VAR_PADRAO_DATACRIACAO</b></h6>" : "";

$btn_excluir = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'EXCLUIR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-trash-o\"></i></a>" : "";

$btn_desativar = $VAR_PADRAO_REG_ATIVO && $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'DESATIVAR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-unlink\"></i></a>" : "";

$btn_ativar = !$VAR_PADRAO_REG_ATIVO && $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'ATIVAR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-link\"></i></a>" : "";

$btn_editar = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'ALTERAR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-edit\"></i></a>" : "";

$btn_novo = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'INCLUIR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-file-o\"></i></a>" : "";

$btn_pesquisar = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'PESQUISAR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-search\"></i></a>" : "";

unset($PERMISSAO_);

// 📦 Exibição do Layout
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PADRAO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Consultar_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_excluir $btn_desativar $btn_ativar $btn_editar $btn_novo $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" id=\"FORM_PADRAO_CONSULTAR\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_PADRAO_CODIGO\">
        $VAR_REGISTRO_INATIVO
      </form>
    </div>
    <div class=\"box-footer\">
      <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
        $tmpLogVer
      </div>
    </div>
  </div>
</div>";

// 📜 JavaScript
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script>
  LBL_TITULO.innerText = '$SysRtl_Padrao_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText = '$SysRtl_Padrao_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText = '$SysRtl_Padrao_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML = '<a><i class=\"fa $SysRtl_Padrao_Consultar_Cabecalho_Icone\"></i> $SysRtl_Padrao_Consultar_Cabecalho_Titulo</a>';
</script>";
?>
