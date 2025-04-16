<?php
/**
 * 📄 tipodocumento.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: tipodocumento | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeTipodocumentoCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_TIPODOCUMENTO_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['TIPODOCUMENTO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_TIPODOCUMENTO_DATACRIACAO = FORMATA_CAMPO($VAR_TIPODOCUMENTO_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_TIPODOCUMENTO_REG_ATIVO=='1')?$VAR_TIPODOCUMENTO_REG_ATIVO=true:$VAR_TIPODOCUMENTO_REG_ATIVO=false;




// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TIPODOCUMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_TIPODOCUMENTO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TIPODOCUMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_TIPODOCUMENTO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TIPODOCUMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TIPODOCUMENTO', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TIPODOCUMENTO&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TIPODOCUMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_TIPODOCUMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Tipodocumento_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_TIPODOCUMENTO_CONSULTAR\" name=\"FORM_TIPODOCUMENTO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"TIPODOCUMENTO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_TIPODOCUMENTO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_TIPODOCUMENTO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Tipodocumento_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TIPODOCUMENTO_NOME\" placeholder=\"$SysRtl_Tipodocumento_Campos_NOME\" name=\"TXT_TIPODOCUMENTO_NOME\" value=\"$VAR_TIPODOCUMENTO_NOME\" $TXT_TIPODOCUMENTO_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TIPODOCUMENTO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Tipodocumento_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TIPODOCUMENTO_DESCRICAO\" placeholder=\"$SysRtl_Tipodocumento_Campos_DESCRICAO\" name=\"TXT_TIPODOCUMENTO_DESCRICAO\" value=\"$VAR_TIPODOCUMENTO_DESCRICAO\" $TXT_TIPODOCUMENTO_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TIPODOCUMENTO_OBRIGATORIO\" class=\"col-sm-2 control-label\">$SysRtl_Tipodocumento_Campos_OBRIGATORIO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TIPODOCUMENTO_OBRIGATORIO\" placeholder=\"$SysRtl_Tipodocumento_Campos_OBRIGATORIO\" name=\"TXT_TIPODOCUMENTO_OBRIGATORIO\" value=\"$VAR_TIPODOCUMENTO_OBRIGATORIO\" $TXT_TIPODOCUMENTO_OBRIGATORIO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TIPODOCUMENTO_CONTEUDO_TIPODOCUMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Tipodocumento_Campos_CONTEUDO_TIPODOCUMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TIPODOCUMENTO_CONTEUDO_TIPODOCUMENTO\" placeholder=\"$SysRtl_Tipodocumento_Campos_CONTEUDO_TIPODOCUMENTO\" name=\"TXT_TIPODOCUMENTO_CONTEUDO_TIPODOCUMENTO\" value=\"$VAR_TIPODOCUMENTO_CONTEUDO_TIPODOCUMENTO\" $TXT_TIPODOCUMENTO_CONTEUDO_TIPODOCUMENTO_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_TIPODOCUMENTO_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Tipodocumento_Campos_USUARIO_NOME:</i><b> $VAR_TIPODOCUMENTO_USUARIO_NOME</b> - <i>$SysRtl_Tipodocumento_Campos_DATACRIACAO:</i><b> $VAR_TIPODOCUMENTO_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Tipodocumento_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Tipodocumento_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Tipodocumento_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Tipodocumento_Alterar_Cabecalho_Icone\"></i> $SysRtl_Tipodocumento_Alterar_Cabecalho_Titulo</a>';
</script>";

?>