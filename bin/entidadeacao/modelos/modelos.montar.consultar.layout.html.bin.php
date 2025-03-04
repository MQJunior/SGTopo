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

$tmpScriptSaidaFormatarCampos ="";
$tmpLayoutSaida ="";
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
      
      $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
           <b class=\\\"form-control\\\">\$VAR_PADRAO_$tmpcampoUPPER</b>
          </div>
        </div>\n";
      
      if ($tmpcampoDominio=='DATA'){
        $tmpScriptSaidaFormatarCampos .= "/* Formata o campo $tmpcampoUPPER */
\$VAR_PADRAO_$tmpcampoUPPER = FORMATA_CAMPO(\$VAR_PADRAO_$tmpcampoUPPER,\$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_EXIBICAO_FORMATO'],'data');\n";

      }  
      
      if ($tmpcampoDominio=='ESCOLHA'){
        $tmpScriptSaidaFormatarCampos .= "/* Tratamento do campo $tmpcampoUPPER */
(\$VAR_PADRAO_$tmpcampoUPPER=='A')?\$tmpEscolhaChecked=\" checked \":\$tmpEscolhaChecked=\"\";\n";
      }
      
      if ($tmpcampoDominio=='VALOR'){
        $tmpScriptSaidaFormatarCampos .= "/* $tmpcampoUPPER Valor monetário nulo é igual a 0.00 */
(\$VAR_PADRAO_$tmpcampoUPPER==null)?\$VAR_PADRAO_$tmpcampoUPPER='0.00':\$VAR_PADRAO_$tmpcampoUPPER=number_format(\$VAR_PADRAO_$tmpcampoUPPER,2,'.',',');\n";
      }
      
      $tmpScriptSaida .=$tmpLayoutSaida;
    }
  }
    
}



?>