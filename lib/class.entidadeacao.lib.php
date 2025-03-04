<?php


class EntidadeAcao{
  private $SISTEMA_;

  private $TBL_ENTIDADE = "";
  private $TBL_ACAO = "";
	
/**
 * @var	array $DataBaseConfig Vetor com as configuracoes de acesso ao banco de dados
 * @access private
 */   
	private $DataBaseConfig = null;
/**
 * @var	link $DataBaseLink Link de acesso ao Banco de Dados
 * @access private
 */   
	private $DataBaseLink = null;
  
  public function getSISTEMA(){
    return $this->SISTEMA_;
  }
  
  function __construct($p_SISTEMA){
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['CONF']['DATABASE'];
    $this->TBL_ENTIDADE = $this->DataBaseConfig['TBL_ENTIDADE'];
    $this->TBL_ACAO = $this->DataBaseConfig['TBL_ACAO'];
    
  }
  function __destruct() {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }
  private function ConectaDB(){
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB($this->DataBaseConfig['HOSTNAME'],$this->DataBaseConfig['USERNAME'],$this->DataBaseConfig['PASSWORD'],$this->DataBaseConfig['DATABASENAME'],$this->DataBaseConfig['TIPODB']);
  }
  
  public function ListarEntidades($p_Inativos=false){
    $this->ConectaDB();
    $sql_Condicao = "(Menus.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
    $sql_Entidades = "select *
    FROM  ".$this->TBL_ENTIDADE." 
      where
        ".$sql_Condicao."
    order by NOME";
    
    $this->DataBaseLink->Query($sql_Entidades);
    return $this->DataBaseLink->ResultConsult();
  }
  public function ConsultarEntidade($p_Nome){
    $this->ConectaDB();
    $sql_Entidades = "select  *
    FROM  ".$this->TBL_ENTIDADE." 
      where
        NOME = '".$p_Nome."' Limit 1";
    
    $this->DataBaseLink->Query($sql_Entidades);
    unset($this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']=$tmpDados[0];
    $tmpEntidade =strtolower($tmpDados[0]['NOME']);
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LIB'];
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CLASSE_ARQUIVO']="class.".$tmpEntidade.".lib.php";

    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['CONF'].$tmpEntidade."/";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_CONF_ARQUIVO']=$tmpEntidade.".conf.php";
    
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DEF'].$tmpEntidade."/";
    
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO']=$tmpEntidade.".def.php";
    
    foreach($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMAS_OPT'] as $tmpIdiomas)
      $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_IDIOMA'][]=$tmpEntidade.".idioma.".strtolower($tmpIdiomas).".def.php";
    
    $tmpBuscaArquivos=$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_LOCAL'];
    $tmpBuscaArquivos .= "*.def.php";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_DEF_ARQUIVO_LISTA']=glob($tmpBuscaArquivos);
    
    
    
  }
  
  public function ListarAcaoEntidade($p_Nome){
    $this->ConectaDB();
    $sql_Entidades = "select *
    FROM  ".$this->TBL_ACAO." 
      where
        ENTIDADE like '".$p_Nome."'
        ORDER BY NOME";
    $this->DataBaseLink->Query($sql_Entidades);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['DADOS']=$tmpDados;
    $tmpEntidade =strtolower($p_Nome);
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN'].$tmpEntidade."/";
    $tmpBuscaArquivos=$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL'];
    $tmpBuscaArquivos .= $tmpEntidade.".*.bin.php";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA']=glob($tmpBuscaArquivos);
 
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'].$tmpEntidade."/";
    $tmpBuscaArquivos=$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL'];
    $tmpBuscaArquivos .= $tmpEntidade.".*.layout.php";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA']=glob($tmpBuscaArquivos);
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_NOME']=$p_Nome;
  }
  
  public function ConsultarAcao($p_Codigo){
    $this->ConectaDB();
    $sql_Acao = "select *
    FROM  ".$this->TBL_ACAO." 
      where
        CODIGO ='".$p_Codigo."'";
        
    $this->DataBaseLink->Query($sql_Acao);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']=$tmpDados[0];
    $tmpAcao =strtolower(str_replace("_", ".",$tmpDados[0]['NOME']));
    $tmpEntidade =strtolower($tmpDados[0]['ENTIDADE']);
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['BIN'].$tmpEntidade."/";
    $tmpBuscaArquivos=$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_LOCAL'];
    $tmpBuscaArquivos .= $tmpEntidade.".".$tmpAcao.".bin.php";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_BIN_ARQUIVO_LISTA']=glob($tmpBuscaArquivos);
 
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL']=$this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'].$tmpEntidade."/";
    $tmpBuscaArquivos=$this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_LOCAL'];
    $tmpBuscaArquivos .= $tmpEntidade.".".$tmpAcao.".layout.php";
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_LAYOUT_ARQUIVO_LISTA']=glob($tmpBuscaArquivos);
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_NOME']=$tmpDados[0]['ENTIDADE'];
  }
  
  public function ListarTabelas(){
    $this->ConectaDB();
    $this->SISTEMA_['ENTIDADE']['ENTIDADEACAO']['VARS']['VAR_ENTIDADEACAO_ENTIDADE_TABELAS_LISTA']=$this->DataBaseLink->ListarTabelas();
    
  }
  
  public function IncluirAcao($p_Dados){
    $this->ConectaDB();
    $this->DataBaseLink->Data=$p_Dados;
    $this->DataBaseLink->Insert($this->TBL_ACAO);
    $this->ConsultarAcao($this->DataBaseLink->Id());
  }
  
  public function AlterarAcao($p_Dados,$p_Codigo){
    $this->ConectaDB();
    $this->DataBaseLink->Data=$p_Dados;
    $tmpCondicao =" CODIGO=".$p_Codigo;
    $sql_Alterar = "update ".$this->TBL_ACAO." set NIVEL='".$p_Dados['NIVEL']."', RESTRITO='".$p_Dados['RESTRITO']."' where ".$tmpCondicao;
    $this->DataBaseLink->Query($sql_Alterar);
    $this->ConsultarAcao($p_Codigo);
  }
  
  public function IncluirEntidade($p_Dados){
    $this->ConectaDB();
    $this->DataBaseLink->Data=$p_Dados;
    $this->DataBaseLink->Insert($this->TBL_ENTIDADE);
    $this->ConsultarEntidade($p_Dados['NOME']);
  }
  
}
?>
