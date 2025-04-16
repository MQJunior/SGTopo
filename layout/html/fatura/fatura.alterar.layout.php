<?php
/**
 * 📄 fatura.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeFaturaCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_FATURA_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['FATURA']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_FATURA_DATACRIACAO = FORMATA_CAMPO($VAR_FATURA_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_FATURA_REG_ATIVO=='1')?$VAR_FATURA_REG_ATIVO=true:$VAR_FATURA_REG_ATIVO=false;




// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_FATURA_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_FATURA_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_FATURA_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_FATURA_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_FATURA_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'FATURA', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=FATURA&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_FATURA_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_FATURA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Fatura_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_FATURA_CONSULTAR\" name=\"FORM_FATURA_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"FATURA\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_FATURA_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_FATURA_SOLICITANTE\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_SOLICITANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_SOLICITANTE\" placeholder=\"$SysRtl_Fatura_Campos_SOLICITANTE\" name=\"TXT_FATURA_SOLICITANTE\" value=\"$VAR_FATURA_SOLICITANTE\" $TXT_FATURA_SOLICITANTE_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_DATA_EMISSAO\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_DATA_EMISSAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_DATA_EMISSAO\" placeholder=\"$SysRtl_Fatura_Campos_DATA_EMISSAO\" name=\"TXT_FATURA_DATA_EMISSAO\" value=\"$VAR_FATURA_DATA_EMISSAO\" $TXT_FATURA_DATA_EMISSAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_DATA_VENCIMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_DATA_VENCIMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_DATA_VENCIMENTO\" placeholder=\"$SysRtl_Fatura_Campos_DATA_VENCIMENTO\" name=\"TXT_FATURA_DATA_VENCIMENTO\" value=\"$VAR_FATURA_DATA_VENCIMENTO\" $TXT_FATURA_DATA_VENCIMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_VALORTOTAL\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_VALORTOTAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_VALORTOTAL\" placeholder=\"$SysRtl_Fatura_Campos_VALORTOTAL\" name=\"TXT_FATURA_VALORTOTAL\" value=\"$VAR_FATURA_VALORTOTAL\" $TXT_FATURA_VALORTOTAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_FATURA_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Fatura_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_FATURA_STATUS\" placeholder=\"$SysRtl_Fatura_Campos_STATUS\" name=\"TXT_FATURA_STATUS\" value=\"$VAR_FATURA_STATUS\" $TXT_FATURA_STATUS_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_FATURA_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Fatura_Campos_USUARIO_NOME:</i><b> $VAR_FATURA_USUARIO_NOME</b> - <i>$SysRtl_Fatura_Campos_DATACRIACAO:</i><b> $VAR_FATURA_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Fatura_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Fatura_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Fatura_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Fatura_Alterar_Cabecalho_Icone\"></i> $SysRtl_Fatura_Alterar_Cabecalho_Titulo</a>';
</script>";

?>