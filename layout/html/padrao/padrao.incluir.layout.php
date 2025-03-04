<?php
/**
 * @file padrao.incluir.layout.php
 * @name padrao.incluir
 * @desc
 *   Layout para o formul�rio de inclus�o
 *
 * @author     Márcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Márcio Queiroz Jr.
 * @package    padrao
 * @subpackage Layout
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */

/* Verifica os campos obrigat�rios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadePadraoCampos;
foreach ($EntidadeCampos as $tmpCampo => $tmpInfoCampos) {
  $tmpRequired = $tmpCampo . "_required";
  ($tmpInfoCampos['REQUERIDO']) ? $$tmpRequired = "required" : $$tmpRequired = "";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permiss�o para pesquisar os Dados */
$btn_pesquisar = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//

/* Layout do Formul�rio */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PADRAO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PADRAO_INCLUIR\" name=\"FORM_PADRAO_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PADRAO_NOME\" placeholder=\"$SysRtl_Padrao_Campos_NOME\" name=\"TXT_PADRAO_NOME\" value=\"\" $TXT_PADRAO_NOME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_TIPO</label>";

foreach ($SysOpt_Padrao_ESCOLHA['OPCOES'] as $tmpOpcoesTipo)
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<div class=\"col-sm-3\">
            <label>
              <input type=\"radio\" id=\"TXT_PADRAO_TIPO\" name=\"TXT_PADRAO_TIPO\" value=\"" . $tmpOpcoesTipo['VALOR'] . "\" $TXT_PADRAO_TIPO_required> " . $tmpOpcoesTipo['LEGENDA'] . "
            </label>
          </div>";


$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DATA</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PADRAO_DATA\" placeholder=\"$SysRtl_Padrao_Campos_DATA\" name=\"TXT_PADRAO_DATA\" value=\"\" $TXT_PADRAO_DATA_required>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_VALOR\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_VALOR</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0.00\" max=\"99999999.99\" step=\"0.01\" class=\"form-control\" id=\"TXT_PADRAO_VALOR\" placeholder=\"$SysRtl_Padrao_Campos_VALOR\" name=\"TXT_PADRAO_VALOR\" style=\"text-align:right\" value=\"0.00\" $TXT_PADRAO_VALOR_required>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_ESCOLHA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_ESCOLHA</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_PADRAO_ESCOLHA\" name=\"TXT_PADRAO_ESCOLHA\" value=\"A\">
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"Descrição\" id=\"TXT_PADRAO_DESCRICAO\" name=\"TXT_PADRAO_DESCRICAO\" $TXT_PADRAO_DESCRICAO_required ></textarea>
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

/* Layout JavaScript para manipula��o do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Padrao_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Padrao_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Padrao_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Padrao_Incluir_Cabecalho_Icone\"></i> $SysRtl_Padrao_Incluir_Cabecalho_Titulo</a>';
</script>";

?>