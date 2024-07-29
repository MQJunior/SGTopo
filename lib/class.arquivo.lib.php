<?php
/**
* Arquivo
*
* API para manipulacao de arquivos
*
* @author Marcio Queiroz Jr <mqjunior@gmail.com>
* @version 1.0.1
* @copyright Copyright © 2006, Marcio Queiroz Jr.
* @package sistema
* @subpackage arquivo
*
* @date 2011-10-23
* @update 2016-07-27
*   - Modificacao da documentacao
* @update 2016-07-28
*   - Remocao da funcao: __toString
*
*
* @todo   
*      Implementar funcoes para Upload
*
*/
class Arquivo
{ 
  private $SISTEMA_;

  private $TBL_ARQUIVO = null;
  public $LOCAL_ARMAZENAR = null;
  public $LOCAL_EXIBIR = null;
  public $LOCAL_LINK = null;
  public $TMP_NOME = null;
  
  public  $GERAR_NOME_HASH = true;
  //private $ARQUIVO_NOME_LOG = "";
	
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
/**
 * Nome do Arquivo
 * @access private
 * @var string
 */
  public $Nome="";
  public $Codigo="";
  public $Tipo="";
  public $Tamanho="0";
  public $NomeHash="";
  public $DataCriacao="";
  public $Sessao="";
  public $Usuario="";
/**
 * Local onde esta armazedado o arquivo
 * @access public
 * @var string
 */
  public $Local="";
/**
 * Vetor com o conteúdo das linhas
 * @access public
 * @var array
 */
	public $Linhas="";
/**
 * Ponteiro do aquivo para leitura e gravação
 * @access private
 * @var link
 */
	private $Handle_Arquivo ="";
/**
 * Seta-se se o arquivo esta aberto ou nao - Controle
 * @access private
 * @var boolean
 */	
	private $ArquivoAberto = false;
	
/**
 * Método Construtor, será executado assim que a classe for instânciada.
 * @param	string	$P_CaminhoNome	Caminho e nome do arquivo
 * @return void
 * @access public
 */
  public function getSISTEMA(){
    return $this->SISTEMA_;
  }
  
