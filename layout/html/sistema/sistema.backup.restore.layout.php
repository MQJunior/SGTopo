<?php
/**
* @file sistema.backup.restore.layout.php
* @name sistema.backup.restore
* @desc
*   Formulário de pesquisa com tabela de dados
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema.backupRestore
* @subpackage Layout
* @todo       
*   Descricao todo
*
* @date 2018-04-02  v. 0.0.0
*
*/
$EntidadeCampos = $EntidadeBackupCampos;
(isset($this->SISTEMA_['ENTIDADE']['BACKUP']['DADOS']))?$VAR_SISTEMA_LISTAR = $this->SISTEMA_['ENTIDADE']['BACKUP']['DADOS']:$VAR_SISTEMA_LISTAR = null;

$VAR_DADOS_PESQUISA =$VAR_SISTEMA_LISTAR;

/* // -------------------- PERMISSAO -----------------// */
$PERMISSAO_ = new permissao($this->SISTEMA_);
/* Permissão para Consultar */
$tmpPermissaoConsulta=$PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_CONSULTAR');

$tmpLogAtividade="<i class=\"fa fa-info-circle\"></i>";            

/* Permissão para Incluir um novo Registro */
$btn_novo = "";
if($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'BACKUP_INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
 

/* Permissão para pesquisar os registros inativos */
$tmpMostrarInativos="";
if(
  ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'ATIVAR'))
    ||
  ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SISTEMA', 'DESATIVAR'))  
)
  $tmpMostrarInativos="<h6>
                  <input type=\"checkbox\"  name=\"TXT_REGISTROS_INATIVOS\" id=\"TXT_REGISTROS_INATIVOS\" >Inativos
                </h6>";
                
unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//

/* Layout do Formulário Pesquisar */
$this->SISTEMA_['SAIDA']['EXIBIR'] = 
"   <div class=\"col-md-12\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">$SysRtl_Backup_Pesquisar_Conteudo_Titulo</h3>
          <div class=\"btn-group pull-right\">
            $btn_novo
          </div>
        </div>
        <div class=\"box-body\">
          <div class=\"form-group\">
            <table id=\"TABELA_SISTEMA_PESQUISAR\" class=\"table table-hover\" >
              <thead>
                <tr>";
                foreach($EntidadeCampos as $tmpCampos){
                  if($tmpCampos['EXIBIR']){
                    $tmpExibir= "SysRtl_Backup_Campos_".$tmpCampos['NOME'];
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>".$$tmpExibir."</th>";
                  }
                }
              $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>
              </thead>
              <tbody id=\"TABELA_SISTEMA_PESQUISAR_DADOS\">
              ";
              if(!empty($VAR_DADOS_PESQUISA)){
              /* Formatar o campo DATACRIACAO */
                $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATACRIACAO",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
                
                foreach($SysOpt_Backup_TIPO['OPCOES'] as $tmpTIPO)
                  $tmpOptVAR_TIPO[$tmpTIPO['VALOR']]=$tmpTIPO['LEGENDA'];
                
                
                foreach($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS){
                  if($VAR_LISTAR_DADOS['REG_ATIVO']==1){
                    $tmpStatusREG_ATIVO_stilo="";
                  }else{
                    $tmpStatusREG_ATIVO_stilo="class=\"text-$SistemaLayoutRegInativoCor\"";
                  }
                  $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
                  if($tmpPermissaoConsulta)
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=SISTEMA&SysEntidadeAcao=BACKUP_CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
                  else
                    $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo>";
                  foreach($EntidadeCampos as $tmpCampos)
                    if($tmpCampos['EXIBIR']){
                      if($tmpCampos['NOME']=='TIPO')
                        $VAR_LISTAR_DADOS[$tmpCampos['NOME']] = $tmpOptVAR_TIPO[$VAR_LISTAR_DADOS[$tmpCampos['NOME']]];
                      $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<td>".$VAR_LISTAR_DADOS[$tmpCampos['NOME']]."</td>";
                    }

                  $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>";
                }
              }
                
$this->SISTEMA_['SAIDA']['EXIBIR'] .="</tbody>
                
            </table>
          </div> <!-- fim da tabela -->
        </div>
      </div>
    </div>
";

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Backup_Pesquisar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Backup_Pesquisar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Backup_Pesquisar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Backup_Pesquisar_Cabecalho_Icone\"></i> $SysRtl_Backup_Pesquisar_Cabecalho_Titulo</a>';
</script>";

?>