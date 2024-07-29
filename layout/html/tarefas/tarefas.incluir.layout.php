<?php
/**
* @file tarefas.incluir.layout.php
* @name tarefas.incluir
* @desc
*   Layout para o formulário de inclusão
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeTarefasCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_TAREFAS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Tarefas_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_TAREFAS_INCLUIR\" name=\"FORM_TAREFAS_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"TAREFAS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_TAREFAS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TAREFAS_NOME\" placeholder=\"$SysRtl_Tarefas_Campos_NOME\" name=\"TXT_TAREFAS_NOME\" value=\"\" @$TXT_TAREFAS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_TAREFAS_DATA\" placeholder=\"$SysRtl_Tarefas_Campos_DATA\" name=\"TXT_TAREFAS_DATA\" value=\"\" @$TXT_TAREFAS_DATA_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR</label>
          <div class=\"col-sm-1\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_ANO\" placeholder=\"Anos\" name=\"TXT_TAREFAS_REPETIR_ANO\" value=\"\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_MES\" placeholder=\"Meses\" name=\"TXT_TAREFAS_REPETIR_MES\" value=\"\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"999\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_DIAS\" placeholder=\"Dias\" name=\"TXT_TAREFAS_REPETIR_DIAS\" value=\"\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_HORAS\" placeholder=\"Horas\" name=\"TXT_TAREFAS_REPETIR_HORAS\" value=\"\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_MINUTOS\" placeholder=\"Minutos\" name=\"TXT_TAREFAS_REPETIR_MINUTOS\" value=\"\">
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_HORA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_HORA</label>
          <div class=\"col-sm-9\">
            <input type=\"time\" class=\"form-control\" id=\"TXT_TAREFAS_HORA\" placeholder=\"$SysRtl_Tarefas_Campos_HORA\" name=\"TXT_TAREFAS_HORA\" value=\"\" @$TXT_TAREFAS_HORA_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_SEMANA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_SEMANA</label>
          <div class=\"col-sm-9\">
              <div class=\"checkbox\">";

for ($i=0; $i<count($SysOpt_Tarefas_SEMANA['DIAS']); $i++)
  $this->SISTEMA_['SAIDA']['EXIBIR'] .="              <label>
                  <input type=\"checkbox\" name=\"TXT_TAREFAS_REPETIR_SEMANA[]\" value=\"".$i."\">
                  ".$SysOpt_Tarefas_SEMANA['DIAS'][$i]."
                </label>";
                
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "</div>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DURACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DURACAO</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0\" max=\"9999\" class=\"form-control\" id=\"TXT_TAREFAS_DURACAO\" placeholder=\"$SysRtl_Tarefas_Campos_DURACAO\" name=\"TXT_TAREFAS_DURACAO\" value=\"\" @$TXT_TAREFAS_DURACAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"DescriÃ§Ã£o\" id=\"TXT_TAREFAS_DESCRICAO\" name=\"TXT_TAREFAS_DESCRICAO\" @$TXT_TAREFAS_DESCRICAO_required ></textarea>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ENTIDADEACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ENTIDADEACAO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" id=\"TXT_TAREFAS_ENTIDADEACAO\" name=\"TXT_TAREFAS_ENTIDADEACAO\" placeholder=\"$SysRtl_Tarefas_Campos_ENTIDADEACAO\"  onchange=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=TAREFAS&SysEntidadeAcao=TABELA_REGISTROS&txtChaveRegistro='+this.value,'','DIV_TAREFAS_PARAMETRO','');\" @$TXT_TAREFAS_ENTIDADEACAO_required >";

            
            
foreach ($this->SISTEMA_['ENTIDADE']['TAREFAS']['ENTIDADEACAO']['DADOS'] as $tmpListaEntidaeAcao)        
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= "              <option value=\"".$tmpListaEntidaeAcao['ENTIDADEACAO_CODIGO']."\">".$tmpListaEntidaeAcao['ENTIDADE']." - ".$tmpListaEntidaeAcao['ENTIDADEACAO_NOME']."</option>";

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "            </select>
            
          </div>
        </div>
<div class=\"form-group\" id=\"DIV_TAREFAS_PARAMETRO\" name=\"DIV_TAREFAS_PARAMETRO\">
          <label for=\"TXT_TAREFAS_PARAMETRO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_PARAMETRO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" id=\"TXT_TAREFAS_PARAMETRO\" name=\"TXT_TAREFAS_PARAMETRO\" placeholder=\"$SysRtl_Tarefas_Campos_PARAMETRO\" @$TXT_TAREFAS_PARAMETRO_required >";
            
foreach ($this->SISTEMA_['ENTIDADE']['TAREFAS']['TABELAS']['DADOS'] as $tmpTabelaDados){
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "              <option value=\"".$tmpTabelaDados['CODIGO']."\" >".$tmpTabelaDados['CODIGO']." - ".$tmpTabelaDados['NOME']."</option>";
}
  
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "            </select>            
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_VEZES\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_VEZES</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0\" max=\"9999\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_VEZES\" placeholder=\"$SysRtl_Tarefas_Campos_REPETIR_VEZES\" name=\"TXT_TAREFAS_REPETIR_VEZES\" value=\"\" @$TXT_TAREFAS_REPETIR_VEZES_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA_FINAL\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA_FINAL</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_TAREFAS_DATA_FINAL\" placeholder=\"$SysRtl_Tarefas_Campos_DATA_FINAL\" name=\"TXT_TAREFAS_DATA_FINAL\" value=\"\" @$TXT_TAREFAS_DATA_FINAL_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ATIVA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ATIVA</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_TAREFAS_ATIVA\" name=\"TXT_TAREFAS_ATIVA\" value=\"A\" >
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
  LBL_TITULO.innerText='$SysRtl_Tarefas_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Tarefas_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Tarefas_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Tarefas_Incluir_Cabecalho_Icone\"></i> $SysRtl_Tarefas_Incluir_Cabecalho_Titulo</a>';
</script>";

?>