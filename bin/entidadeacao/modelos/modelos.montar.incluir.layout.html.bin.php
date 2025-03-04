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
            <input type=\\\"text\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required >
          </div>
        </div>\n";
      
      if ($tmpcampoDominio=='DATA'){
        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"date\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required>
          </div>
        </div>\n";
      }  
      
      if ($tmpcampoDominio=='ESCOLHA'){
        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"checkbox\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"A\\\" >
          </div>
        </div>\n";
      }
      
      if ($tmpcampoDominio=='VALOR'){
        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <input type=\\\"number\\\" min=\\\"0.00\\\" max=\\\"99999999.99\\\" step=\\\"0.01\\\" class=\\\"form-control\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" placeholder=\\\"\$SysRtl_Padrao_Campos_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" style=\\\"text-align:right\\\" value=\\\"\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required>
          </div>
        </div>\n";
      }
      
      if ($tmpcampoDominio=='TEXTO'){
        $tmpLayoutSaida = "<div class=\\\"form-group\\\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>
          <div class=\\\"col-sm-9\\\">
            <textarea class=\\\"form-control\\\" rows=\\\"5\\\" placeholder=\\\"Descrição\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required ></textarea>
          </div>
        </div>\n";
      }
      
      
      if ($tmpcampoDominio=='TIPO'){
        $tmpLayoutSaida ="<div class=\"form-group\">
          <label for=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" class=\\\"col-sm-2 control-label\\\">\$SysRtl_Padrao_Campos_$tmpcampoUPPER</label>\";
          foreach(\$SysOpt_Padrao_".$tmpcampoUPPER."['OPCOES'] as \$tmpOpcoesTipo){
            \$this->SISTEMA_['SAIDA']['EXIBIR'] .=\"<div class=\"col-sm-3\">
            <label>
              <input type=\\\"radio\\\" id=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" name=\\\"TXT_PADRAO_$tmpcampoUPPER\\\" value=\\\"\\\".\$tmpOpcoesTipo['VALOR'].\\\"\\\" \$TXT_PADRAO_".$tmpcampoUPPER."_required > \".\$tmpOpcoesTipo['LEGENDA'].\"
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