  function __construct($p_SISTEMA){
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['ARQUIVO']['DATABASE'];
    $this->TBL_ARQUIVO = $this->DataBaseConfig['ENTIDADE_DB']['TBL_ARQUIVO'];
    $this->LOCAL_ARMAZENAR = $this->SISTEMA_['CONFIG']['ARQUIVO']['LOCAL']['ARMAZENAR'];
    $this->LOCAL_EXIBIR = $this->SISTEMA_['CONFIG']['ARQUIVO']['LOCAL']['EXIBIR'];
    $this->LOCAL_LINK = $this->SISTEMA_['CONFIG']['ARQUIVO']['LOCAL']['LINK'];
    $this->GERAR_NOME_HASH = $this->SISTEMA_['CONFIG']['ARQUIVO']['GERAR_NOME_HASH'];
    $this->SessaoCodigo = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
    $this->UsuarioCodigo = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['USUARIO'];
    $this->DataCriacao = date('Y-m-d H:i:s');
    $this->Local = $this->LOCAL_ARMAZENAR;
  }
  function __destruct() {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }
  private function ConectaDB(){
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['ARQUIVO']['DATABASE'];
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB($this->DataBaseConfig['HOSTNAME']
                                 ,$this->DataBaseConfig['USERNAME']
                                 ,$this->DataBaseConfig['PASSWORD']
                                 ,$this->DataBaseConfig['DATABASENAME']
                                 ,$this->DataBaseConfig['TIPODB']);
  } 

/**
 * Atribui o nome e local do arquivo enviado pelo paramentro.
 * @param string $P_CaminhoNome Caminho e nome do arquivo
 * @return void
 * access public
 */
  public function Abrir ($P_CaminhoNome)
  {
 		$_PosicaoArquivo=-1;
 		if (strrpos($P_CaminhoNome,"/")>0){
 			$temp_dir_sistema = explode("/",$P_CaminhoNome);
		}
		if (strrpos($P_CaminhoNome,"\\")>0){
 			$temp_dir_sistema = explode("\\",$P_CaminhoNome);
		}
		$this->Nome = trim($temp_dir_sistema[count($temp_dir_sistema)-1]);
		$_PosicaoArquivo = strpos($P_CaminhoNome, $this->Nome);
		$this->Local = substr($P_CaminhoNome, 0, $_PosicaoArquivo);
    $this->ArquivoAberto = true;
  }
/**
 * Retorna o caminho e nome do arquivo
 * @return string Caminho e nome do arquivo
 * access public
 */
  public function CaminhoNome()
  {
    return $this->Local.$this->Nome;
  }
/**
 * Verifica se o caminho e arquivo existe
 * @return boolean Retorna falso ou verdadeiro
 * access public
 */
  public function CaminhoNomeExiste()
  {
   	if (file_exists($this->Local.$this->Nome))
			return true;
		else
  		return false;
  }
/**
 * Realiza a leitura do arquivo e armazena o conteúdo em Linhas
 * @param string $P_CaminhoNome Caminho e nome do arquivo
 * @return void
 * access public
 */
  public function Ler ($P_CaminhoNome){
 		$this->Abrir($P_CaminhoNome);
		if  ($this->CaminhoNomeExiste()){
			$this->Linhas = file($this->CaminhoNome());
		}
  }
/**
 * Realiza a leitura do Site e armazena o conteúdo em Linhas
 * @param string $P_CaminhoNome Endereco do Site
 * @return void
 * access public
 */
  public function LerSite ($P_CaminhoNome){
		$this->Linhas = file($P_CaminhoNome);
  }
/**
 * Grava o conteudo no Inicio do arquivo
 * @param string $P_Conteudo Conteudo a ser armazedado
 * @param string $P_CaminhoNome Caminho e nome do arquivo
 * @return void
 * access public
 */
  public function GravarInicio ($P_Conteudo,$P_CaminhoNome){
 		$this->Abrir($P_CaminhoNome);
		if  ($this->CaminhoNomeExiste()){
			$this->Handle_Aquivo = fopen($this->CaminhoNome(),'w+');
			if ($this->Handle_Aquivo){
				fwrite($this->Handle_Aquivo, $P_Conteudo);			
				$this->ArquivoAberto = true;
			}
			else
				$this->ArquivoAberto = false;
		}
  }
/**
 * Grava o conteudo no Final do arquivo
 * @param string $P_Conteudo Conteudo a ser armazedado
 * @param string $P_CaminhoNome Caminho e nome do arquivo
 * @return void
 * access public
 */
   public function GravarFinal ($P_Conteudo,$P_CaminhoNome){
   		$this->Abrir($P_CaminhoNome);
			$this->Handle_Aquivo = fopen($this->CaminhoNome(),'a+');
			if ($this->Handle_Aquivo){
				fwrite($this->Handle_Aquivo, $P_Conteudo);			
				$this->ArquivoAberto = true;
			}
			else
				$this->ArquivoAberto = false;
   }
/**
 * Grava por cima do conteudo do arquivo
 * @param string $P_Conteudo Conteudo a ser armazedado
 * @param string $P_CaminhoNome Caminho e nome do arquivo
 * @return void
 * access public
 */
   public function GravarPorCima ($P_Conteudo,$P_CaminhoNome){
   		$this->Abrir($P_CaminhoNome);
		$this->Handle_Aquivo = fopen($this->CaminhoNome(),'w');
		if ($this->Handle_Aquivo){
			fwrite($this->Handle_Aquivo, $P_Conteudo);			
			$this->ArquivoAberto = true;
		}
		else
			$this->ArquivoAberto = false;
   }
  
/**
 * Fecha o arquivo 
 * @return void
 * access public
 */
   public function Fechar (){
		if  ($this->Handle_Aquivo){
			fclose($this->Handle_Aquivo);
		}
	   $this->ArquivoAberto = false;
   }
/**
 * Lista os arquivos contido no caminho
 * @param string $P_FiltroINI Busca baseada em palavras chaves no inicio do nome do arquivo
 * @param string $P_FiltroFIM Busca baseada em palavras chaves no final do nome do arquivo ex.: Extensao
 * @return Array $VetorResultado Vetor com a lista de arquivos
 * access public
 */
	public function ListarArquivosPasta($P_FiltroINI="",$P_FiltroFIM=""){
		if (file_exists($this->Local)){
			$_ResultArquivos = scandir($this->Local);
		}else{
			echo "\n Diretório ou Arquivo não existe! \t ".$this->Local." \n";
			exit;
		}
			
		$j=-1;
		$VetorResultado = array();
		if (($P_FiltroINI == "") && ($P_FiltroFIM == "")){
			$VetorResultado = $_ResultArquivos;
			return $VetorResultado;
			
		}
			
		if (($P_FiltroINI != "") && ($P_FiltroFIM == ""))
		{
			
			for ($i=0; $i<count($_ResultArquivos); $i++){
				if (strpos($_ResultArquivos[$i], $P_FiltroINI)===0)
					$VetorResultado[++$j]=$_ResultArquivos[$i];
			}
			return $VetorResultado;
		}
		
		if (($P_FiltroFIM != "") && ($P_FiltroINI == ""))
		{
			for ($i=0; $i<count($_ResultArquivos); $i++){
				if (strpos($_ResultArquivos[$i], $P_FiltroFIM)=== (strlen($_ResultArquivos[$i])-strlen($P_FiltroFIM)) )
					$VetorResultado[++$j]=$_ResultArquivos[$i];
			}
			return $VetorResultado;
		}
		
		if (($P_FiltroFIM != "") && ($P_FiltroINI != ""))
		{
			for ($i=0; $i<count($_ResultArquivos); $i++){
				if ( (strpos($_ResultArquivos[$i], $P_FiltroFIM)=== (strlen($_ResultArquivos[$i])-strlen($P_FiltroFIM)) )&&
				     (strpos($_ResultArquivos[$i], $P_FiltroINI)===0)
				   )
					$VetorResultado[++$j]=$_ResultArquivos[$i];
			}
			return $VetorResultado;
		}
		
	}
 /**
 * Move um arquivo ou renomeia o mesmo.
 * @param string $P_FiltroINI Lugar de origem do arquivo
 * @param string $P_FiltroFIM Lugar de Destino do arquivo
 * @return void
 * access public
 */
  public function MoverArquivo($P_Origem="",$P_Destino="_"){
		if  (file_exists($P_Origem)){
			rename($P_Origem, $P_Destino);
		}
  }
 /**
 * Copia um arquivo.
 * @param string $P_Origem Lugar de origem do arquivo
 * @param string $P_Destino Lugar de Destino do arquivo
 * @return void
 * access public
 */
  public function Copiar($P_Origem="",$P_Destino="_"){
		if  (file_exists($P_Origem))
      @copy($P_Origem, $P_Destino);
  }
/**
 * Gerencia o upload de arquivos
 * @param string $P_UploadDir Lugar de Destino do arquivo
 * @return array
 * access public
 */
  public function UploadFile(){
    $retArquivos=array();
    
    $tmp_NomeTemp = $this->SessaoCodigo."_".$this->DataCriacao;
    foreach ($_FILES as $ArquivosUpload ){
      
      $this->Nome = $ArquivosUpload['name'];
      $this->Tipo = $ArquivosUpload['type'];
      $this->Tamanho = $ArquivosUpload['size'];
      $this->TMP_NOME = $ArquivosUpload['tmp_name'];
      if (move_uploaded_file($this->TMP_NOME, $this->LOCAL_ARMAZENAR.$tmp_NomeTemp)){
        $this->InserirArquivo();
        $this->MoverArquivo($this->LOCAL_ARMAZENAR.$tmp_NomeTemp,$this->LOCAL_ARMAZENAR.$this->NomeHash);
        $retArquivos[]=array('CODIGO'=>$this->Codigo,'NOME'=>$this->Nome, 'TIPO'=>$this->Tipo, 'TAMANHO'=>$this->Tamanho, 'LOCAL'=>$this->LOCAL_ARMAZENAR,'NOME_HASH'=>$this->NomeHash);
      }
    }
    
    return $retArquivos;
  }
/**
 * Gerencia o Download de arquivos
 * @param string $P_UploadDir Lugar de Destino do arquivo
 * @return array
 * access public
 */
  public function DownloadFile($p_CODIGO){
    $this->ConectaDB();
    $retArquivos=NULL;
    $this->consultar($p_CODIGO);
    $tmpExtensao = end(explode(".",$this->Nome));
    $tmpNomeArquivo = $this->NomeHash.".".$tmpExtensao;
    if (!file_exists($this->LOCAL_EXIBIR.$tmpNomeArquivo))
      $this->Copiar($this->LOCAL_ARMAZENAR.$this->NomeHash,$this->LOCAL_EXIBIR.$tmpNomeArquivo);
    $retArquivos['LINK'] = $this->LOCAL_LINK.$tmpNomeArquivo;
    $retArquivos['NOME'] = $this->Nome;
    
    return $retArquivos;
  }
  /**
 * Gerencia o upload de arquivos
 * @param string $P_UploadDir Lugar de Destino do arquivo
 * @return array
 * access public
 */
  public function UploadFileTmp(){
    $retArquivos=array();
    
    $tmp_NomeTemp = $this->SessaoCodigo."_".$this->DataCriacao;
    foreach ($_FILES as $ArquivosUpload ){
      
      $this->Nome = $ArquivosUpload['name'];
      $this->Tipo = $ArquivosUpload['type'];
      $this->Tamanho = $ArquivosUpload['size'];
      $this->TMP_NOME = $ArquivosUpload['tmp_name'];
      if (move_uploaded_file($this->TMP_NOME, $this->LOCAL_ARMAZENAR.$tmp_NomeTemp)){
        if ($this->GERAR_NOME_HASH)
          $this->NomeHash = $this->GerarNomeHash();
        
        $this->MoverArquivo($this->LOCAL_ARMAZENAR.$tmp_NomeTemp,$this->LOCAL_ARMAZENAR.$this->NomeHash);
        $retArquivos[]=array('CODIGO'=>$this->NomeHash,'NOME'=>$this->Nome, 'TIPO'=>$this->Tipo, 'TAMANHO'=>$this->Tamanho, 'LOCAL'=>$this->LOCAL_ARMAZENAR,'NOME_HASH'=>$this->NomeHash);
      }
    }
    
    return $retArquivos;
  }
  
