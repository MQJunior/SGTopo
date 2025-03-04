<?php
/**
* @file sistema.backup.incluir.layout.php
* @name sistema.backup.incluir
* @desc
*   Layout para o formulário de inclusão
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

/* Verifica os campos obrigatórios e seta-se os mesmo como required */
$EntidadeCampos = $EntidadeBackupCampos;
foreach($EntidadeCampos as $tmpCampo => $tmpInfoCampos){
  $tmpRequired = $tmpCampo."_required";
  ($tmpInfoCampos['REQUERIDO'])?$$tmpRequired ="required":$$tmpRequired ="";
}

// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para pesquisar os Dados */
$btn_pesquisar = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_RESTORE'))
  $btn_pesquisar = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_RESTORE&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>";

unset($PERMISSAO_);

/* -------------------- Layout do Formulário ----------------- */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<div class=\"col-md-8 col-sm-offset-2\">
  <div class=\"box box-$SistemaLayoutCor\" id=\"DIV_FORM_SISTEMA\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">$SysRtl_Backup_Incluir_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">
        $btn_pesquisar
      </div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_BACKUP_INCLUIR\" name=\"FORM_BACKUP_INCLUIR\" onSubmit=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID','','DIV_CONTEUDO',this.name)\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"SISTEMA\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"BACKUP_INCLUIR\">
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_NOME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_NOME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_NOME\" placeholder=\"$SysRtl_Backup_Campos_NOME\" name=\"TXT_BACKUP_NOME\" value=\"\" $TXT_BACKUP_NOME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_TIPO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_TIPO</label>
          <div class=\"col-sm-9\">
            <select class=\"form-control\" name=\"TXT_BACKUP_TIPO\" id=\"TXT_BACKUP_TIPO\">";
          
          foreach($SysOpt_Backup_TIPO['OPCOES'] as $tmpOpcoesTipo)
            $this->SISTEMA_['SAIDA']['EXIBIR'] .="<option value=\"".$tmpOpcoesTipo['VALOR']."\">".$tmpOpcoesTipo['LEGENDA']."</option>\n";

$this->SISTEMA_['SAIDA']['EXIBIR'] .="
            </select>
          </div>
        </div>
          
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_ORIGEM\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_ORIGEM</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_ORIGEM\" placeholder=\"$SysRtl_Backup_Campos_ORIGEM\" name=\"TXT_BACKUP_ORIGEM\" value=\"\" $TXT_BACKUP_ORIGEM_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DESTINO\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DESTINO</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_DESTINO\" placeholder=\"$SysRtl_Backup_Campos_DESTINO\" name=\"TXT_BACKUP_DESTINO\" value=\"\" $TXT_BACKUP_DESTINO_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_DATABASENAME\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_DATABASENAME</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_DATABASENAME\" placeholder=\"$SysRtl_Backup_Campos_DATABASENAME\" name=\"TXT_BACKUP_DATABASENAME\" value=\"\" $TXT_BACKUP_DATABASENAME_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_USUARIO_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_USUARIO_DB</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_USUARIO_DB\" placeholder=\"$SysRtl_Backup_Campos_USUARIO_DB\" name=\"TXT_BACKUP_USUARIO_DB\" value=\"\" $TXT_BACKUP_USUARIO_DB_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_SENHA_DB\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_SENHA_DB</label>
          <div class=\"col-sm-9\">
            <input type=\"text\" class=\"form-control\" id=\"TXT_BACKUP_SENHA_DB\" placeholder=\"$SysRtl_Backup_Campos_SENHA_DB\" name=\"TXT_BACKUP_SENHA_DB\" value=\"\" $TXT_BACKUP_SENHA_DB_required >
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_COMPACTAR\" class=\"col-sm-2 control-label\">$SysRtl_Backup_Campos_COMPACTAR</label>
          <div class=\"col-sm-9\">
            <input type=\"checkbox\" id=\"TXT_BACKUP_COMPACTAR\" name=\"TXT_BACKUP_COMPACTAR\" value=\"S\">
          </div>
        </div>
        <div class=\"form-group\">
          <label for=\"TXT_BACKUP_PARAMETROS\" class=\"col-sm-2 control-label\">Parametros</label>
          <div class=\"col-sm-9\">
            <textarea class=\"form-control\" rows=\"5\" placeholder=\"Parametros\" id=\"TXT_BACKUP_PARAMETROS\" name=\"TXT_BACKUP_PARAMETROS\"></textarea>
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
  LBL_TITULO.innerText='$SysRtl_Backup_Incluir_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Backup_Incluir_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Backup_Incluir_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Backup_Incluir_Cabecalho_Icone\"></i> $SysRtl_Backup_Incluir_Cabecalho_Titulo</a>';
</script>";

?>