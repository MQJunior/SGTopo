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
            <input type=\\\"text\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\$VAR_PADRAO_$tmpcampoUPPER\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required >
          </div>
        </div>\n";
      
      if ($tmpcampoDominio=='DATA'){
        $tmpScriptSaidaFormatarCampos .= "/* Formata o campo $tmpcampoUPPER */
\$VAR_PADRAO_$tmpcampoUPPER = FORMATA_CAMPO(\$VAR_PADRAO_$tmpcampoUPPER,'Y-m-d','data');\n";

        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"date\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\$VAR_PADRAO_$tmpcampoUPPER\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required>
          </div>
        </div>\n";
      }  
      
      if ($tmpcampoDominio=='ESCOLHA'){
        $tmpScriptSaidaFormatarCampos .= "/* Tratamento do campo $tmpcampoUPPER */
(\$VAR_PADRAO_$tmpcampoUPPER=='A')?\$tmpEscolhaChecked=\" checked \":\$tmpEscolhaChecked=\"\";\n";

        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"checkbox\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"A\\\" \$tmpEscolhaChecked>
          </div>
        </div>\n";
      }
      
      if ($tmpcampoDominio=='VALOR'){
        $tmpScriptSaidaFormatarCampos .= "/* $tmpcampoUPPER Valor monetário nulo é igual a 0.00 */
(\$VAR_PADRAO_$tmpcampoUPPER==null)?\$VAR_PADRAO_$tmpcampoUPPER='0.00':\$VAR_PADRAO_$tmpcampoUPPER=number_format(\$VAR_PADRAO_$tmpcampoUPPER,2,'.',',');\n";

        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"number\\\" min=\\\"0.00\\\" max=\\\"99999999.99\\\" step=\\\"0.01\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" style=\\\"text-align:right\\\" value=\\\"\$VAR_PADRAO_$tmpcampoUPPER\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required>
          </div>
        </div>\n";
      }
      
      if ($tmpcampoDominio=='TEXTO'){
        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <textarea class=\\\"form-control\\\" rows=\\\"5\\\" placeholder=\\\"Descrição\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required >\$VAR_PADRAO_$tmpcampoUPPER</textarea>
          </div>
        </div>\n";
      }
      
      
      if ($tmpcampoDominio=='TIPO'){
        $tmpLayoutSaida ="<div class=\"form-group\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>\";
          foreach(\$SysOpt_Padrao_".$tmpcampoUPPER."['OPCOES'] as \$tmpOpcoesTipo){
            (\$VAR_PADRAO_$tmpcampoUPPER==\$tmpOpcoesTipo['VALOR'])?\$tmpChecked=\" checked \":\$tmpChecked=\"\";
            \$this->SISTEMA_['SAIDA']['EXIBIR'] .=\"<div class=\"col-sm-3\">
            <label>
              <input type=\\\"radio\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\\\".\$tmpOpcoesTipo['VALOR'].\\\"\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required \$tmpChecked> \".\$tmpOpcoesTipo['LEGENDA'].\"
            </label>
            </div>\";
          }
\$this->SISTEMA_['SAIDA']['EXIBIR'] .=\"        
        </div>\n";
      }
      
      $tmpScriptSaida .=$tmpLayoutSaida;
    }
  }
    
}



?>