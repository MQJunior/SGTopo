<?php
/**
* class.conexao.lib.php
*
* ConexaoDB
*
* Gerenciador de conexAo com o Banco de Dados { Firebird; Mysql*; a implementar }
* API para manipulacao de Banco de Dados MySQL
* API para manipulacao de Banco de Dados FIREBIRD/IBASE
*
* @date 2006-10-03
* @update 2010-10-14
* @update 2015-07-08
*   - Modificacao do Layout de Comentarios
* @update 2016-05-06
*   - Modificacao do Metodo Construtor. Colocando os parametros de entrada.
* @update 2016-05-18
*   - Documentacao concluida;
*   - Retirado varios Metodos
*     . InfoFieldResult();
*     . ListarTabelas()
*     . ListarCamposTabelas($P_Tabela)
*     . ExecutarComando($P_Comando)
*     . ExisteDominioNome($P_DominioNome)
*     . ExisteGenerator($P_GeneratorNome)
*     . COMMIT_DADOS()
*   - Modificado a forma de setar a configuracao do Banco
*   - Alteracoes no Metodo Insert, Update
*   - Acrescentado o Metodo Exclude_ID
* @update 2018-02-20
*   - Acrescentado o Metodo ListarTabelas()
*
* @author     Marcio Queiroz Jr <mqjunior@gmail.com>
* @version    1.2.4 <Teste>
* @copyright  Copyright © 2006, Marcio Queiroz Jr.
* @package    sistema
* @subpackage ConexaoDB
* @todo       Layout e Funcionamento
*             - Testar todas os Metodos
*             - Remover Comentarios antigos e debugs
*             Futuras
*             - Implementar para uma nova Linguagem
*/

