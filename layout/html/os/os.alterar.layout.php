<?php
/**
 * 📄 os.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeOsCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_OS_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['OS']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_OS_DATACRIACAO = FORMATA_CAMPO($VAR_OS_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_OS_REG_ATIVO=='1')?$VAR_OS_REG_ATIVO=true:$VAR_OS_REG_ATIVO=false;




// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_OS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_OS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_OS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_OS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_OS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'OS', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=OS&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_OS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_OS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Os_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_OS_CONSULTAR\" name=\"FORM_OS_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"OS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_OS_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_OS_AGENDAMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_AGENDAMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_AGENDAMENTO\" placeholder=\"$SysRtl_Os_Campos_AGENDAMENTO\" name=\"TXT_OS_AGENDAMENTO\" value=\"$VAR_OS_AGENDAMENTO\" $TXT_OS_AGENDAMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_LOCAL\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_LOCAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_LOCAL\" placeholder=\"$SysRtl_Os_Campos_LOCAL\" name=\"TXT_OS_LOCAL\" value=\"$VAR_OS_LOCAL\" $TXT_OS_LOCAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_PROJETO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_PROJETO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_PROJETO\" placeholder=\"$SysRtl_Os_Campos_PROJETO\" name=\"TXT_OS_PROJETO\" value=\"$VAR_OS_PROJETO\" $TXT_OS_PROJETO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_SOLICITANTE\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_SOLICITANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_SOLICITANTE\" placeholder=\"$SysRtl_Os_Campos_SOLICITANTE\" name=\"TXT_OS_SOLICITANTE\" value=\"$VAR_OS_SOLICITANTE\" $TXT_OS_SOLICITANTE_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_DESCRICAO\" placeholder=\"$SysRtl_Os_Campos_DESCRICAO\" name=\"TXT_OS_DESCRICAO\" value=\"$VAR_OS_DESCRICAO\" $TXT_OS_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_VALORTOTAL\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_VALORTOTAL</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_VALORTOTAL\" placeholder=\"$SysRtl_Os_Campos_VALORTOTAL\" name=\"TXT_OS_VALORTOTAL\" value=\"$VAR_OS_VALORTOTAL\" $TXT_OS_VALORTOTAL_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_SITUACAO\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_SITUACAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_SITUACAO\" placeholder=\"$SysRtl_Os_Campos_SITUACAO\" name=\"TXT_OS_SITUACAO\" value=\"$VAR_OS_SITUACAO\" $TXT_OS_SITUACAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_STATUS\" placeholder=\"$SysRtl_Os_Campos_STATUS\" name=\"TXT_OS_STATUS\" value=\"$VAR_OS_STATUS\" $TXT_OS_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_OS_FATURA\" class=\"col-sm-2 control-label\">$SysRtl_Os_Campos_FATURA</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_OS_FATURA\" placeholder=\"$SysRtl_Os_Campos_FATURA\" name=\"TXT_OS_FATURA\" value=\"$VAR_OS_FATURA\" $TXT_OS_FATURA_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_OS_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Os_Campos_USUARIO_NOME:</i><b> $VAR_OS_USUARIO_NOME</b> - <i>$SysRtl_Os_Campos_DATACRIACAO:</i><b> $VAR_OS_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Os_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Os_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Os_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Os_Alterar_Cabecalho_Icone\"></i> $SysRtl_Os_Alterar_Cabecalho_Titulo</a>';
</script>";

?>