<?php
/**
 * 📄 padrao.pesquisa.layout.php - Linhas da tabela de dados da pesquisa
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados
$EntidadeCampos                                                              = $EntidadePadraoCampos;
(isset($this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'])) ? $VAR_PADRAO_LISTAR = $this->SISTEMA_['ENTIDADE']['PADRAO']['DADOS'] : $VAR_PADRAO_LISTAR = null;

$VAR_DADOS_PESQUISA = $VAR_PADRAO_LISTAR;
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para consulta */
$tmpPermissaoConsulta = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'PADRAO', 'CONSULTAR');

unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//
/* Monta as linhas do resultado da pesquisa */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<thead>
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

if (! empty($VAR_DADOS_PESQUISA)) {
    /* Formata a datacriacao na tabela do resultado da pesquisa */
    $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "DATACRIACAO", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], "data");
    /*BUSCAR_NO_BD*/

    foreach ($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS) {
        if ($VAR_LISTAR_DADOS['REG_ATIVO'] == 1) {
            $tmpStatusREG_ATIVO_stilo = "";
        } else {
            $tmpStatusREG_ATIVO_stilo = "class=\"text-$SistemaLayoutRegInativoCor\"";
        }
        $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];

        if ($tmpPermissaoConsulta) {
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
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
