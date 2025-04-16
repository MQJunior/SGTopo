<?php
/**
 * 📄 projeto.alterar.layout.php - Layout para o formulário de alteração
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: Layout
 */


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeProjetoCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_PROJETO_".$tmpValor['NOME'];
  $$tmpVar = $this->SISTEMA_['ENTIDADE']['PROJETO']['VARS'][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_PROJETO_DATACRIACAO = FORMATA_CAMPO($VAR_PROJETO_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_PROJETO_REG_ATIVO=='1')?$VAR_PROJETO_REG_ATIVO=true:$VAR_PROJETO_REG_ATIVO=false;

/* Formata o campo DATA_INICIO */
$VAR_PROJETO_DATA_INICIO = FORMATA_CAMPO($VAR_PROJETO_DATA_INICIO,'Y-m-d','data');
/* Formata o campo DATA_FIM */
$VAR_PROJETO_DATA_FIM = FORMATA_CAMPO($VAR_PROJETO_DATA_FIM,'Y-m-d','data');



// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_PROJETO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_PROJETO_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'PESQUISAR'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_PROJETO_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_PROJETO\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Projeto_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PROJETO_CONSULTAR\" name=\"FORM_PROJETO_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PROJETO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_PROJETO_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_PROJETO_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_NOME\" placeholder=\"$SysRtl_Projeto_Campos_NOME\" name=\"TXT_PROJETO_NOME\" value=\"$VAR_PROJETO_NOME\" $TXT_PROJETO_NOME_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DESCRICAO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DESCRICAO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_DESCRICAO\" placeholder=\"$SysRtl_Projeto_Campos_DESCRICAO\" name=\"TXT_PROJETO_DESCRICAO\" value=\"$VAR_PROJETO_DESCRICAO\" $TXT_PROJETO_DESCRICAO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_INICIO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_INICIO</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PROJETO_DATA_INICIO\" placeholder=\"$SysRtl_Projeto_Campos_DATA_INICIO\" name=\"TXT_PROJETO_DATA_INICIO\" value=\"$VAR_PROJETO_DATA_INICIO\" $TXT_PROJETO_DATA_INICIO_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_DATA_FIM\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_DATA_FIM</label>
          <div class=\"col-sm-9\">
            <input type=\"date\" class=\"form-control\" id=\"TXT_PROJETO_DATA_FIM\" placeholder=\"$SysRtl_Projeto_Campos_DATA_FIM\" name=\"TXT_PROJETO_DATA_FIM\" value=\"$VAR_PROJETO_DATA_FIM\" $TXT_PROJETO_DATA_FIM_required>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_STATUS\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_STATUS</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_STATUS\" placeholder=\"$SysRtl_Projeto_Campos_STATUS\" name=\"TXT_PROJETO_STATUS\" value=\"$VAR_PROJETO_STATUS\" $TXT_PROJETO_STATUS_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_PAGAMENTO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_PAGAMENTO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_PAGAMENTO\" placeholder=\"$SysRtl_Projeto_Campos_PAGAMENTO\" name=\"TXT_PROJETO_PAGAMENTO\" value=\"$VAR_PROJETO_PAGAMENTO\" $TXT_PROJETO_PAGAMENTO_required >
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_PROJETO_CAMINHO\" class=\"col-sm-2 control-label\">$SysRtl_Projeto_Campos_CAMINHO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_PROJETO_CAMINHO\" placeholder=\"$SysRtl_Projeto_Campos_CAMINHO\" name=\"TXT_PROJETO_CAMINHO\" value=\"$VAR_PROJETO_CAMINHO\" $TXT_PROJETO_CAMINHO_required >
          </div>
        </div>

        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_PROJETO_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Projeto_Campos_USUARIO_NOME:</i><b> $VAR_PROJETO_USUARIO_NOME</b> - <i>$SysRtl_Projeto_Campos_DATACRIACAO:</i><b> $VAR_PROJETO_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Projeto_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Projeto_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Projeto_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Projeto_Alterar_Cabecalho_Icone\"></i> $SysRtl_Projeto_Alterar_Cabecalho_Titulo</a>';
</script>";

?>