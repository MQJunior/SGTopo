<?php
/**
 * @file padrao.pesquisar.layout.php
 * @name padrao.pesquisar
 * @desc
 *   Formul�rio de pesquisa com tabela de dados
 *
 * @author     M�rcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, M�rcio Queiroz Jr.
 * @package    padrao
 * @subpackage Layout
 * @todo       
 *   Descricao todo
 *
 * @date 2018-02-22  v. 0.0.0
 *
 */


/* // -------------------- PERMISSAO -----------------// */
$PERMISSAO_ = new permissao($this->SISTEMA_);
/* Permiss�o para Consultar */
$tmpPermissaoConsulta = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'CONSULTAR');

$tmpLogAtividade = "<i class=\"fa fa-info-circle\"></i>";

/* Permiss�o para Incluir um novo Registro */
$btn_novo = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'INCLUIR'))
  $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";


/* Permiss�o para pesquisar os registros inativos */
$tmpMostrarInativos = "";
if (
  ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'ATIVAR'))
  ||
  ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'DESATIVAR'))
)
  $tmpMostrarInativos = "<h6>
                  <input type=\"checkbox\"  name=\"TXT_REGISTROS_INATIVOS\" id=\"TXT_REGISTROS_INATIVOS\" >Inativos
                </h6>";

unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//

/* Layout do Formul�rio Pesquisar */
$this->SISTEMA_['SAIDA']['EXIBIR'] =
  "   <div class=\"col-md-12\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">$SysRtl_Padrao_Pesquisar_Conteudo_Titulo</h3>
          <div class=\"btn-group pull-right\">
            $btn_novo
          </div>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PADRAO_PESQUISAR\" name=\"FORM_PADRAO_PESQUISAR\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"PESQUISAR\">
            <div class=\"form-group\">
              <div class=\"col-sm-1\">

              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" name=\"TXT_PESQUISA_CAMPO\" onChange=\"BTN_PESQUISAR.click()\">";

foreach ($EntidadeCampos as $tmpCampos) {
  if ($tmpCampos['PESQUISAR']) {
    $tmpExibir = "SysRtl_Padrao_Campos_" . $tmpCampos['NOME'];
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"" . $tmpCampos['NOME'] . "\">" . $$tmpExibir . "</option>";
  }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "</select>
              </div>
              <div class=\"col-sm-1\">
                  <select class=\"form-control\" name=\"TXT_REGISTROS_QUANTIDADE\" onChange=\"BTN_PESQUISAR.click()\">
                    <option value=\"0\">Todos</option>
                    <option value=\"20\">20</option>
                    <option value=\"50\">50</option>
                    <option value=\"100\">100</option>
                  </select>
              </div>
              
              <div class=\"col-sm-8\">
              
                <div class=\"input-group input-group-sm\">
                  
                  <input type=\"text\" class=\"form-control\" name=\"TXT_PADRAO_PESQUISAR\" ID=\"TXT_PADRAO_PESQUISAR\">
                  <span class=\"input-group-btn\">
                    <a href=\"javascript::;\" name=\"BTN_PESQUISAR\" id=\"BTN_PESQUISAR\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PADRAO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','TABELA_PADRAO_PESQUISAR','FORM_PADRAO_PESQUISAR')\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>
                    
                    $tmpMostrarInativos
                  </span>
                </div>
              </div>
            </div>
          </form>
          
          <div class=\"form-group\">
            <table id=\"TABELA_PADRAO_PESQUISAR\" class=\"table table-hover\" >
              <thead>
                <tr>";
foreach ($EntidadeCampos as $tmpCampos) {
  if ($tmpCampos['EXIBIR']) {
    $tmpExibir = "SysRtl_Padrao_Campos_" . $tmpCampos['NOME'];
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>" . $$tmpExibir . "</th>";
  }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>
              </thead>
              <tbody id=\"TABELA_PADRAO_PESQUISAR_DADOS\">
              ";
/* Formatar o campo DATACRIACAO */
if (!empty($VAR_DADOS_PESQUISA)) {
  $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "DATACRIACAO", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], "data");
  /* Formatar o campo VALOR */
  $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "VALOR", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['MOEDA_SIMBOLO'], "moeda");


  foreach ($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS) {
    if ($VAR_LISTAR_DADOS['REG_ATIVO'] == 1) {
      $tmpStatusREG_ATIVO_stilo = "";
    } else {
      $tmpStatusREG_ATIVO_stilo = "class=\"text-$SistemaLayoutRegInativoCor\"";
    }
    $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
    if ($tmpPermissaoConsulta)
      $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
    else
      $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo>";
    foreach ($EntidadeCampos as $tmpCampos)
      if ($tmpCampos['EXIBIR']) {
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<td>" . $VAR_LISTAR_DADOS[$tmpCampos['NOME']] . "</td>";
      }

    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>";
  }
}

$this->SISTEMA_['SAIDA']['EXIBIR'] .= "</tbody>
                
            </table>
          </div> <!-- fim da tabela -->
        </div>
      </div>
    </div>
";

/* Layout JavaScript para manipula��o do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Padrao_Pesquisar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Padrao_Pesquisar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Padrao_Pesquisar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Padrao_Pesquisar_Cabecalho_Icone\"></i> $SysRtl_Padrao_Pesquisar_Cabecalho_Titulo</a>';
</script>";

?>