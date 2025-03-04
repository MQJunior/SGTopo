<?php
/**
* @file sistema.tabela.csv.gerar.sql.bin.php
* @name sistema.tabela.csv.gerar.sql
* @desc
*   Realiza a pesquisa de registro no Banco de Dados pelo nome
*
* @author     Márcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright © 2006, Márcio Queiroz Jr.
* @package    sistema
* @subpackage bin
* @todo       
*   Descricao todo
*
* @date 2018-02-22  v. 0.0.0
*
*/

$tmpTABELASESSAO  = $this->SISTEMA_['CONFIG']['SESSAO']['DATABASE']['ENTIDADE_DB'];

$tmpTABELAUSUARIO = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];


$VAR_NOME_TABELA = strtoupper(trim($_REQUEST['TXT_TABELA_NOME']));

$tmpTABELA = array();
$tmpCAMPOS =$_REQUEST['TXT_CAMPO'];
$tmpDOMINIOS =$_REQUEST['TXT_DOMINIO'];
$tmpREFERENCIAS =$_REQUEST['TXT_REFERENCIA'];
for($i=0; $i<count($tmpCAMPOS) ;$i++){
  if( ($tmpCAMPOS[$i]!="")
    &&
      (($tmpCAMPOS[$i]!="CODIGO") && ($tmpCAMPOS[$i]!="SESSAO") && ($tmpCAMPOS[$i]!="DATACRIACAO") && ($tmpCAMPOS[$i]!="USUARIO") && ($tmpCAMPOS[$i]!="REG_ATIVO") )
    ){
    if ($tmpREFERENCIAS[$i]=='0')
      $tmpREFERENCIAS[$i] = null;
    $tmpTABELA[] = array('CAMPO'=>$tmpCAMPOS[$i], 'DOMINIO'=>$tmpDOMINIOS[$i], 'REFERENCIA'=>$tmpREFERENCIAS[$i]);
    
  }
}

$tmpCAMPOS_DOMINIO_SQL="";
foreach($tmpTABELA as $tmpCampos)
  $tmpCAMPOS_DOMINIO_SQL .= "\t".$tmpCampos['CAMPO']." \t ".$tmpCampos['DOMINIO'].",\n";

$VAR_SQL_TABELA_GENERATOR="CREATE GENERATOR GEN_TBL_".$VAR_NOME_TABELA."_ID;";

$VAR_SQL_TABELA_CAMPOS="
CREATE TABLE TBL_".$VAR_NOME_TABELA." (
    CODIGO       CODIGO NOT NULL,
$tmpCAMPOS_DOMINIO_SQL
    SESSAO       CODIGO_LINK NOT NULL,
    USUARIO      CODIGO_LINK NOT NULL,
    DATACRIACAO  DATA NOT NULL,
    REG_ATIVO    TIPO DEFAULT 1 NOT NULL
);";

$VAR_SQL_TABELA_PRIMARY_KEY ="
ALTER TABLE TBL_".$VAR_NOME_TABELA." ADD CONSTRAINT PK_TBL_".$VAR_NOME_TABELA." PRIMARY KEY (CODIGO);";

$VAR_SQL_TABELA_FOREING_KEY ="
ALTER TABLE TBL_".$VAR_NOME_TABELA." ADD CONSTRAINT FK_TBL_".$VAR_NOME_TABELA."_SESSAO FOREIGN KEY (SESSAO) REFERENCES $tmpTABELASESSAO (CODIGO);
ALTER TABLE TBL_".$VAR_NOME_TABELA." ADD CONSTRAINT FK_TBL_".$VAR_NOME_TABELA."_USUARIO FOREIGN KEY (USUARIO) REFERENCES $tmpTABELAUSUARIO (CODIGO);";

foreach($tmpTABELA as $tmpCamposFK){
  if ($tmpCamposFK['REFERENCIA'] !=null){
    $VAR_SQL_TABELA_FOREING_KEY .= "ALTER TABLE TBL_".$VAR_NOME_TABELA." ADD CONSTRAINT FK_TBL_".$VAR_NOME_TABELA."_".$tmpCamposFK['CAMPO']." FOREIGN KEY (".$tmpCamposFK['CAMPO'].") REFERENCES ".$tmpCamposFK['REFERENCIA']." (CODIGO);\n";
  }
}

$VAR_SQL_TABELA_TRIGGER="
CREATE OR ALTER TRIGGER TBL_".$VAR_NOME_TABELA."_BI FOR TBL_".$VAR_NOME_TABELA."
ACTIVE BEFORE INSERT POSITION 0
as
begin
  if (new.codigo is null) then
    new.codigo = gen_id(gen_tbl_".strtolower($VAR_NOME_TABELA)."_id,1);
end

";

require($this->SISTEMA_['LAYOUT']."sistema/sistema.tabela.csv.gerar.sql.layout.php"); 

?>