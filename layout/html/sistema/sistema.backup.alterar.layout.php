<?php
/**
* @file sistema.backup.alterar.layout.php
* @name sistema.backup.alterar
* @desc
*   Layout para o formulário de alteração
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-04-05  v. 0.0.0
*
*/


// -------------------- CAPTURA DE DADOS -----------------//
/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeBackupCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

/* Captura as Variaveis que serão exibidas */
foreach ($EntidadeCampos as $tmpValor){
  $tmpVar = "VAR_BACKUP_".$tmpValor['NOME'];
  $$tmpVar = $BackupDados[0][$tmpValor['NOME']];
}

// -------------------- MANIPULAÇÃO -----------------//

/* Formata o campo DATACRIACAO */
$VAR_BAKCUP_DATACRIACAO = FORMATA_CAMPO($VAR_BACKUP_DATACRIACAO,$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');

/* Verifica se o registro foi desativado */
($VAR_BACKUP_REG_ATIVO=='1')?$VAR_BACKUP_REG_ATIVO=true:$VAR_BACKUP_REG_ATIVO=false;


($VAR_BACKUP_COMPACTAR=='S')?$VAR_BACKUP_COMPACTAR_checked='Checked':$VAR_BACKUP_COMPACTAR_checked='';

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para o botão excluir */
$btn_excluir = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'EXCLUIR'))
  $btn_excluir = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=EXCLUIR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_SISTEMA_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-trash-o\"></i> <b>$SysRtl_Btn_Excluir</b></a>";

/* Permissão para o botão desativar */  
$btn_desativar = "";
if($VAR_SISTEMA_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'DESATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=DESATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-unlink\"></i> <b>$SysRtl_Btn_Desativar</b></a>";

/* Permissão para o botão ativar */    
$btn_ativar = "";
if(!$VAR_SISTEMA_REG_ATIVO)
  if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'ATIVAR'))
    $btn_desativar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=ATIVAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-link\"></i> <b>$SysRtl_Btn_Ativar</b></a>";

/* Permissão para o botão novo */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
/* Permissão para o botão pesquisar */  
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_RESTORE'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_RESTORE&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

/* Permissão para o botão consultar */  
$btn_consultar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_CONSULTAR'))
  $btn_consultar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_CONSULTAR&SID=$SistemaSessaoUID&txtChaveRegistro=$VAR_BACKUP_CODIGO','','DIV_CONTEUDO',null)\"><i class=\"fa fa-eye\"></i> <b>$SysRtl_Btn_Consultar</b></a>"; 
  
unset($PERMISSAO_);

// -------------------- EXIBIÇÃO -----------------//

/* Layout do Formulário */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_SISTEMA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Backup_Alterar_Conteudo_Titulo</h3>
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
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_SISTEMA_CONSULTAR\" name=\"FORM_SISTEMA_CONSULTAR\" onSubmit=\"\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"BACKUP_ALTERAR\">
        <input type=\"hidden\" name=\"txtChaveRegistro\" value=\"$VAR_BACKUP_CODIGO\">
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_NOME\" placeholder=\"$SysRtl_Backup_Campos_NOME\" name=\"TXT_BACKUP_NOME\" value=\"$VAR_BACKUP_NOME\" $TXT_BACKUP_NOME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" name=\"TXT_BACKUP_TIPO\" id=\"TXT_BACKUP_TIPO\">";
          
          foreach($SysOpt_Backup_TIPO['OPCOES'] as $tmpOpcoesTipo){
            ($tmpOpcoesTipo['VALOR']==$VAR_BACKUP_TIPO)?$tmpSelected=' Selected':$tmpSelected='';
            $this->SISTEMA_['SAIDA']['EXIBIR'] .="<option value=\"".$tmpOpcoesTipo['VALOR']."\"$tmpSelected>".$tmpOpcoesTipo['LEGENDA']."</option>\n";
          }
$this->SISTEMA_['SAIDA']['EXIBIR'] .="
            </select>
          </div>
        </div>
          
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_ORIGEM\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_ORIGEM</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_ORIGEM\" placeholder=\"$SysRtl_Backup_Campos_ORIGEM\" name=\"TXT_BACKUP_ORIGEM\" value=\"$VAR_BACKUP_ORIGEM\" $TXT_BACKUP_ORIGEM_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DESTINO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DESTINO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_DESTINO\" placeholder=\"$SysRtl_Backup_Campos_DESTINO\" name=\"TXT_BACKUP_DESTINO\" value=\"$VAR_BACKUP_DESTINO\" $TXT_BACKUP_DESTINO_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DATABASENAME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DATABASENAME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_DATABASENAME\" placeholder=\"$SysRtl_Backup_Campos_DATABASENAME\" name=\"TXT_BACKUP_DATABASENAME\" value=\"$VAR_BACKUP_DATABASENAME\" $TXT_BACKUP_DATABASENAME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_USUARIO_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_USUARIO_DB</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_USUARIO_DB\" placeholder=\"$SysRtl_Backup_Campos_USUARIO_DB\" name=\"TXT_BACKUP_USUARIO_DB\" value=\"$VAR_BACKUP_USUARIO_DB\" $TXT_BACKUP_USUARIO_DB_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_SENHA_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_SENHA_DB</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_SENHA_DB\" placeholder=\"$SysRtl_Backup_Campos_SENHA_DB\" name=\"TXT_BACKUP_SENHA_DB\" value=\"$VAR_BACKUP_SENHA_DB\" $TXT_BACKUP_SENHA_DB_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_COMPACTAR\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_COMPACTAR</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_BACKUP_COMPACTAR\" name=\"TXT_BACKUP_COMPACTAR\" value=\"S\" $VAR_BACKUP_COMPACTAR_checked>
          </div>
        </div>
        
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_PARAMETROS\" class=\"col-sm-2 control-label\">Parametros</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"Parametros\" id=\"TXT_BACKUP_PARAMETROS\" name=\"TXT_BACKUP_PARAMETROS\">$VAR_BACKUP_PARAMETROS</textarea>
          </div>
        </div>
        
        <div class=\"form-group\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <a href=\"javascript::;\" class=\"btn btn-$SistemaLayoutCor pull-left\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO','FORM_SISTEMA_CONSULTAR')\"><i class=\"fa fa-floppy-o\"></i> <b>$SysRtl_Btn_Salvar</b></a>
          </div>
        </div>
        
        
       
        
        <div class=\"box-footer\">
          <div class=\"col-sm-offset-5 col-sm-7\">
            <h6 class=\"text-muted\"><i class=\"fa fa-info-circle\"></i> <i>$SysRtl_Backup_Campos_USUARIO_NOME:</i><b> $VAR_BACKUP_USUARIO_NOME</b> - <i>$SysRtl_Backup_Campos_DATACRIACAO:</i><b> $VAR_BACKUP_DATACRIACAO</b></h6>
          </div>
        </div>
      </form>        
    </div>
  </div>
</div>";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Backup_Alterar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Backup_Alterar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Backup_Alterar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Backup_Alterar_Cabecalho_Icone\"></i> $SysRtl_Backup_Alterar_Cabecalho_Titulo</a>';
</script>";

?>