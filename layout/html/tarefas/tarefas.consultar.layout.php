<?php
/**
* @file tarefas.consultar.layout.php
* @name tarefas.consultar
* @desc
*   Layout para o formulário de consulta
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

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_TAREFAS_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS'][$tmpValor['NOME']];
}

$tmpLegendaRepetir = array(' anos, ',' meses, ',' dias, ',' horas, ',' minutos  ');
$tmpLegendaRepetirL = array('A','M','D','H','I');
$VAR_TAREFAS_REPETIR = str_replace($tmpLegendaRepetirL,$tmpLegendaRepetir,$VAR_TAREFAS_REPETIR);


$VAR_TAREFAS_ENTIDADE = ucfirst(strtolower($this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS']['ENTIDADE']));
$VAR_TAREFAS_ENTIDADEACAO_NOME = ucwords(strtolower(str_replace('_',' ',$this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS']['ENTIDADEACAO_NOME'])));

// -------------------- MANIPULAÇÃO -----------------//
/* Formata o campo DATACRIACAO */
$VAR_TAREFAS_DATACRIACAO = FORMATA_CAMPO($VAR_TAREFAS_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Formata o campo DATA */
$VAR_TAREFAS_DATA = FORMATA_CAMPO($VAR_TAREFAS_DATA,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');
/* Formata o campo DATA_FINAL */
$VAR_TAREFAS_DATA_FINAL = FORMATA_CAMPO($VAR_TAREFAS_DATA_FINAL,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');
/* Tratamento do campo ATIVA */
($VAR_TAREFAS_ATIVA=='A')?$tmpEscolhaChecked=" checked ":$tmpEscolhaChecked="";

/* Tratamento do campo REPETIR SEMANA */
$SysOpt_Tarefas_SEMANA['DIAS'];
$tmpVAR_TAREFAS_REPETIR_SEMANA =str_split($VAR_TAREFAS_REPETIR_SEMANA);
$VAR_TAREFAS_REPETIR_SEMANA = '';
for ($i=0; $i<count($SysOpt_Tarefas_SEMANA['DIAS']); $i++)
  if ($tmpVAR_TAREFAS_REPETIR_SEMANA[$i]=='1')
    $VAR_TAREFAS_REPETIR_SEMANA .= $SysOpt_Tarefas_SEMANA['DIAS'][$i].'; ';



/* Verifica se o registro foi desativado */
if($VAR_TAREFAS_REG_ATIVO=='1'){
  $VAR_TAREFAS_REG_ATIVO=true;
  $VAR_REGISTRO_INATIVO="";
}else{
  $VAR_TAREFAS_REG_ATIVO=false;
  $VAR_REGISTRO_INATIVO=" <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            <b class=\"text-yellow\">$SysRtl_Registro_Inativo</b>
          </div>
          <div class=\"col-sm-5\">
          </div>";
}
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão exibir detalhes do log do registro */
$tmpLogAtividade="<i class=\"fa fa-info-circle\"></i>";            
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'INFORMACAO')){
  $tmpLogAtividade="<a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOGATIVIDADE&SysEntidadeAcao=INFORMACAO&txtChaveRegistro=$VAR_TAREFAS_CODIGO&TXT_LOGATIVIDADE_ENTIDADE=TAREFAS&SID=$SistemaSessaoUID','','DIV_LOG_INFO',null)\">
              <i class=\"fa fa-info-circle\"></i>
            </a> ";
}      
/* Permissão exibir Data de Criação do registro e o Usuário que criou*/
$tmpLogVer = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER'))
$tmpLogVer = "<h6 class=\"text-muted\">
            $tmpLogAtividade
            <i>$SysRtl_Tarefas_Campos_USUARIO_NOME:</i><b> $VAR_TAREFAS_USUARIO_NOME</b> - <i>$SysRtl_Tarefas_Campos_DATACRIACAO:</i><b> $VAR_TAREFAS_DATACRIACAO</b></h6>";
  

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

/* Permissão para o botão editar */      
$btn_editar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'ALTERAR'))
  $btn_editar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=ALTERAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_TAREFAS_CONSULTAR')\"><i class=\"fa fa-edit\"></i> <b>$SysRtl_Btn_Editar</b></a>";

/* Permissão para o botão novo */    
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
  
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'TAREFAS', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=TAREFAS&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);
// -------------------- EXIBIÇÃO DO FORMULARIO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_TAREFAS\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Tarefas_Consultar_Conteudo_Titulo</h3>
      
      <div class=\"btn-group pull-right\">
        $btn_excluir
        $btn_desativar
        $btn_ativar
        $btn_editar
        $btn_novo
        $btn_pesquisar
      </div>
      
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_TAREFAS_CONSULTAR\" name=\"FORM_TAREFAS_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" id=\"SysEntidade\" name=\"SysEntidade\" value=\"TAREFAS\">
        <input type=\"hidden\" id=\"SysEntidadeAcao\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_TAREFAS_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_TAREFAS_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_NOME</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_NOME</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_DATA</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_REPETIR</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_HORA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_HORA</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_HORA</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_SEMANA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_SEMANA</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_REPETIR_SEMANA</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DURACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DURACAO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_DURACAO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_DESCRICAO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ENTIDADEACAO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ENTIDADEACAO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_ENTIDADE.$VAR_TAREFAS_ENTIDADEACAO_NOME</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_PARAMETRO\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_PARAMETRO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_PARAMETRO</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_REPETIR_VEZES\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_REPETIR_VEZES</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_REPETIR_VEZES</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_DATA_FINAL\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_DATA_FINAL</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_DATA_FINAL</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_TAREFAS_ATIVA\" class=\"col-sm-2 control-label\">$SysRtl_Tarefas_Campos_ATIVA</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_TAREFAS_ATIVA</b>
          </div>
        </div>

        $VAR_REGISTRO_INATIVO
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\" id=\"DIV_LOG_INFO\">
            $tmpLogVer
          </div>
          <di class=\"col-sm-9\" >
          </di>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Tarefas_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Tarefas_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Tarefas_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Tarefas_Consultar_Cabecalho_Icone\"></i> $SysRtl_Tarefas_Consultar_Cabecalho_Titulo</a>';
</script>";
?>