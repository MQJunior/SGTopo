<?php
/**
* @file scripts.incluir.layout.php
* @name scripts.incluir
* @desc
*   Layout para o formulário de inclusão
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

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeScriptsCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SCRIPTS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SCRIPTS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_SCRIPTS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Scripts_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SCRIPTS_INCLUIR\" name=\"FORM_SCRIPTS_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"SCRIPTS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_SCRIPTS_NOME\" placeholder=\"$SysRtl_Scripts_Campos_NOME\" name=\"TXT_SCRIPTS_NOME\" value=\"\" $TXT_SCRIPTS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_SCRIPTS_DESCRICAO\" placeholder=\"$SysRtl_Scripts_Campos_DESCRICAO\" name=\"TXT_SCRIPTS_DESCRICAO\" value=\"\" $TXT_SCRIPTS_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_TIPO</label>";
          foreach($SysOpt_Scripts_TIPO['OPCOES'] as $tmpOpcoesTipo){
            $this->SISTEMA_['SAIDA']['EXIBIR'] .="<div class=\"col-sm-3\">
            <label>
              <input type=\"radio\" id=\"TXT_SCRIPTS_TIPO\" name=\"TXT_SCRIPTS_TIPO\" value=\"".$tmpOpcoesTipo['VALOR']."\" $TXT_SCRIPTS_TIPO_required > ".$tmpOpcoesTipo['LEGENDA']."
            </label>
            </div>";
          }
$this->SISTEMA_['SAIDA']['EXIBIR'] .="        
        </div>
<div class=\"form-group\">
          <label for=\"TXT_SCRIPTS_SCRIPT\" class=\"col-sm-2 control-label\">$SysRtl_Scripts_Campos_SCRIPT</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"DescriÃ§Ã£o\" id=\"TXT_SCRIPTS_SCRIPT\" name=\"TXT_SCRIPTS_SCRIPT\" $TXT_SCRIPTS_SCRIPT_required ></textarea>
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\"><button type=\"submit\" style=\"display:none\" id=\"BTN_FORM_SUBMIT\"  name=\"BTN_FORM_SUBMIT\"></button>
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"BTN_FORM_SUBMIT.click()\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Scripts_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Scripts_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Scripts_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Scripts_Incluir_Cabecalho_Icone\"></i> $SysRtl_Scripts_Incluir_Cabecalho_Titulo</a>';
</script>";

?>