<?php
/**
 * 📄 padrao.pesquisar.layout.php - Formulário de pesquisa com tabela de dados
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados
$EntidadeCampos = $EntidadePadraoCampos;
$VAR_PADRAO_LISTAR = isset($this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS']) ? $this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'] : null;
$VAR_DADOS_PESQUISA = $VAR_PADRAO_LISTAR;

// 🔒 Permissões
$PERMISSAO_ = new permissao($this->SISTEMA_);
$tmpPermissaoConsulta = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'CONSULTAR');

$btn_novo = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'INCLUIR') ?
  "<a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-file-o\"></i></a>" : "";

$tmpMostrarInativos = 
  ($PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'ATIVAR') ||
   $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'DESATIVAR')) ?
  "<h6><input type=\"checkbox\" name=\"TXT_REGISTROS_INATIVOS\">Inativos</h6>" : "";

unset($PERMISSAO_);

// 📦 Exibição do Layout
$this->SISTEMA_['SAIDA']['EXIBIR'] = "
<div class=\"col-md-12\">
  <div class=\"box box-$SistemaLayoutCor\">
    <div class=\"box-header\">
      <h3 class=\"box-title\">$SysRtl_Padrao_Pesquisar_Conteudo_Titulo</h3>
      <div class=\"btn-group pull-right\">$btn_novo</div>
    </div>
    <div class=\"box-body\">
      <form class=\"form-horizontal\" method=\"post\" id=\"FORM_PADRAO_PESQUISAR\">
        <input type=\"hidden\" name=\"SysEntidade\" value=\"PADRAO\">
        <input type=\"hidden\" name=\"SysEntidadeAcao\" value=\"PESQUISAR\">
        <div class=\"form-group\">
          <div class=\"col-sm-2\">
            <select class=\"form-control\" name=\"TXT_PESQUISA_CAMPO\" onChange=\"BTN_PESQUISAR.click()\">";
foreach ($EntidadeCampos as $tmpCampos) {
  if ($tmpCampos['PESQUISAR']) {
    $tmpExibir = "SysRtl_Padrao_Campos_" . $tmpCampos['NOME'];
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<option value=\"" . $tmpCampos['NOME'] . "\">" . $$tmpExibir . "</option>";
  }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
            </select>
          </div>
          <div class=\"col-sm-8\">
            <div class=\"input-group input-group-sm\">
              <input type=\"text\" class=\"form-control\" name=\"TXT_PADRAO_PESQUISAR\">
              <span class=\"input-group-btn\">
                <a class=\"btn btn-sm btn-$SistemaLayoutCor\"><i class=\"fa fa-search\"></i></a>
                $tmpMostrarInativos
              </span>
            </div>
          </div>
        </div>
      </form>
      <table class=\"table table-hover\">
        <thead>
          <tr>";
foreach ($EntidadeCampos as $tmpCampos) {
  if ($tmpCampos['EXIBIR']) {
    $tmpExibir = "SysRtl_Padrao_Campos_" . $tmpCampos['NOME'];
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>" . $$tmpExibir . "</th>";
  }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
          </tr>
        </thead>
        <tbody>";
if (!empty($VAR_DADOS_PESQUISA)) {
  $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "DATACRIACAO", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], "data");
  foreach ($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS) {
    $tmpStatusREG_ATIVO_stilo = $VAR_LISTAR_DADOS['REG_ATIVO'] == 1 ? "" : "class=\"text-$SistemaLayoutRegInativoCor\"";
    $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<tr $tmpStatusREG_ATIVO_stilo>";
    foreach ($EntidadeCampos as $tmpCampos) {
      if ($tmpCampos['EXIBIR']) {
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<td>" . $VAR_LISTAR_DADOS[$tmpCampos['NOME']] . "</td>";
      }
    }
    $this->SISTEMA_['SAIDA']['EXIBIR'] .= "</tr>";
  }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
        </tbody>
      </table>
    </div>
  </div>
</div>";

// 📜 JavaScript
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "
<script>
  LBL_TITULO.innerText = '$SysRtl_Padrao_Pesquisar_Cabecalho_Titulo';
  LBL_SUBTITULO.innerText = '$SysRtl_Padrao_Pesquisar_Cabecalho_Subtitulo';
  LBL_SUBTITULO_LOCAL.innerText = '$SysRtl_Padrao_Pesquisar_Cabecalho_Subtitulo';
  LBL_ARVORE_LOCAL.innerHTML = '<a><i class=\"fa $SysRtl_Padrao_Pesquisar_Cabecalho_Icone\"></i> $SysRtl_Padrao_Pesquisar_Cabecalho_Titulo</a>';
</script>";
?>