  private function GerarNome(){
    $retHash ="";
    $retHash .= $this->Codigo."_".date("Y:M:d_H:i:s");
    return $retHash;
  }
  
  private function GerarNomeHash(){
    return sha1($this->GerarNome());
  }
  
  public function InserirArquivo(){
    $this->ConectaDB();
    $this->DataCriacao = date('Y-m-d H:i:s');
    $this->DataBaseLink->Data['NOME'] = $this->Nome;
    $this->DataBaseLink->Data['TIPO'] = $this->Tipo;
    $this->DataBaseLink->Data['LOCAL'] = $this->Local;
    $this->DataBaseLink->Data['TAMANHO'] = $this->Tamanho;
    $this->DataBaseLink->Data['DATACRIACAO'] = $this->DataCriacao;
    $this->DataBaseLink->Data['SESSAO'] = $this->SessaoCodigo;
    $this->DataBaseLink->Data['USUARIO'] = $this->UsuarioCodigo;
    $this->DataBaseLink->Insert($this->TBL_ARQUIVO);
    $this->Codigo = $this->DataBaseLink->Id();
    $this->NomeHash = $this->GerarNome();
    if ($this->GERAR_NOME_HASH){
      $this->NomeHash = $this->GerarNomeHash();
    }
    $tmpUpdateVar['NOME_HASH'] = $this->NomeHash;
    $tmpCondicao= "CODIGO = '".$this->Codigo."'";
    $this->DataBaseLink->update($tmpUpdateVar,$tmpCondicao,$this->TBL_ARQUIVO);
    
  }
/**
 * Consulta os dados de um Usuario
 * @param string $p_ID Chave primaria do Usuarios
 * @access public
 * @uses ./lib/class.conexao.lib.php Arquivo de manipulação do banco de dados
 * @return Link
 */
 public function consultar($p_ID=""){
  if ($p_ID==""){
   die("Código Inválido! - Consulta Arquivo");
  }
  $sqlConsultar = "SELECT * FROM ".$this->TBL_ARQUIVO." WHERE CODIGO='".$p_ID."'";

  $this->DataBaseLink->Query($sqlConsultar);                                            # Executa o comando SQL no BD
  $dados =$this->DataBaseLink->ResultConsult();                                         # Retorna com o valor do SQL para Dados[]
  $this->Codigo = $dados[0]['CODIGO'];        # Seta-se o valor de $dados[0]['CODIGO']
  $this->Nome = $dados[0]['NOME'];        # Seta-se o valor de $dados[0]['NOME']
  $this->Tipo = $dados[0]['TIPO'];        # Seta-se o valor de $dados[0]['TIPO']
  $this->Tamanho = $dados[0]['TAMANHO']; 
  $this->NomeHash = $dados[0]['NOME_HASH']; 
  
  $this->DataCriacao = $dados[0]['DATACRIACAO'];        # Seta-se o valor de $dados[0]['DATACRIACAO']
  $this->Usuario = $dados[0]['USUARIO'];        # Seta-se o valor de $dados[0]['USUARIO_CRIOU']
  $this->Sessao = $dados[0]['SESSAO'];        # Seta-se o valor de $dados[0]['SESSAO']
  return true;                       # Retorna Verdadeiro se a consulta foi bem sucedida.
 }
 /**
 * Exclui um arquivo.
 * @param string $P_Origem Lugar de origem do arquivo
 * @param string $P_Destino Lugar de Destino do arquivo
 * @return void
 * access public
 */
  public function Excluir($P_Arquivo=null){
		if  ($P_Arquivo != null)
      if  (file_exists($P_Arquivo))
        @unlink($P_Arquivo);
  }  
  
}
?>
