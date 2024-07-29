<?php
/**
* @file scripts.alterar.layout.php
* @name scripts.alterar
* @desc
*   Layout para o formulário de alteração
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    scripts
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-07-04  v. 0.0.0
*
*/


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeScriptsCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_SCRIPTS_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_SCRIPTS_DATACRIACAO = FORMATA_CAMPO($VAR_SCRIPTS_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_SCRIPTS_REG_ATIVO=='1')?$VAR_SCRIPTS_REG_ATIVO=true:$VAR_SCRIPTS_REG_ATIVO=false;




// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_SCRIPTS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_SCRIPTS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_SCRIPTS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_SCRIPTS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_SCRIPTS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_SCRIPTS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_SCRIPTS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Scripts_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SCRIPTS_CONSULTAR\" name=\"FORM_SCRIPTS_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"SCRIPTS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_SCRIPTS_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_SCRIPTS_NOME\" placeholder=\"$SysRtl_Scripts_Campos_NOME\" name=\"TXT_SCRIPTS_NOME\" value=\"$VAR_SCRIPTS_NOME\" $TXT_SCRIPTS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_SCRIPTS_DESCRICAO\" placeholder=\"$SysRtl_Scripts_Campos_DESCRICAO\" name=\"TXT_SCRIPTS_DESCRICAO\" value=\"$VAR_SCRIPTS_DESCRICAO\" $TXT_SCRIPTS_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_TIPO</label>";
          foreach($SysOpt_Scripts_TIPO['OPCOES'] as $tmpOpcoesTipo){
            ($VAR_SCRIPTS_TIPO==$tmpOpcoesTipo['VALOR'])?$tmpChecked=" checked ":$tmpChecked="";
            $this->SISTEMA_['SAIDA']['EXIBIR'] .="<div class=\"col-sm-3\">
            <label>
              <input type=\"radio\" id=\"TXT_SCRIPTS_TIPO\" name=\"TXT_SCRIPTS_TIPO\" value=\"".$tmpOpcoesTipo['VALOR']."\" $TXT_SCRIPTS_TIPO_required $tmpChecked> ".$tmpOpcoesTipo['LEGENDA']."
            </label>
            </div>";
          }
$this->SISTEMA_['SAIDA']['EXIBIR'] .="        
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_SCRIPT\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_SCRIPT</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"DescriÃ§Ã£o\" id=\"TXT_SCRIPTS_SCRIPT\" name=\"TXT_SCRIPTS_SCRIPT\" $TXT_SCRIPTS_SCRIPT_required >$VAR_SCRIPTS_SCRIPT</textarea>
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_SCRIPTS_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Scripts_Campos_USUARIO_NOME:</i><b> $VAR_SCRIPTS_USUARIO_NOME</b> - <i>$SysRtl_Scripts_Campos_DATACRIACAO:</i><b> $VAR_SCRIPTS_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Scripts_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Scripts_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Scripts_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Scripts_Alterar_Cabecalho_Icone\"></i> $SysRtl_Scripts_Alterar_Cabecalho_Titulo</a>';
</script>";

?>