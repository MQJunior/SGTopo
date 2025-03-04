<?php
/**
* @file tarefas.alterar.layout.php
* @name tarefas.alterar
* @desc
*   Layout para o formulário de alteração
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    tarefas
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-07-15  v. 0.0.0
*
*/


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeTarefasCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_TAREFAS_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_TAREFAS_DATACRIACAO = FORMATA_CAMPO($VAR_TAREFAS_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_TAREFAS_REG_ATIVO=='1')?$VAR_TAREFAS_REG_ATIVO=true:$VAR_TAREFAS_REG_ATIVO=false;

/* Formata o campo DATA */
$VAR_TAREFAS_DATA = FORMATA_CAMPO($VAR_TAREFAS_DATA,'Y-m-d','data');
/* Formata o campo DATA_FINAL */
$VAR_TAREFAS_DATA_FINAL = FORMATA_CAMPO($VAR_TAREFAS_DATA_FINAL,'Y-m-d','data');
/* Tratamento do campo ATIVA */
($VAR_TAREFAS_ATIVA=='A')?$tmpEscolhaChecked=" checked ":$tmpEscolhaChecked="";

  $VAR_TAREFAS_REPETIR_ANO = '';
  $VAR_TAREFAS_REPETIR_MES = '';
  $VAR_TAREFAS_REPETIR_DIAS = '';
  $VAR_TAREFAS_REPETIR_HORAS ='';
  $VAR_TAREFAS_REPETIR_MINUTOS ='';
if ($VAR_TAREFAS_REPETIR != ''){
  
  $tmpPosA=strpos($VAR_TAREFAS_REPETIR,'A');
  $tmpPosM=strpos($VAR_TAREFAS_REPETIR,'M');
  $tmpPosD=strpos($VAR_TAREFAS_REPETIR,'D');
  $tmpPosH=strpos($VAR_TAREFAS_REPETIR,'H');
  $tmpPosI=strpos($VAR_TAREFAS_REPETIR,'I');
  if ($tmpPosA === false){
    $VAR_TAREFAS_REPETIR_ANO = '';
  }else{
    $VAR_TAREFAS_REPETIR_ANO = substr($VAR_TAREFAS_REPETIR,0,$tmpPosA);
  }
  if ($tmpPosM === false){
    $VAR_TAREFAS_REPETIR_MES = '';
  }else{
    $VAR_TAREFAS_REPETIR_MES = substr($VAR_TAREFAS_REPETIR,$tmpPosA+1,$tmpPosM-$tmpPosA-1);
  }
  if ($tmpPosD === false){
    $VAR_TAREFAS_REPETIR_DIAS = '';
  }else{
    $VAR_TAREFAS_REPETIR_DIAS = substr($VAR_TAREFAS_REPETIR,$tmpPosM+1,$tmpPosD-$tmpPosM-1);
  }
  if ($tmpPosH === false){
    $VAR_TAREFAS_REPETIR_HORAS = '';
  }else{
    $VAR_TAREFAS_REPETIR_HORAS = substr($VAR_TAREFAS_REPETIR,$tmpPosD+1,$tmpPosH-$tmpPosD-1);
  }
  if ($tmpPosI === false){
    $VAR_TAREFAS_REPETIR_MINUTOS = '';
  }else{
    $VAR_TAREFAS_REPETIR_MINUTOS = substr($VAR_TAREFAS_REPETIR,$tmpPosH+1,$tmpPosI-$tmpPosH-1);
  }
}
  


// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TAREFAS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_TAREFAS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TAREFAS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_TAREFAS_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TAREFAS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_TAREFAS_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_TAREFAS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Tarefas_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_TAREFAS_CONSULTAR\" name=\"FORM_TAREFAS_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"TAREFAS\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_TAREFAS_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_TAREFAS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_TAREFAS_NOME\" placeholder=\"$SysRtl_Tarefas_Campos_NOME\" name=\"TXT_TAREFAS_NOME\" value=\"$VAR_TAREFAS_NOME\" $TXT_TAREFAS_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_TAREFAS_DATA\" placeholder=\"$SysRtl_Tarefas_Campos_DATA\" name=\"TXT_TAREFAS_DATA\" value=\"$VAR_TAREFAS_DATA\" $TXT_TAREFAS_DATA_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR</label>
          <div class=\"col-sm-1\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_ANO\" placeholder=\"Anos\" name=\"TXT_TAREFAS_REPETIR_ANO\" value=\"$VAR_TAREFAS_REPETIR_ANO\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_MES\" placeholder=\"Meses\" name=\"TXT_TAREFAS_REPETIR_MES\" value=\"$VAR_TAREFAS_REPETIR_MES\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"999\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_DIAS\" placeholder=\"Dias\" name=\"TXT_TAREFAS_REPETIR_DIAS\" value=\"$VAR_TAREFAS_REPETIR_DIAS\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_HORAS\" placeholder=\"Horas\" name=\"TXT_TAREFAS_REPETIR_HORAS\" value=\"$VAR_TAREFAS_REPETIR_HORAS\">
          </div>
          <div class=\"col-sm-2\">
            <input type=\"number\" min=\"0\" max=\"99\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_MINUTOS\" placeholder=\"Minutos\" name=\"TXT_TAREFAS_REPETIR_MINUTOS\" value=\"$VAR_TAREFAS_REPETIR_MINUTOS\">
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_HORA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_HORA</label>
          <div class=\"col-sm-9\">
            <input type=\"time\" class=\"form-control\" id=\"TXT_TAREFAS_HORA\" placeholder=\"$SysRtl_Tarefas_Campos_HORA\" name=\"TXT_TAREFAS_HORA\" value=\"$VAR_TAREFAS_HORA\" $TXT_TAREFAS_HORA_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_SEMANA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_SEMANA</label>
          <div class=\"col-sm-9\">
              <div class=\"checkbox\">";