//Class ConexaoDB extends Debug_lib {
Class ConexaoDB extends Debug_lib {	
 
/**
 * HostName ou endereco do Servidor
 * @access private
 * @var string
 */
	public $HostName="";

/**
 * UserName ou Nome de Usuario
 * @access private
 * @var string
 */
  public $UserName="";

/**
 * Senha do Usuario
 * @access private
 * @var string
 */
	public $PassWord="";

/**
 * Nome da Base de Dados
 * @access private
 * @var string
 */
	public $DataBaseName="";

/**
 * Comando SQL a ser executado
 * @access private
 * @var string
 */
	protected $Query="";

/**
 * Vetor com dados retornado de pesquisas
 * @access private
 * @var array
 */
	public $Data= array();

/**
 * Nome da Tabela que ira ser afetada
 * @access public
 * @var string
 */
	public $Table="";

/**
 * Condicao a ser excutada em comando SQL
 * @access public
 * @var string
 */
	public $Where="";

/**
 * Define o tipo de Banco que ira trabalhar
 * {0-MySQL; 1-Firebird/Interbase}
 * @access private
 * @var integer
 */
	private $TipoDB=0;

/**
 * Link Ponteiro do Banco
 * @access protected
 * @var link
 */
	private $Link="";

/**
 * Link Ponteiro do Banco
 * @access private
 * @var link
 */
	private $Result="";

/**
 * Mensagem Debug, todas mensagens sera armazenadas aqui, caso queira exibilas
 * relatorio de erros e mensagens;
 * @access public
 * @var string
 */
	public $MENSAGEMDEBUG = "";

/**
 * Método Construtor, será executado assim que a classe for instânciada.
 * @param	string	$p_HostName	Endereço do host para acesso ao BD
 * @param	string	$p_UserName	Nome de Usuário para acesso ao BD
 * @param	string	$p_PassWord	Senha para acesso ao BD
 * @param	string	$p_DataBaseName	Nome da Base de Dados
 * @param	string	$p_TipoDB	Tipo de Banco de Dados [0-mysql|1-firebird]
 * @return void
 * @access public
 * @update 2016-05-06
 *  - Parametros de Entrada
 */
	public function __construct($p_HostName, $p_UserName, $p_PassWord, $p_DataBaseName, $p_TipoDB='0', &$p_SISTEMA=null ) {
   error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
   $this->HostName = $p_HostName;
   $this->UserName = $p_UserName;
   $this->PassWord = $p_PassWord;
   $this->DataBaseName = $p_DataBaseName;
   $this->TipoDB = $p_TipoDB;
   $this->SISTEMA_=$p_SISTEMA;
   $this->Connect();
	}

  function __destruct() {
    $this->Disconnect();
    error_reporting(E_ALL);
    
  }
  
  
/**
 * Faz a conexão com o banco de dados.
 * @access private
 * @return void
 */
	function Connect() {
		if ($this->TipoDB ==0) { // MySQL
			try {
				$this->Link = mysqli_connect($this->HostName,$this->UserName,$this->PassWord); 
			} catch (Exception $e) {
				$this->DebugInfo();
				$this->DebugError($e->getMessage());
				
			}
			if (!$this->Link) { 
				$this->Error_SQL();	
			}elseif (!mysqli_select_db($this->Link,$this->DataBaseName)) 	{ 
				$this->Error_SQL();
			}

		}if ($this->TipoDB ==1){ // Firebird / IBASE
			//	$this->Link = ibase_pconnect($this->HostName,$this->UserName,$this->PassWord);           # Abre a conexão com o Banco de Dados enviando os dados: 'Servidos, Usúario e Sennha
			if (!($this->Link = @ibase_pconnect($this->HostName,$this->UserName,$this->PassWord,'ISO8859_1'))) {
				$this->Error_SQL();
# Se a conexão NÃO for efetuada com sucesso, então
				  // die("Erro: Não foi possível efeturar a conexão junto ao BD! : (".$this->HostName.")<br>Erro:".ibase_errcode()." - ".ibase_errmsg());                  # Termina o programa com uma mensagem de erro
			}
		}
	}

/**
 * Envia comandos sql para o banco de dados.
 * @param string $p_Comando Comando a ser executado
 * @return link Link do comando
 * access public
 */
	public function Executar($p_Comando) {
		return $this->Query($p_Comando);

	}

/**
 * Envia comandos sql para o banco de dados.
 * @param string $P_Query Query a ser executado
 * @param string $P_DataBaseName Base de Dados a ser utilizada
 * @return link Link do comando
 * @access public
 */
	function Query($P_Query,$P_DataBaseName="") {

    if (!$this->Link) $this->Connect();
		$this->Query = $P_Query;

		if ($this->TipoDB ==0) { // MySQL
			if ($P_DataBaseName != "") {
				$this->DataBaseName = $P_DataBaseName;
			}
			if ($result = mysqli_query($this->Link,$this->Query)) {
				$this->Result = $result;
				$this->Error_SQL();
			} else {
				$this->Result = null;
				die("Erro ao executar a sintaxe SQL:<br>".$P_Query."<br>--->".mysqli_error($this->Link)."<---");
				$this->Error_SQL();

			}
		}
		if ($this->TipoDB ==1) { // Firebird
			if ($result = ibase_query($this->Link,$this->Query)) {
				$this->Result = $result;
				$this->Error_SQL();
			} else {
				$this->Error_SQL();
				$this->Result = null;
        $this->SISTEMA_['ERROR']['DETALHE'] = "Erro ao executar a sintaxe SQL:\n".$P_Query."\n\n".ibase_errcode()." <<->> ".ibase_errmsg();
        die($this->SISTEMA_['ERROR']['DETALHE']);
			}
		}
		return $this->Result;
	}

/**
 * Grava mensagens em um arquivo para futuras consultas
 * @return void
 * @access public
 */

	public function Error_SQL() {
		$temp_ErroMsg = "SQL: ".$this->Query." - ";
		if ($this->TipoDB==0) {
//			$ERRO_Log->GravarLog($temp_ErroMsg.mysql_error(),mysql_errno());
			$temp_ErroMsg .= mysqli_error($this->Link)." : ".mysqli_errno($this->Link);
      if(mysqli_errno($this->Link)){
        $this->SISTEMA_['ERROR']['CODIGO'] = mysqli_errno($this->Link);
        $this->SISTEMA_['ERROR']['MENSAGEM'] = mysqli_error($this->Link);
      }
		}
		if ($this->TipoDB==1) {
//			$ERRO_Log->GravarLog($temp_ErroMsg.ibase_errmsg(),ibase_errcode());
			$temp_ErroMsg .= ibase_errmsg()." : ".ibase_errcode();
      if(ibase_errcode()){
        $this->SISTEMA_['ERROR']['CODIGO'] = ibase_errcode();
        $this->SISTEMA_['ERROR']['MENSAGEM'] = ibase_errmsg();
        $this->SISTEMA_['ERROR']['SCRIPT'] = $this->Query ;
        print_r($this->SISTEMA_);die();
      }
		}
		//$fp = @fopen("error.txt","a");
		//$temp_ErroMsg = "DATA(".date("Y-m-d").") ".$temp_ErroMsg."\t".$this->MENSAGEMDEBUG."\n";
		//@fwrite($fp,$temp_ErroMsg);
		//@fclose($fp);
		//echo $temp_ErroMsg;
	}
	
/**
 * Retorna o resultado da consulta/pesquisa em formato de vetor
 * @return array
 * @access private
 */
	function ResultConsult() {
		if (!$this->Result){
			//die("falso");
			return false;
		}else
			$result = $this->Result;
		$i=-1;
		if ($this->TipoDB ==0) { // MySQL
			while ($linha = mysqli_fetch_array($result)) {
				$i++;
				$data[$i] = $linha;
			}
		}
		if ($this->TipoDB ==1) { // Firebird
			while ($linha = @ibase_fetch_assoc($result, IBASE_TEXT)) {
				$data[++$i] = $linha;
			}
		}
		if (!isset($data))
			return false;
		else
			$this->Data = $data;
		return $data;
	}
/**
 * Metodo para inserir dados em uma tabela
 * @param	string	$p_Table	Nome da tabela junto ao BD
 * @param	string	$p_DataBaseName	Nome da Base de Dados
 * @return link
 * @access public
 */
	public function Insert($P_Table="", $P_DataBaseName="") {
		if ($P_Table != "")
			$this->Table = $P_Table;
		if ($P_DataBaseName != "")
			$this->DataBaseName = $P_DataBaseName;
		if (!is_array($this->Data)){
			die(/*var_dump($this).*/ __LINE__ .' - '. __FILE__);
			//die("Vetor inexistente!");
		}
		$tabela = $this->Table;
		$databasename = $this->DataBaseName;
		$P_Data = $this->Data;
		$dados = $P_Data;
		$campos = array_keys($P_Data);
		//die(var_dump($this). __FILE__ . " - ". __LINE__);
		
		
		for($i=0; $i<count($campos); $i++) {
			if ($i>0)
				$campos_sql .= ", ".$campos[$i];
			else
				$campos_sql = $campos[$i];
		}

		for($i=0; $i<count($dados); $i++) {
			if ($i>0) {
				if ($dados[$campos[$i]]!= '')
					$dados_sql .= ", '".$dados[$campos[$i]]."'";
				else
					$dados_sql .= ", NULL";
			} else {
				if ($dados[$campos[$i]]!= '')
					$dados_sql = "'".$dados[$campos[$i]]."'";
				else
					$dados_sql = "NULL";
			}
		}

		$sql = "INSERT INTO ".$this->Table." (".$campos_sql.") VALUES (".$dados_sql.")";
		
		return $this->Query($sql,$databasename);

	}

/**
 * Metodo para Excluir dados em uma tabela
 * @param	string	$p_Where	Condicao Where
 * @param	string	$p_Table	Nome da tabela junto ao BD
 * @param	string	$p_DataBaseName	Nome da Base de Dados
 * @return link
 * @access public
 */
	public function Exclude($P_Where, $P_Table="", $P_DataBaseName="") {
		if ($P_Table != "")
			$this->Table = $P_Table;
		if ($P_DataBaseName != "")
			$this->DataBaseName = $P_DataBaseName;
		if ($P_Where =="")
			return false;

		$sql = "DELETE FROM ".$this->Table." WHERE ".$P_Where;
		//echo $sql;
		return $this->Query($sql,$databasename);
	}

/**
 * Metodo para Excluir dados em uma tabela a partir de um ID/CODIGO informado
 * @param	integer	$P_ID	Chave primaria que tenha como nome CODIGO
 * @param	string	$p_Table	Nome da tabela junto ao BD
 * @param	string	$p_DataBaseName	Nome da Base de Dados
 * @return link
 * @access public
 */
	function Exclude_ID($P_ID, $P_Table="", $P_DataBaseName="") {
		if ($P_Table != "")
			$this->Table = $P_Table;
		if ($P_DataBaseName != "")
			$this->DataBaseName = $P_DataBaseName;

		$sql = "DELETE FROM ".$this->Table." WHERE CODIGO=".$P_ID;
		//echo $sql;
		return $this->Query($sql,$databasename);
	}

/**
 * Metodo para Alterar dados em uma tabela
 * @param	array	  $P_Data   Dados a serem alterados
 * @param	string	$p_Where	Condicao Where {"" - CODIGO = DATA[CODIGO]
 * @param	string	$p_Table	Nome da tabela junto ao BD
 * @param	string	$p_DataBaseName	Nome da Base de Dados
 * @return link
 * @access public
 */
	function Update($P_Data, $P_Where="", $P_Table="", $P_DataBaseName="") {
		if ($P_Table != "")
			$this->Table = $P_Table;
		if ($P_DataBaseName != "")
			$this->DataBaseName = $P_DataBaseName;
/*
		if (!is_array($P_Data))
   		if (is_array($this->Data))
  			$P_Data = $this->Data;
      else
        return false;
*/
		$tabela = $this->Table;
		$databasename = $this->DataBaseName;

		$campos = array_keys($P_Data);
		$dados = $P_Data;

		for($i=0; $i<count($campos); $i++) {
			if ($i>0) {
				if ($dados[$campos[$i]]=="")
					$dados[$campos[$i]] = "NULL";
				else
					$dados[$campos[$i]] = "'".$dados[$campos[$i]]."'";

				$campos_sql .= ", ".$campos[$i]." = ".$dados[$campos[$i]]."";
			} else
				$campos_sql = $campos[$i]." = '".$dados[$campos[$i]]."'";

		}
		if ($P_Where == "")
    {
     $P_Where = $campos[0].' = '.$dados[$campos[0]];
    }
		$sql = "UPDATE ".$this->Table." SET ".$campos_sql." WHERE ".$P_Where;

		return $this->Query($sql,$databasename);
		
	}

/**
 * Retorna o último id de uma inserção.
 * @return integer
 * @access public
 */
  public function Id() {
		if ($this->TipoDB ==0)  // MySQL
		{
			return mysqli_insert_id($this->Link);  # Retorna o último id da inserção
		}
		if ($this->TipoDB ==1) { // Firebird
			$sql_temp = "select gen_id(GEN_".strtoupper($this->Table)."_ID,0) as CODIGO  from RDB\$DATABASE";
			$lk_ibase = ibase_query($this->Link,$sql_temp);
			$temp_CODIGO = ibase_fetch_row($lk_ibase);
			$this->MENSAGEMDEBUG = "****  ".$temp_CODIGO[0]." ****";
			$this->Error_SQL();
//			return $this->Data[0][0];
//			$this->MENSAGEMDEBUG = "****  ".ibase_gen_id("'GEN_".$this->Table."_ID'",0,$this->Link)." ****";           # Retorna o último id da inserção
//			return $this->MENSAGEMDEBUG;
			return $temp_CODIGO[0];
		}
		//	$this->Error_SQL();
	}

/**
 * Encerra a conexão com o Banco de Dados!
 * @return Link
 * @access public
 */
	public function Disconnect() {
		if ($this->TipoDB ==0) { // MySQL
			if (isset($this->Link))
				try{
					if (!is_null($this->Link )){
						mysqli_close($this->Link);
						$this->Link = null;
					}
				} catch (Exception $e){
					$this->DebugInfo();
					$this->DebugError($e->getMessage());
				}
				return true;
# Fecha a conexão passando o link de referência
		}
		if ($this->TipoDB ==1) { // Firebird
			return @ibase_close($this->Link);
# Fecha a conexão passando o link de referência
		}
	}

/**
 * Formata os valores de acordo com a necessidade;
 * @param	array	  $p_dados    Tabela de Dados a ser formatada
 * @param	string  $p_campo    Campo a ser formatado
 * @param	string  $p_formato  Formato de saida {data - dd/mm/aaaa|moeda - R$}
 * @param	string	$p_tipodado	Tipo de saida {data|moeda}
 * @return array  Tabela de dados formatada
 * @access public
 */
	public function FORMATA_DADOS($p_dados,$p_campo,$p_formato,$p_tipodado='') {

		for ($i=0; $i<count($p_dados); $i++) {
			$tmp_data = $p_dados[$i][$p_campo];
			if ($p_tipodado == 'data') {
				if (!is_null($tmp_data)) {
					$tmp_dia = substr($tmp_data,8,2);
					$tmp_mes =substr($tmp_data,5,2);
					$tmp_ano =substr($tmp_data,0,4);
					$tmp_hora =substr($tmp_data,11,2);
					$tmp_minuto=substr($tmp_data,14,2);
					$tmp_segundo =substr($tmp_data,17,2);
					$tmp_data = date($p_formato, mktime($tmp_hora, $tmp_minuto, $tmp_segundo, $tmp_mes, $tmp_dia, $tmp_ano));
				}
			}
			if($p_tipodado == 'moeda') {
				$tmp_data = $p_formato.number_format($tmp_data, 2, ',','.');
			}
			@ $p_dados[$i][$p_campo] = $tmp_data;
		}
		return $p_dados;

	}

/**
 * Ordena uma tabela de dados;
 * @param	array	  $p_dados    Tabela de Dados a ser ordenada
 * @param	string  $p_campo    Campo a ser ordenado
 * @param	string  $p_ordem    {ASC - ascendente|DESC - descendente}
 * @return array  Tabela de dados ordenada
 * @access public
 */
	public function ORDENA_DADOS($p_dados,$p_campo,$p_ordem="ASC") {
		$tmp_dados = $p_dados;
		// Obter uma lista de colunas
		for($i=0; $i<count($tmp_dados); $i++) {
			$tmp_coluna[$i]  = $tmp_dados[$i][$p_campo];
		}
		if($p_ordem == "ASC") {
			array_multisort($tmp_coluna, SORT_ASC, $tmp_dados );
		} else {
			array_multisort($tmp_coluna, SORT_DESC, $tmp_dados );
		}
		return $tmp_dados;

	}
/**
 * Lista as tabelas de um Banco de Dados;
 * @return array  Tabelas do Banco de Dados
 * @access public
 */  
  public function ListarTabelas() 
    { 
		if ($this->TipoDB ==0){ // MySQL
			$this->Query('SHOW TABLES');	
			
			$tmpRetorno = $this->ResultConsult();
			$i=0;
			foreach ($tmpRetorno as $Retorno) $Resultado[$i++]['NOME'] = $Retorno[0];
			#die(print_r($Resultado) .__LINE__ . __FILE__ );
        	return $Resultado;
		}
		if ($this->TipoDB ==1){ // Firebird
			$this->Query("select TRIM(RDB\$RELATION_NAME) NOME from RDB\$relations
      where (NOT UPPER(RDB\$RELATION_NAME) CONTAINING UPPER('\$'))and
        NOT UPPER(RDB\$RELATION_NAME) STARTING WITH UPPER('view') order by RDB\$RELATION_NAME");
        	return $this->ResultConsult(); 
		}
    } 
  /**
 * Lista os domínios de um Banco de Dados;
 * @return array  Tabelas do Banco de Dados
 * @access public
 */  
  public function ListarDominios() 
    { 
		if ($this->TipoDB ==0){ // MySQL
			//$this->Query('SHOW TABLE STATUS');
        //	return $this->ResultConsult();
        return false; // não implementado para mysql
		}
		if ($this->TipoDB ==1){ // Firebird
			$this->Query("SELECT
TRIM(F.RDB\$FIELD_NAME) DOMINIO,
F.RDB\$FIELD_LENGTH TAMANHO
FROM RDB\$FIELDS F
where not(F.RDB\$FIELD_NAME like 'RDB\$%')
ORDER BY DOMINIO
");
        	return $this->ResultConsult(); 
		}
  } 

/**
 * Lista os campos de uma tabela;
 * @param	string  $p_tabela Nome da Tabela
 * @return array  Campos da tabela
 * @access public
 */  
  public function ListarCamposTabela($p_tabela) 
    { 
		if ($this->TipoDB ==0){ // MySQL
			$this->Query('SHOW COLUMNS FROM '.$p_tabela);
			
			$tmpRetorno= array();
        	$tmpRetorno =  $this->ResultConsult();
			
			$Retorno= array();
			foreach ($tmpRetorno as $tmpColunas => $tmpCampos){
				$_tmpRetorno = array();
				$_tmpRetorno['CAMPO'] = $tmpCampos[0];
				$_tmpRetorno['REQUERIDO'] = 0;
				if ($tmpCampos[2]=="NO")$_tmpRetorno['REQUERIDO'] = 1;

// Definir Tipo
				
				//$_tmpRetorno['TIPO'] = $tmpCampos[1];
				if (($tmpCampos[1] == "int")&&($tmpCampos["Key"] =="MUL"))$_tmpRetorno["DOMINIO"]="CODIGO_LINK";
				if (($tmpCampos[1] == "int")&&($tmpCampos["Key"] =="PRI"))$_tmpRetorno["DOMINIO"]="CODIGO";
				if (($_tmpRetorno['CAMPO'] == "NOME")||($tmpCampos[1] == "varchar(100)"))$_tmpRetorno["DOMINIO"]="NOME";
				if ($tmpCampos[1] =="varchar(10)")$_tmpRetorno["DOMINIO"]="NOME_CURTO";
				if ($tmpCampos[1] =="varchar(150)")$_tmpRetorno["DOMINIO"]="DESCRICAO";
				if ($tmpCampos[1] =="varchar(150)")$_tmpRetorno["DOMINIO"]="DESCRICAO";
				if (($tmpCampos[1] =="varchar(1000)")||($tmpCampos[1] =="text"))$_tmpRetorno["DOMINIO"]="NOME_TEXTO";
				if ($tmpCampos[1] =="datetime")$_tmpRetorno["DOMINIO"]="DATA";
				
				

// Fim Definir Tipo
				//$_tmpRetorno['TIPO'] = $tmpCampos[1];
				$Retorno[]=$_tmpRetorno;
			}
			//die("\n" . var_dump($tmpRetorno) . __LINE__ ." - ". __FILE__ );
			//die("\n" . var_dump($Retorno) . __LINE__ ." - ". __FILE__ );
			return $Retorno; 
		}
		if ($this->TipoDB ==1){ // Firebird
			$this->Query("select TRIM(f.rdb\$field_name) CAMPO,
TRIM(f.rdb\$field_source) DOMINIO,
TRIM(f.rdb\$null_flag) REQUERIDO
from rdb\$relation_fields f
where f.rdb\$relation_name = '$p_tabela'
order by f.rdb\$field_position");
        	return $this->ResultConsult(); 
		}
  }   
  
  
  
}
?>