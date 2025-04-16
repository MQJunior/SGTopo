<?php
/**
 * 📄 recebimento.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeRecebimentoCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_RECEBIMENTO_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['RECEBIMENTO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_RECEBIMENTO_DATACRIACAO = FORMATA_CAMPO($VAR_RECEBIMENTO_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_RECEBIMENTO_REG_ATIVO=='1')?$VAR_RECEBIMENTO_REG_ATIVO=true:$VAR_RECEBIMENTO_REG_ATIVO=false;

/* Formata o campo DATA_RECEBIMENTO */
$VAR_RECEBIMENTO_DATA_RECEBIMENTO = FORMATA_CAMPO($VAR_RECEBIMENTO_DATA_RECEBIMENTO,'Y-m-d','data');



// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_RECEBIMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_RECEBIMENTO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_RECEBIMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_RECEBIMENTO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_RECEBIMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'RECEBIMENTO', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=RECEBIMENTO&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_RECEBIMENTO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_RECEBIMENTO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Recebimento_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_RECEBIMENTO_CONSULTAR\" name=\"FORM_RECEBIMENTO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"RECEBIMENTO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_RECEBIMENTO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_PROJETO_SERVICO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" placeholder=\"$SysRtl_Recebimento_Campos_PROJETO_SERVICO\" name=\"TXT_RECEBIMENTO_PROJETO_SERVICO\" value=\"$VAR_RECEBIMENTO_PROJETO_SERVICO\" $TXT_RECEBIMENTO_PROJETO_SERVICO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_TIPO\" placeholder=\"$SysRtl_Recebimento_Campos_TIPO\" name=\"TXT_RECEBIMENTO_TIPO\" value=\"$VAR_RECEBIMENTO_TIPO\" $TXT_RECEBIMENTO_TIPO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_DATA_RECEBIMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" placeholder=\"$SysRtl_Recebimento_Campos_DATA_RECEBIMENTO\" name=\"TXT_RECEBIMENTO_DATA_RECEBIMENTO\" value=\"$VAR_RECEBIMENTO_DATA_RECEBIMENTO\" $TXT_RECEBIMENTO_DATA_RECEBIMENTO_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_VALOR\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_VALOR</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_VALOR\" placeholder=\"$SysRtl_Recebimento_Campos_VALOR\" name=\"TXT_RECEBIMENTO_VALOR\" value=\"$VAR_RECEBIMENTO_VALOR\" $TXT_RECEBIMENTO_VALOR_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_RECEBIMENTO_COMPROVANTE\" class=\"col-sm-2 control-label\">$SysRtl_Recebimento_Campos_COMPROVANTE</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_RECEBIMENTO_COMPROVANTE\" placeholder=\"$SysRtl_Recebimento_Campos_COMPROVANTE\" name=\"TXT_RECEBIMENTO_COMPROVANTE\" value=\"$VAR_RECEBIMENTO_COMPROVANTE\" $TXT_RECEBIMENTO_COMPROVANTE_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_RECEBIMENTO_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Recebimento_Campos_USUARIO_NOME:</i><b> $VAR_RECEBIMENTO_USUARIO_NOME</b> - <i>$SysRtl_Recebimento_Campos_DATACRIACAO:</i><b> $VAR_RECEBIMENTO_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Recebimento_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Recebimento_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Recebimento_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Recebimento_Alterar_Cabecalho_Icone\"></i> $SysRtl_Recebimento_Alterar_Cabecalho_Titulo</a>';
</script>";

?>