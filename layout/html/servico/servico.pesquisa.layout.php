<?php
/**
 * 📄 servico.pesquisa.layout.php - Linhas da tabela de dados da pesquisa
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: servico | 📂 Subpacote: Layout
 */

// 📝 Captura de Dados
$EntidadeCampos                                                              = $EntidadeServicoCampos;
(isset($this->SISTEMA_['ENTIDADE']['SERVICO']['DADOS'])) ? $VAR_SERVICO_LISTAR = $this->SISTEMA_['ENTIDADE']['SERVICO']['DADOS'] : $VAR_SERVICO_LISTAR = null;

$VAR_DADOS_PESQUISA = $VAR_SERVICO_LISTAR;
// -------------------- PERMISSAO -----------------//
$PERMISSAO_ = new permissao($this->SISTEMA_);

/* Permissão para consulta */
$tmpPermissaoConsulta = $PERMISSAO_->ChecarPermissao($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'], 'SERVICO', 'CONSULTAR');

unset($PERMISSAO_);
// -------------------- PERMISSAO -----------------//
/* Monta as linhas do resultado da pesquisa */
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "<thead>
                <tr>";
foreach ($EntidadeCampos as $tmpCampos) {
    if ($tmpCampos['EXIBIR']) {
        $tmpExibir = "SysRtl_Servico_Campos_" . $tmpCampos['NOME'];
        $this->SISTEMA_['SAIDA']['EXIBIR'] .= "<th>" . $$tmpExibir . "</th>";
    }
}
$this->SISTEMA_['SAIDA']['EXIBIR'] .= "                </tr>
              </thead>
              <tbody id=\"TABELA_SERVICO_PESQUISAR_DADOS\">
              ";

if (! empty($VAR_DADOS_PESQUISA)) {
    /* Formata a datacriacao na tabela do resultado da pesquisa */
    $VAR_DADOS_PESQUISA = FORMATA_DADOS($VAR_DADOS_PESQUISA, "DATACRIACAO", $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'], "data");
    

    foreach ($VAR_DADOS_PESQUISA as $VAR_LISTAR_DADOS) {
        if ($VAR_LISTAR_DADOS['REG_ATIVO'] == 1) {
            $tmpStatusREG_ATIVO_stilo = "";
        } else {
            $tmpStatusREG_ATIVO_stilo = "class=\"text-$SistemaLayoutRegInativoCor\"";
        }
        $tmpCODIGO = $VAR_LISTAR_DADOS['CODIGO'];

        if ($tmpPermissaoConsulta) {
            $this->SISTEMA_['SAIDA']['EXIBIR'] .= " <tr $tmpStatusREG_ATIVO_stilo style=\"cursor:pointer\" onclick=\"PesquisaDados('.?XMLHTML=true&SID=$SistemaSessaoUID&SysEntidade=SERVICO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=$tmpCODIGO','','DIV_CONTEUDO',null)\">";
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