/* Tratamento do campo REPETIR SEMANA */
$SysOpt_Tarefas_SEMANA['DIAS'];
$tmpVAR_TAREFAS_REPETIR_SEMANA =str_split($VAR_TAREFAS_REPETIR_SEMANA);
$VAR_TAREFAS_REPETIR_SEMANA = '';

for ($i=0; $i<count($SysOpt_Tarefas_SEMANA['DIAS']); $i++){
  $tmpDiaSemanaChecked="";
  
  if ($tmpVAR_TAREFAS_REPETIR_SEMANA[$i]=='1')
    $tmpDiaSemanaChecked = " checked";
  
  
  $this->SISTEMA_['SAIDA']['EXIBIR'] .="              <label>
                  <input type=\"checkbox\" name=\"TXT_TAREFAS_REPETIR_SEMANA[]\" value=\"".$i."\" $tmpDiaSemanaChecked >
                  ".$SysOpt_Tarefas_SEMANA['DIAS'][$i]."
                </label>";
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "</div>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DURACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DURACAO</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0\" max=\"9999\" class=\"form-control\" id=\"TXT_TAREFAS_DURACAO\" placeholder=\"$SysRtl_Tarefas_Campos_DURACAO\" name=\"TXT_TAREFAS_DURACAO\" value=\"$VAR_TAREFAS_DURACAO\" $TXT_TAREFAS_DURACAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"$SysRtl_Tarefas_Campos_DESCRICAO\" id=\"TXT_TAREFAS_DESCRICAO\" name=\"TXT_TAREFAS_DESCRICAO\" $TXT_TAREFAS_DESCRICAO_required >$VAR_TAREFAS_DESCRICAO</textarea>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ENTIDADEACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ENTIDADEACAO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" id=\"TXT_TAREFAS_ENTIDADEACAO\" name=\"TXT_TAREFAS_ENTIDADEACAO\" placeholder=\"$SysRtl_Tarefas_Campos_ENTIDADEACAO\"  onchange=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=TAREFAS&SysEntidadeAcao=TABELA_REGISTROS&txtChaveRegistro='+this.value,'','DIV_TAREFAS_PARAMETRO','');\" @$TXT_TAREFAS_ENTIDADEACAO_required >";
            
foreach ($this->SISTEMA_['ENTIDADE']['TAREFAS']['ENTIDADEACAO']['DADOS'] as $tmpListaEntidaeAcao){
  $tmpSelected = "";
  if ($tmpListaEntidaeAcao['ENTIDADEACAO_CODIGO'] == $VAR_TAREFAS_ENTIDADEACAO)
    $tmpSelected = "selected";
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "              <option value=\"".$tmpListaEntidaeAcao['ENTIDADEACAO_CODIGO']."\" $tmpSelected>".$tmpListaEntidaeAcao['ENTIDADE']." - ".$tmpListaEntidaeAcao['ENTIDADEACAO_NOME']."</option>";
}
  
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "            </select>
          </div>
        </div>
        <div class=\"form-group\" id=\"DIV_TAREFAS_PARAMETRO\" name=\"DIV_TAREFAS_PARAMETRO\">
          <label for=\"TXT_TAREFAS_PARAMETRO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_PARAMETRO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" id=\"TXT_TAREFAS_PARAMETRO\" name=\"TXT_TAREFAS_PARAMETRO\" placeholder=\"$SysRtl_Tarefas_Campos_PARAMETRO\" @$TXT_TAREFAS_PARAMETRO_required >";
            
foreach ($this->SISTEMA_['ENTIDADE']['TAREFAS']['TABELAS']['DADOS'] as $tmpTabelaDados){
  $tmpSelected = "";
  if ($tmpTabelaDados['CODIGO'] == $VAR_TAREFAS_PARAMETRO)
    $tmpSelected = "selected";
  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "              <option value=\"".$tmpTabelaDados['CODIGO']."\" $tmpSelected>".$tmpTabelaDados['CODIGO']." - ".$tmpTabelaDados['NOME']."</option>";
}
  
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "            </select>            
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_VEZES\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_VEZES</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0\" max=\"9999\" class=\"form-control\" id=\"TXT_TAREFAS_REPETIR_VEZES\" placeholder=\"$SysRtl_Tarefas_Campos_REPETIR_VEZES\" name=\"TXT_TAREFAS_REPETIR_VEZES\" value=\"$VAR_TAREFAS_REPETIR_VEZES\" $TXT_TAREFAS_REPETIR_VEZES_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA_FINAL\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA_FINAL</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_TAREFAS_DATA_FINAL\" placeholder=\"$SysRtl_Tarefas_Campos_DATA_FINAL\" name=\"TXT_TAREFAS_DATA_FINAL\" value=\"$VAR_TAREFAS_DATA_FINAL\" $TXT_TAREFAS_DATA_FINAL_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ATIVA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ATIVA</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_TAREFAS_ATIVA\" name=\"TXT_TAREFAS_ATIVA\" value=\"A\" $tmpEscolhaChecked>
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_TAREFAS_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Tarefas_Campos_USUARIO_NOME:</i><b> $VAR_TAREFAS_USUARIO_NOME</b> - <i>$SysRtl_Tarefas_Campos_DATACRIACAO:</i><b> $VAR_TAREFAS_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Tarefas_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Tarefas_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Tarefas_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Tarefas_Alterar_Cabecalho_Icone\"></i> $SysRtl_Tarefas_Alterar_Cabecalho_Titulo</a>';
</script>";

?>