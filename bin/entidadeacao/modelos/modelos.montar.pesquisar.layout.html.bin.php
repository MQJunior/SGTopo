<?php

$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];

$CNXDB_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],
                        $tmpDBConfig['USERNAME'],
                        $tmpDBConfig['PASSWORD'],
                        $tmpDBConfig['DATABASENAME'],
                        $tmpDBConfig['TIPODB']);

$VAR_SISTEMA_TABELAS_CAMPOS = $CNXDB_->ListarCamposTabela($tmpTabelaEntidade);
unset($CNXDB_);

$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO =file_get_contents($Modelos[$VAR_ENTIDADEACAO_ARQUIVO_MODELO]);

$tmpScriptSaida="";
if (is_array($VAR_SISTEMA_TABELAS_CAMPOS)){
  $tmpCamposNao = array('CODIGO', 'SESSAO', 'DATACRIACAO','USUARIO','REG_ATIVO');
  foreach($VAR_SISTEMA_TABELAS_CAMPOS as $tmpCampos){
    if(!in_array($tmpCampos['CAMPO'],$tmpCamposNao)){
      $tmpcampo = $tmpCampos['CAMPO'];
      $tmpcampoUPPER = strtoupper($tmpcampo);
      $tmpcampoLOWER = strtolower($tmpcampo);
      $tmpcampoUC = ucwords(strtolower($tmpcampo));
	  $tmpcampoDominio ="NOME";
	  if (isset($tmpCampos['DOMINIO']))
		$tmpcampoDominio = strtoupper($tmpCampos['DOMINIO']);
      
      if ($tmpcampoDominio=='DATA')  
        $tmpScriptSaida .= "/* Formatar o campo $tmpcampoUPPER */
            \$VAR_DADOS_PESQUISA = FORMATA_DADOS(\$VAR_DADOS_PESQUISA,\"$tmpcampoUPPER\",\$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'],\"data\");\n";
      if ($tmpcampoDominio=='VALOR')  
        $tmpScriptSaida .= "/* Formatar o campo $tmpcampoUPPER */
          \$VAR_DADOS_PESQUISA = FORMATA_DADOS(\$VAR_DADOS_PESQUISA,\"$tmpcampoUPPER\",\$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['MOEDA_SIMBOLO'],\"moeda\");\n";
      
    }
  }
    
}



?>