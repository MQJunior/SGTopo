<?php
/**
* @file entidadeacao.importar.modelo.bin.php
* @name entidadeacao.importar.modelo
* @desc
*   Importa um modelo para criar arquivos
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    EntidadeAcao
* @subpackage bin
* @todo       
*
*
* @date 2018-03-01  v. 0.0.0
*/

$DOMINIOS['CODIGO_LINK']['TAMANHO']='0';
$DOMINIOS['DATA']['TAMANHO']='20';
$DOMINIOS['DESCRICAO']['TAMANHO']='150';
$DOMINIOS['ESCOLHA']['TAMANHO']='1';
$DOMINIOS['NOME']['TAMANHO']='100';
$DOMINIOS['NOME_CURTO']['TAMANHO']='20';
$DOMINIOS['NOME_TEXTO']['TAMANHO']='500';
$DOMINIOS['TEMPO']['TAMANHO']='8';
$DOMINIOS['TIPO']['TAMANHO']='1';



$Modelos['0']="";
$Modelos['LIB_PADRAO']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/class.padrao.lib.php";
$Modelos['CONF_PADRAO']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.conf.php";
$Modelos['DEF_PADRAO']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.def.php";
$Modelos['DEF_PADRAO_IDIOMA']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.idioma.brasil.def.php";
$Modelos['BIN_PADRAO_ALTERAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.alterar.bin.php";
$Modelos['BIN_PADRAO_ATIVAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.ativar.bin.php";
$Modelos['BIN_PADRAO_CONSULTAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.consultar.bin.php";
$Modelos['BIN_PADRAO_DESATIVAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.desativar.bin.php";
$Modelos['BIN_PADRAO_EXCLUIR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.excluir.bin.php";
$Modelos['BIN_PADRAO_INCLUIR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.incluir.bin.php";
$Modelos['BIN_PADRAO_PESQUISAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.pesquisar.bin.php";
$Modelos['LAYOUT_HTML_PADRAO_PESQUISAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.pesquisar.layout.html.php";
$Modelos['LAYOUT_HTML_PADRAO_PESQUISA']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.pesquisa.layout.html.php";
$Modelos['LAYOUT_HTML_PADRAO_ALTERAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.alterar.layout.html.php";
$Modelos['LAYOUT_HTML_PADRAO_INCLUIR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.incluir.layout.html.php";
$Modelos['LAYOUT_HTML_PADRAO_CONSULTAR']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/padrao.consultar.layout.html.php";



if(isset($_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_MODELO'])){
  
  @$VAR_ENTIDADEACAO_ARQUIVO_NOME = end(explode('/',$_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_NOME']));
     
  $VAR_ENTIDADEACAO_ENTIDADE_NOME = explode('.',$VAR_ENTIDADEACAO_ARQUIVO_NOME);
  if($VAR_ENTIDADEACAO_ENTIDADE_NOME[0]=='class')
    $VAR_ENTIDADEACAO_ENTIDADE_NOME = $VAR_ENTIDADEACAO_ENTIDADE_NOME[1];
  else  
    $VAR_ENTIDADEACAO_ENTIDADE_NOME = $VAR_ENTIDADEACAO_ENTIDADE_NOME[0];
    
  $ENTIDADEACAO_ = new EntidadeAcao($this->SISTEMA_);
    $tmpEntidade = strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME);
    $ENTIDADEACAO_->ConsultarEntidade($tmpEntidade);
    $this->SISTEMA_ = $ENTIDADEACAO_->getSISTEMA();
    $tmpTabelaEntidade =   $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['TABELA'];
  unset($ENTIDADEACAO_);
    
    
  
  $VAR_ENTIDADEACAO_ARQUIVO_MODELO = $_REQUEST['TXT_ENTIDADEACAO_ARQUIVO_MODELO'];
  if($VAR_ENTIDADEACAO_ARQUIVO_MODELO != "0")
    $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO =file_get_contents($Modelos[$VAR_ENTIDADEACAO_ARQUIVO_MODELO]);
  else
    $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO ="";

  if($VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO !=""){
    /* CLASSE */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LIB_PADRAO'){
      /* Substituir Estes */
      $tmpLIB_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLIB_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLIB_replace,$tmpLIB_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    /* CONF */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='CONF_PADRAO'){
      /* Substituir Estes */
      $tmpCONF_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpCONF_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpCONF_replace,$tmpCONF_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    /* LER OS CAMPOS DA TABELA NO BANCO DE DADOS */
    
    /* DEF */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='DEF_PADRAO'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.def.bin.php");
      $tmpDEF_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpDEF_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpDEF_replace,$tmpDEF_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    /* DEF IDIOMA */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='DEF_PADRAO_IDIOMA'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpDEF_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpDEF_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpDEF_replace,$tmpDEF_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }

    /* BIN ALTERAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_ALTERAR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_ALTERAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_ALTERAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_ALTERAR_replace,$tmpBIN_ALTERAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }    

    /* BIN ATIVAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_ATIVAR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_ATIVAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_ATIVAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_ATIVAR_replace,$tmpBIN_ATIVAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }      
 
    /* BIN CONSULTAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_CONSULTAR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_CONSULTAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_CONSULTAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_CONSULTAR_replace,$tmpBIN_CONSULTAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    /* BIN DESATIVAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_DESATIVAR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_DESATIVAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_DESATIVAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_DESATIVAR_replace,$tmpBIN_DESATIVAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }    

    /* BIN EXCLUIR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_EXCLUIR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_EXCLUIR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_EXCLUIR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_EXCLUIR_replace,$tmpBIN_EXCLUIR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }      

    /* BIN INCLUIR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_INCLUIR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_INCLUIR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_INCLUIR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_INCLUIR_replace,$tmpBIN_INCLUIR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }  
    
    /* BIN PESQUISAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='BIN_PADRAO_PESQUISAR'){
      /* Substituir Estes */
      
      //include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.defIdioma.bin.php");
      $tmpBIN_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpBIN_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpBIN_PESQUISAR_replace,$tmpBIN_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }

    /* LAYOUT HTML PESQUISAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LAYOUT_HTML_PADRAO_PESQUISAR'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.pesquisar.layout.html.bin.php");
      $tmpLAYOUT_HTML_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLAYOUT_HTML_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*BUSCAR_NO_BD*/',$tmpScriptSaida,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLAYOUT_HTML_PESQUISAR_replace,$tmpLAYOUT_HTML_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
        /* LAYOUT HTML PESQUISA */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LAYOUT_HTML_PADRAO_PESQUISA'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.pesquisar.layout.html.bin.php");
      $tmpLAYOUT_HTML_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLAYOUT_HTML_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*BUSCAR_NO_BD*/',$tmpScriptSaida,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLAYOUT_HTML_PESQUISAR_replace,$tmpLAYOUT_HTML_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
        /* LAYOUT HTML ALTERAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LAYOUT_HTML_PADRAO_ALTERAR'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.alterar.layout.html.bin.php");
      $tmpLAYOUT_HTML_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLAYOUT_HTML_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*FORMATAR_CAMPOS*/',$tmpScriptSaidaFormatarCampos,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*MONTAR_LAYOUT*/',$tmpScriptSaida,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLAYOUT_HTML_PESQUISAR_replace,$tmpLAYOUT_HTML_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    /* LAYOUT HTML INCLUIR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LAYOUT_HTML_PADRAO_INCLUIR'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.incluir.layout.html.bin.php");
      $tmpLAYOUT_HTML_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLAYOUT_HTML_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*MONTAR_LAYOUT*/',$tmpScriptSaida,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLAYOUT_HTML_PESQUISAR_replace,$tmpLAYOUT_HTML_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
  
    /* LAYOUT HTML CONSULTAR */
    if($VAR_ENTIDADEACAO_ARQUIVO_MODELO=='LAYOUT_HTML_PADRAO_CONSULTAR'){
      /* Substituir Estes */
      
      include($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN']."/entidadeacao/modelos/modelos.montar.consultar.layout.html.bin.php");
      $tmpLAYOUT_HTML_PESQUISAR_replace= array('padrao','PADRAO','Padrao','padrão','Padrão','PADRÃO','2018-02-22');
      $tmpLAYOUT_HTML_PESQUISAR_trocar= array(strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtolower($VAR_ENTIDADEACAO_ENTIDADE_NOME),ucwords($VAR_ENTIDADEACAO_ENTIDADE_NOME),strtoupper($VAR_ENTIDADEACAO_ENTIDADE_NOME),date('Y-m-d'));
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*FORMATAR_CAMPOS*/',$tmpScriptSaidaFormatarCampos,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace('/*MONTAR_LAYOUT*/',$tmpScriptSaida,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
      $VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO = str_replace($tmpLAYOUT_HTML_PESQUISAR_replace,$tmpLAYOUT_HTML_PESQUISAR_trocar ,$VAR_ENTIDADEACAO_ARQUIVO_CONTEUDO);
    }
    
    
  }   

  require($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO']."entidadeacao/entidadeacao.importar.modelo.layout.php");
}
?>