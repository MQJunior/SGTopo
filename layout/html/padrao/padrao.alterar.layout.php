<?php
/**
* @file padrao.alterar.layout.php
* @name padrao.alterar
* @desc
*   Layout para o formulário de alteração
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    padrao
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadePadraoCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_PADRAO_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['PADRAO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_PADRAO_DATACRIACAO = FORMATA_CAMPO($VAR_PADRAO_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_PADRAO_REG_ATIVO=='1')?$VAR_PADRAO_REG_ATIVO=true:$VAR_PADRAO_REG_ATIVO=false;

/* Formata o campo DATA */
$VAR_PADRAO_DATA = FORMATA_CAMPO($VAR_PADRAO_DATA,'Y-m-d','data');

/* Tratamento do campo checkbox */
($VAR_PADRAO_ESCOLHA=='A')?$tmpEscolhaChecked=" checked ":$tmpEscolhaChecked="";

/* Valor monetário nulo é igual a 0.00 */
($VAR_PADRAO_VALOR==null)?$VAR_PADRAO_VALOR='0.00':$VAR_PADRAO_VALOR=number_format($VAR_PADRAO_VALOR,2,'.',',');


// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_PADRAO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_PADRAO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PADRAO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PADRAO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PADRAO_CONSULTAR\" name=\"FORM_PADRAO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_PADRAO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PADRAO_NOME\" placeholder=\"$SysRtl_Padrao_Campos_NOME\" name=\"TXT_PADRAO_NOME\" value=\"$VAR_PADRAO_NOME\" $TXT_PADRAO_NOME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_TIPO</label>";
          /* Exibe as opções do Tipo para o componente radio */
          foreach($SysOpt_Padrao_ESCOLHA['OPCOES'] as $tmpOpcoesTipo){
            ($VAR_PADRAO_TIPO==$tmpOpcoesTipo['VALOR'])?$tmpChecked=" checked ":$tmpChecked="";
            $this->SISTEMA_['SAIDA']['EXIBIR'] .="<div class=\"col-sm-3\">
            <label>
              <input type=\"radio\" id=\"TXT_PADRAO_TIPO\" name=\"TXT_PADRAO_TIPO\" value=\"".$tmpOpcoesTipo['VALOR']."\" $TXT_PADRAO_TIPO_required $tmpChecked> ".$tmpOpcoesTipo['LEGENDA']."
            </label>
            </div>";
          }
          
$this->SISTEMA_['SAIDA']['EXIBIR'] .="        
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DATA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DATA</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PADRAO_DATA\" placeholder=\"$SysRtl_Padrao_Campos_DATA\" name=\"TXT_PADRAO_DATA\" value=\"$VAR_PADRAO_DATA\" $TXT_PADRAO_DATA_required>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_VALOR\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_VALOR</label>
          <div class=\"col-sm-9\">
            <input type=\"number\" min=\"0.00\" max=\"99999999.99\" step=\"0.01\" class=\"form-control\" id=\"TXT_PADRAO_VALOR\" placeholder=\"$SysRtl_Padrao_Campos_VALOR\" name=\"TXT_PADRAO_VALOR\" style=\"text-align:right\" value=\"$VAR_PADRAO_VALOR\" $TXT_PADRAO_VALOR_required>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_ESCOLHA\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_ESCOLHA</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_PADRAO_ESCOLHA\" name=\"TXT_PADRAO_ESCOLHA\" value=\"A\" $tmpEscolhaChecked>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_PADRAO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Padrao_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"Descrição\" id=\"TXT_PADRAO_DESCRICAO\" name=\"TXT_PADRAO_DESCRICAO\" $TXT_PADRAO_DESCRICAO_required >$VAR_PADRAO_DESCRICAO</textarea>
          </div>
        </div>
        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_PADRAO_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Padrao_Campos_USUARIO_NOME:</i><b> $VAR_PADRAO_USUARIO_NOME</b> - <i>$SysRtl_Padrao_Campos_DATACRIACAO:</i><b> $VAR_PADRAO_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Padrao_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Padrao_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Padrao_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Padrao_Alterar_Cabecalho_Icone\"></i> $SysRtl_Padrao_Alterar_Cabecalho_Titulo</a>';
</script>";

?>