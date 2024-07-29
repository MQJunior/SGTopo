<?php
/**
* @file sistema.tabela.carregar.csv.bin.php
* @name sistema.tabela.carregar.csv
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

$VAR_ARQUIVO_INFO ="";
$ARQUIVO_CSV_ = new Arquivo($this->SISTEMA_);
$tmpArquivo = $ARQUIVO_CSV_->UploadFileTmp();
if(!empty($tmpArquivo)){
  $tmpArquivo = $tmpArquivo[0];
  $ArquivoConteudo = file($tmpArquivo['LOCAL'].$tmpArquivo['NOME_HASH']);
  $ARQUIVO_CSV_->Excluir($tmpArquivo['LOCAL'].$tmpArquivo['NOME_HASH']);

  $ArquivoConteudo = $ArquivoConteudo[0];
  $tmpConteudoCampos = explode(";",$ArquivoConteudo);
  $tmpQtdeCampos = count($tmpConteudoCampos)-1;
  $VAR_ARQUIVO_INFO = $ArquivoConteudo;
}
unset($ARQUIVO_CSV_);

$tmpDBConfig = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
$CNXDB_ = new ConexaoDB($tmpDBConfig['HOSTNAME'],
                        $tmpDBConfig['USERNAME'],
                        $tmpDBConfig['PASSWORD'],
                        $tmpDBConfig['DATABASENAME'],
                        $tmpDBConfig['TIPODB']);

$VAR_SISTEMA_DOMINIOS_DADOS = $CNXDB_->ListarDominios();
$VAR_SISTEMA_TABELA_DADOS = $CNXDB_->ListarTabelas();
unset($CNXDB_);

require($this->SISTEMA_['LAYOUT']."sistema/sistema.tabela.carregar.csv.layout.php"); 
?>