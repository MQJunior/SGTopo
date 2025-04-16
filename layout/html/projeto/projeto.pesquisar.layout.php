<?php
/**
 * 📄 projeto.pesquisar.layout.php - Formulário de pesquisa com tabela de dados
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados
$EntidadeCampos                                                              = $EntidadeProjetoCampos;
(isset($this->SISTEMA_['ENTIDADE']['PROJETO']['DADOS'])) ? $VAR_PROJETO_LISTAR = $this->SISTEMA_['ENTIDADE']['PROJETO']['DADOS'] : $VAR_PROJETO_LISTAR = null;

$VAR_DADOS_PESQUISA = $VAR_PROJETO_LISTAR;

// 🔒 Permissões
$PERMISSAO_           = new permissao($this->SISTEMA_);
$tmpPermissaoConsulta = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'CONSULTAR');

$btn_novo = "";
if ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'INCLUIR')) {
    $btn_novo = "<a href=\"javascript::;\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=INCLUIR&SID=$SistemaSessaoUID','','DIV_CONTEUDO',null)\"><i class=\"fa fa-file-o\"></i> <b>$SysRtl_Btn_Novo</b></a>";
}

$tmpMostrarInativos = "";
if (
    ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'ATIVAR'))
    ||
    ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PROJETO', 'DESATIVAR'))
) {
    $tmpMostrarInativos = "<h6>
                  <input type=\"checkbox\"  name=\"TXT_REGISTROS_INATIVOS\" id=\"TXT_REGISTROS_INATIVOS\" >Inativos
                </h6>";
}

unset($PERMISSAO_);

// 📦 Exibição do Layout
$this->SISTEMA_['SAIDA']['EXIBIR'] =
    "   <div class=\"col-md-12\">
      <div class=\"box box-$SistemaLayoutCor\">
        <div class=\"box-header\">
          <h3 class=\"box-title\">$SysRtl_Projeto_Pesquisar_Conteudo_Titulo</h3>
          <div class=\"btn-group pull-right\">
            $btn_novo
          </div>
        </div>
        <div class=\"box-body\">
          <form class=\"form-horizontal\" method=\"post\" action=\"javascript::;\" id=\"FORM_PROJETO_PESQUISAR\" name=\"FORM_PROJETO_PESQUISAR\" >
            <input type=\"hidden\" name=\"SysEntidade\" value=\"PROJETO\">
            <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"PESQUISAR\">
            <div class=\"form-group\">
              <div class=\"col-sm-1\">

              </div>
              <div class=\"col-sm-2\">
                <select class=\"form-control\" name=\"TXT_PESQUISA_CAMPO\" onChange=\"BTN_PESQUISAR.click()\">";

foreach ($EntidadeCampos as $tmpCampos) {
    if ($tmpCampos['PESQUISAR']) {
        $tmpExibir = "SysRtl_Projeto_Campos_" . $tmpCampos['NOME'];
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

                  <input type=\"text\" class=\"form-control\" name=\"TXT_PROJETO_PESQUISAR\" ID=\"TXT_PROJETO_PESQUISAR\">
                  <span class=\"input-group-btn\">
                    <a href=\"javascript::;\" name=\"BTN_PESQUISAR\" id=\"BTN_PESQUISAR\" class=\"btn btn-sm btn-$SistemaLayoutCor\" onclick=\"PesquisaDados('.?XMLHTML=true&SysEntidade=PROJETO&SysEntidadeAcao=PESQUISAR&SID=$SistemaSessaoUID','','TABELA_PROJETO_PESQUISAR','FORM_PROJETO_PESQUISAR')\"><i class=\"fa fa-search\"></i> <b>$SysRtl_Btn_Pesquisar</b></a>

                    $tmpMostrarInativos
                  </span>
                </div>
              </div>
            </div>
          </form>

          <div class=\"form-group\">
            <table id=\"TABELA_PROJETO_PESQUISAR\" class=\"table table-hover\" >
              <thead>
                <tr>";
foreach ($EntidadeCampos as $tmpCampos) {
    if ($tmpCampos['EXIBIR']) {
        $tmpExibir = "SysRtl_Projeto_Campos_" . $tmpCampos['NOME'];
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>" . $$tmpExibir . "</th>";
    }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>
              </thead>
              <tbody id=\"TABELA_PROJETO_PESQUISAR_DADOS\">
              ";
if (! empty($VAR_DADOS_PESQUISA)) {
    /* Formatar o campo DATACRIACAO */
    $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "DATACRIACAO", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], "data");
    /* Formatar o campo DATA_INICIO */
            $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATA_INICIO",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");
/* Formatar o campo DATA_FIM */
            $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA,"DATA_FIM",$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],"data");


    foreach ($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS) {
        if ($VAR_LISTAR_DADOS['REG_ATIVO'] == 1) {
            $tmpStatusREG_ATIVO_stilo = "";
        } else {
            $tmpStatusREG_ATIVO_stilo = "class=\"text-$SistemaLayoutRegInativoCor\"";
        }
        $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
        if ($tmpPermissaoConsulta) {
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=PROJETO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
        } else {
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo>";
        }

        foreach ($EntidadeCampos as $tmpCampos) {
            if ($tmpCampos['EXIBIR']) {
                $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<td>" . $VAR_LISTAR_DADOS[$tmpCampos['NOME']] . "</td>";
            }
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

/* Layout JavaScript para manipulação do Layout */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script language=\"text/javascript\">
  LBL_TITULO.innerText='$SysRtl_Projeto_Pesquisar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText='$SysRtl_Projeto_Pesquisar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText='$SysRtl_Projeto_Pesquisar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML ='<a href=\"javascript::;\"><i class=\"fa $SysRtl_Projeto_Pesquisar_Cabecalho_Icone\"></i> $SysRtl_Projeto_Pesquisar_Cabecalho_Titulo</a>';
</script>";
