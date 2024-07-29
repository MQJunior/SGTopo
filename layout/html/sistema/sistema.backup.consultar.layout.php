<?php
/**
* @file sistema.backup.consultar.layout.php
* @name sistema.backup.consultar
* @desc
*   Layout para o formulário de consulta
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-04-03  v. 0.0.0
*
*/

// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeBackupCampos;

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_BACKUP_".$tmpValor['NOME'];
  $$tmpVar = $BackupDados[0][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//
/* Formata o campo DATACRIACAO */
$VAR_BACKUP_DATACRIACAO = FORMATA_CAMPO($VAR_BACKUP_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

($VAR_BACKUP_COMPACTAR=='S')?$VAR_BACKUP_COMPACTAR='SIM':$VAR_BACKUP_COMPACTAR='NÃO';

foreach($SysOpt_Backup_TIPO['OPCOES'] as $tmpTIPO)
  if($tmpTIPO['VALOR']==$VAR_BACKUP_TIPO)$VAR_BACKUP_TIPO=$tmpTIPO['LEGENDA'];

/* Verifica se o registro foi desativado */
if($VAR_BACKUP_REG_ATIVO=='1'){
  $VAR_BACKUP_REG_ATIVO=true;
  $VAR_REGISTRO_INATIVO="";
}else{
  $VAR_BACKUP_REG_ATIVO=false;
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
  $tmpLogAtividade="<a href=\"javascript::;\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=LOGATIVIDADE&SysEntidadeAcao=INFORMACAO&txtChaveRegistro=$VAR_BACKUP_CODIGO&TXT_LOGATIVIDADE_ENTIDADE=SISTEMA&SID=$SistemaSessaoUID','','DIV_LOG_INFO',null)\">
              <i class=\"fa fa-info-circle\"></i>
            </a> ";
}      
/* Permissão exibir Data de Criação do registro e o Usuário que criou*/
$tmpLogVer = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'LOGATIVIDADE', 'VER'))
$tmpLogVer = "<h6 class=\"text-muted\">
            $tmpLogAtividade
            <i>$SysRtl_Backup_Campos_USUARIO_NOME:</i><b> $VAR_BACKUP_USUARIO_NOME</b> - <i>$SysRtl_Backup_Campos_DATACRIACAO:</i><b> $VAR_BACKUP_DATACRIACAO</b></h6>";
  

/* Permissão para o botão excluir */  
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */    
$btn_desativar = "";
if($VAR_BACKUP_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */      
$btn_ativar = "";
if(!$VAR_BACKUP_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão editar */      
$btn_editar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_ALTERAR'))
  $btn_editar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_ALTERAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_SISTEMA_CONSULTAR')\"><i class=\"fa fa-edit\"></i> <b>$SysRtl_Btn_Editar</b></a>";

/* Permissão para o botão novo */    
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
  
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_RESTORE'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_RESTORE&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão Executar */  
$btn_backup_executar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_EXECUTAR'))
  $btn_backup_executar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-success\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_EXECUTAR&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_SISTEMA_CONSULTAR')\"><i class=\"fa fa-gear\"></i> <b>$SysRtl_Btn_Backup_Executar</b></a>";

unset($PERMISSAO_);
// -------------------- EXIBIÇÃO DO FORMULARIO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_SISTEMA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Backup_Consultar_Conteudo_Titulo</h3>
      
      <div class=\"btn-group pull-right\">
        $btn_excluir
        $btn_desativar
        $btn_ativar
        $btn_editar
        $btn_novo
        $btn_pesquisar
        $btn_backup_executar
      </div>
      
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_CONSULTAR\" name=\"FORM_SISTEMA_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_BACKUP_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_NOME</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_NOME</b>
          </div>
        </div>
<div class=\"form-group\">
          <label for=\"TXT_BACKUP_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_TIPO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_TIPO</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_ORIGEM\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_ORIGEM</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_ORIGEM</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DESTINO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DESTINO</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_DESTINO</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DATABASENAME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DATABASENAME</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_DATABASENAME</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_USUARIO_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_USUARIO_DB</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_USUARIO_DB</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_SENHA_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_SENHA_DB</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_SENHA_DB</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_COMPACTAR\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_COMPACTAR</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_COMPACTAR</b>
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_PARAMETROS\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_PARAMETROS</label>
          <div class=\"col-sm-9\">
           <b class=\"form-control\">$VAR_BACKUP_PARAMETROS</b>
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
  LBL_TITULO.innerText='$SysRtl_Backup_Consultar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Backup_Consultar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Backup_Consultar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Backup_Consultar_Cabecalho_Icone\"></i> $SysRtl_Backup_Consultar_Cabecalho_Titulo</a>';
</script>";
?>