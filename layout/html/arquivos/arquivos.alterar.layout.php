<?php
/**
 * 📄 arquivos.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeArquivosCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_ARQUIVOS_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['ARQUIVOS']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_ARQUIVOS_DATACRIACAO = FORMATA_CAMPO($VAR_ARQUIVOS_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_ARQUIVOS_REG_ATIVO=='1')?$VAR_ARQUIVOS_REG_ATIVO=true:$VAR_ARQUIVOS_REG_ATIVO=false;

/* Formata o campo DATAHORA_UPLOAD */
$VAR_ARQUIVOS_DATAHORA_UPLOAD = FORMATA_CAMPO($VAR_ARQUIVOS_DATAHORA_UPLOAD,'Y-m-d','data');



// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_ARQUIVOS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_ARQUIVOS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_ARQUIVOS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_ARQUIVOS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_ARQUIVOS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'ARQUIVOS', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=ARQUIVOS&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_ARQUIVOS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_ARQUIVOS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Arquivos_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_ARQUIVOS_CONSULTAR\" name=\"FORM_ARQUIVOS_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"ARQUIVOS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_ARQUIVOS_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_NOME\" placeholder=\"$SysRtl_Arquivos_Campos_NOME\" name=\"TXT_ARQUIVOS_NOME\" value=\"$VAR_ARQUIVOS_NOME\" $TXT_ARQUIVOS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_PROJETO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_PROJETO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_PROJETO\" placeholder=\"$SysRtl_Arquivos_Campos_PROJETO\" name=\"TXT_ARQUIVOS_PROJETO\" value=\"$VAR_ARQUIVOS_PROJETO\" $TXT_ARQUIVOS_PROJETO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_DOCUMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_DOCUMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_DOCUMENTO\" placeholder=\"$SysRtl_Arquivos_Campos_DOCUMENTO\" name=\"TXT_ARQUIVOS_DOCUMENTO\" value=\"$VAR_ARQUIVOS_DOCUMENTO\" $TXT_ARQUIVOS_DOCUMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_TIPO\" placeholder=\"$SysRtl_Arquivos_Campos_TIPO\" name=\"TXT_ARQUIVOS_TIPO\" value=\"$VAR_ARQUIVOS_TIPO\" $TXT_ARQUIVOS_TIPO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_CAMINHO\" placeholder=\"$SysRtl_Arquivos_Campos_CAMINHO\" name=\"TXT_ARQUIVOS_CAMINHO\" value=\"$VAR_ARQUIVOS_CAMINHO\" $TXT_ARQUIVOS_CAMINHO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_ARQUIVOS_STATUS\" placeholder=\"$SysRtl_Arquivos_Campos_STATUS\" name=\"TXT_ARQUIVOS_STATUS\" value=\"$VAR_ARQUIVOS_STATUS\" $TXT_ARQUIVOS_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" class=\"col-sm-2 control-label\">$SysRtl_Arquivos_Campos_DATAHORA_UPLOAD</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" placeholder=\"$SysRtl_Arquivos_Campos_DATAHORA_UPLOAD\" name=\"TXT_ARQUIVOS_DATAHORA_UPLOAD\" value=\"$VAR_ARQUIVOS_DATAHORA_UPLOAD\" $TXT_ARQUIVOS_DATAHORA_UPLOAD_required>
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_ARQUIVOS_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Arquivos_Campos_USUARIO_NOME:</i><b> $VAR_ARQUIVOS_USUARIO_NOME</b> - <i>$SysRtl_Arquivos_Campos_DATACRIACAO:</i><b> $VAR_ARQUIVOS_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Arquivos_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Arquivos_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Arquivos_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Arquivos_Alterar_Cabecalho_Icone\"></i> $SysRtl_Arquivos_Alterar_Cabecalho_Titulo</a>';
</script>";

?>