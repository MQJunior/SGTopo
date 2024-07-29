<?php
/**
 * Funcoes
 *
 * Arquivo de funcoes diversas que sao utilizadas constantemente;
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.2.2
 * @copyright Copyright � 2006, Marcio Queiroz Jr.
 * @package sistema
 * @subpackage funcoes
 *
 * @date 2010-10-04
 *   - version 1.0
 * @update 2012-03-02
 * @update 2015-07-06
 *  - Novo Modelo de Documentacao
 *  - Removido as seguintes Fun&ccedil;&otilde;es:
 *    - objectToArray
 *    - ExibirConteudo
 *    - get_type
 * @update 2016-05-17
 *   - version 1.1 <fechada>
 * @update 2016-10-15
 *   - version 1.1.1
 *     - Corre��o das fun��es LerConteudoLinha e EsquemaTXT : Somando as colunas corretamente
 * @update 2017-09-12
 *   - version 1.2.1
 *     - Adicionado novas funcoes
 *       - DadosToDataset
 * @update 2017-09-15
 *   - version 1.2.1
 *     - Modificado a funcao : MeuIPNET {Estava apontando para o endere�o errado: kromus.com.br}
 *     - Adicionado novas funcoes
 *       - CSV2Dados 
 *       - Dados2CSV
 *       - DateFormatToUnixTime
 * @update 2018-08-15
 *   - version 1.2.2
 *     - Modificado a funcao : GerarXMLAjax -> htmlspecialchars{novos parametros}
 *
 * @todo   
 *      Modificar a funcao MeuIPNET -> apontar para um novo endereco na internet
 *
 */

/**
 * Funcao para gerar XML no padr�o aceito pelo AJAX.
 * @param string $P_Conteudo Conteudo a ser enviado
 * @return string Conteudo em XML
 */
function GerarXMLAjax($P_Conteudo)
{
	$xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
	$xml .= "<dados>\n";
	$xml .= "<dado>\n";
	$xml .= "<INFORMACAO>" . htmlspecialchars($P_Conteudo, ENT_QUOTES, 'ISO-8859-1', true) . "</INFORMACAO>\n";
	//$xml .= "<INFORMACAO>".htmlentities($P_Conteudo, ENT_NOQUOTES, 'ISO-8859-1')."</INFORMACAO>\n";
	$xml .= "</dado>\n";
	$xml .= "<DATAHORA>\n";
	$xml .= "<datahoraAgora>" . date('Y-m-d H:i:s') . "\n</datahoraAgora>\n";
	$xml .= "<hashTransacao>" . sha1(date('Y-m-d H:i:s')) . "\n</hashTransacao>\n";
	$xml .= "</DATAHORA>\n";
	$xml .= "</dados>";
	@header("Content-type: application/xml; charset=iso-8859-1");
	return $xml;
}


function GerarJSONAjax($P_Conteudo, $P_Formulario = null)
{

	//$tmp_Conteudo['TRECHO_HTML'] = str_replace("'", "\'", $P_Conteudo);
	//$tmp_Conteudo['TRECHO_HTML'] = $P_Conteudo;

	$tmp_Conteudo = $P_Conteudo;
	//$tmp_Conteudo = addslashes($P_Conteudo);
	//$tmp_Conteudo = htmlspecialchars($tmp_Conteudo, ENT_QUOTES, 'UTF-8', true);
	//$tmp_Conteudo = str_replace('"', '\"', $tmp_Conteudo);
	$tmp_Conteudo = htmlentities($tmp_Conteudo);
	($P_Formulario == null) ? $ArrayConteudo = array('TRECHO_HTML' => $tmp_Conteudo) : $ArrayConteudo = array('FORMULARIO' => $P_Formulario);
	/*
			   echo "-- " . $JsonConteudo . " -- \n";
			   print_r($ArrayConteudo);
			   die("Aqui " . __FILE__ . " > " . __LINE__);
			   */
	$JsonConteudo = json_encode($ArrayConteudo);
	@header("Content-type: application/json; charset=iso-8859-1");
	return $JsonConteudo;
}


/**
 * Realiza a leitura de uma linha extraindo apenas as colunas desejadas
 * @param integer $P_Linha Linha a ser lida
 * @param integer $P_ColI Posicao inicial da coluna a ser lida
 * @param integer $P_ColF Posicao final da coluna a ser lida
 * @param integer $P_ColF Quantidade de caracteres a ser extra�do a partir da coluna inicial
 * @return string Conteudo extraido da linha
 */
function LerConteudoLinha($P_Linha, $P_ColI, $P_ColF = 0, $P_ColS = 0)
{
	if (($P_ColF == 0) && ($P_ColS == 0)) {
		return trim(substr($P_Linha, $P_ColI));

	}
	if (($P_ColI == 0) && ($P_ColF == 0) && ($P_ColS == 1)) {
		$P_ColS = 1;
		return trim(substr($P_Linha, 0, 1));

	}
	if (($P_ColF > 0)) {
		$P_ColS = ($P_ColF - $P_ColI) + 1;
	}
	return trim(substr($P_Linha, $P_ColI, $P_ColS));
}

/**
 * Funcoo para ler dados de arquivos txt a partir de um esquema
 * @param array $P_EsquemaArquivo Esquema a ser lido
 * @param array $P_LinhasArquivo Conteudo do Arquivo a ser lido
 * @return string Conteudo extraido dos dados
 */

function EsquemaTXT($P_EsquemaArquivo, $P_LinhasArquivo)
{
	$Resultado = array();
	$ResultadoLinha = -1;

	for ($i_Esquema = 0; $i_Esquema < count($P_EsquemaArquivo); $i_Esquema++) {

		# LER TODAS AS LINHAS CASO SEJA IGUAL A "*"
		if (($P_EsquemaArquivo[$i_Esquema]["LINHA"] == "*") || (trim($P_EsquemaArquivo[$i_Esquema]["LINHA"]) == "")) {
			for ($i_ArquivoLinhas = 0; $i_ArquivoLinhas < count($P_LinhasArquivo); $i_ArquivoLinhas++) {
				if (($P_EsquemaArquivo[$i_Esquema]["VALOR"] == LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas], $P_EsquemaArquivo[$i_Esquema]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["COL_S"])) || ($P_EsquemaArquivo[$i_Esquema]["VALOR"] == "")) {
					$ResultadoLinha++;
					for ($i_EsquemaDados = 0; $i_EsquemaDados < count($P_EsquemaArquivo[$i_Esquema]["DADOS"]); $i_EsquemaDados++) {
						$Resultado[$ResultadoLinha][$P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["NOME"]] = LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas + $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["LINHA_S"]], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_S"]);
					}
				}
			}
		} #Fim IF Linha = "*"

		# LER SOMENTE A LINHA INFORMADA
		if (($P_EsquemaArquivo[$i_Esquema]["LINHA"] >= 0) && (($P_EsquemaArquivo[$i_Esquema]["LINHA"] != "U") && ($P_EsquemaArquivo[$i_Esquema]["LINHA"] != "*"))) {
			//		die("aqui nao  ".($P_EsquemaArquivo[$i_Esquema]["LINHA"] >= 0) );
			$i_ArquivoLinhas = $P_EsquemaArquivo[$i_Esquema]["LINHA"];
			if (($P_EsquemaArquivo[$i_Esquema]["VALOR"] == LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas], $P_EsquemaArquivo[$i_Esquema]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["COL_S"])) || ($P_EsquemaArquivo[$i_Esquema]["VALOR"] == "")) {
				$ResultadoLinha++;
				for ($i_EsquemaDados = 0; $i_EsquemaDados < count($P_EsquemaArquivo[$i_Esquema]["DADOS"]); $i_EsquemaDados++) {
					$Resultado[$ResultadoLinha][$P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["NOME"]] = LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas + $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["LINHA_S"]], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_S"]);
				}
			}
		}

		# LER SOMENTE A �LTIMA LINHA
		if ($P_EsquemaArquivo[$i_Esquema]["LINHA"] == "U") {
			$i_ArquivoLinhas = count($P_LinhasArquivo) - 1;
			if (($P_EsquemaArquivo[$i_Esquema]["VALOR"] == LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas], $P_EsquemaArquivo[$i_Esquema]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["COL_S"])) || ($P_EsquemaArquivo[$i_Esquema]["VALOR"] == "")) {
				$ResultadoLinha++;
				for ($i_EsquemaDados = 0; $i_EsquemaDados < count($P_EsquemaArquivo[$i_Esquema]["DADOS"]); $i_EsquemaDados++) {
					$Resultado[$ResultadoLinha][$P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["NOME"]] = LerConteudoLinha($P_LinhasArquivo[$i_ArquivoLinhas + $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["LINHA_S"]], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_I"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_F"], $P_EsquemaArquivo[$i_Esquema]["DADOS"][$i_EsquemaDados]["COL_S"]);
				}
			}
		}
	}
	return $Resultado;
}

/**
 * Funcao para ler dados de uma linha a partir de um esquema
 * @param array $P_EsquemaLinha Esquema a ser lido
 * @param array $P_Linha Conteudo do Arquivo a ser lido
 * @return string Conteudo extraido dos dados
 */

function EsquemaLinha($P_EsquemaLinha, $P_Linha)
{
	$Resultado = array();

	for ($i_EsquemaDados = 0; $i_EsquemaDados < count($P_EsquemaLinha["DADOS"]); $i_EsquemaDados++) {
		$Resultado[$i_EsquemaDados][$P_EsquemaLinha["DADOS"][$i_EsquemaDados]["NOME"]] = LerConteudoLinha($P_Linha, $P_EsquemaLinha["DADOS"][$i_EsquemaDados]["COL_I"], $P_EsquemaLinha["DADOS"][$i_EsquemaDados]["COL_F"], $P_EsquemaLinha["DADOS"][$i_EsquemaDados]["COL_S"]);
	}
	/*echo $P_Linha;
																																														   print_r($Resultado);*/
	return $Resultado;

}

/**
 * Funcao para converter Data em formato TXT para UnixTime;
 * @param string $P_DataStr Data informada
 * @return date Data no formato Unix
 */
function DataTXTTOUnixTime($P_DataStr)
{
	return mktime(0, 0, 0, substr($P_DataStr, 2, 2), substr($P_DataStr, 0, 2), substr($P_DataStr, 4, 4));
}

/**
 * Funcao para converter Data do Banco de Dados para UnixTime;
 * @param string $P_DataStr Data informada
 * @param boolean $p_hora = true Hora relevante
 * @return date Data no formato Unix
 */
function DataDBTOUnixTime($P_DataStr, $p_hora = true)
{
	$tmp_dia = substr($P_DataStr, 8, 2);
	$tmp_mes = substr($P_DataStr, 5, 2);
	$tmp_ano = substr($P_DataStr, 0, 4);
	$tmp_hora = substr($P_DataStr, 11, 2);
	$tmp_minuto = substr($P_DataStr, 14, 2);
	$tmp_segundo = substr($P_DataStr, 17, 2);
	$tmp_data = $tmp_dia . "/" . $tmp_mes . "/" . $tmp_ano;
	if ($p_hora == false) {
		$tmp_hora = "00";
		$tmp_minuto = "00";
		$tmp_segundo = "00";
	}
	if (($tmp_hora != "00") and ($tmp_minuto != "00") and ($tmp_segundo != "00"))
		$tmp_data .= " " . $tmp_hora . ":" . $tmp_minuto . ":" . $tmp_segundo;
	$tmp_data = mktime($tmp_hora, $tmp_minuto, $tmp_segundo, $tmp_mes, $tmp_dia, $tmp_ano);
	return $tmp_data;
}

/**
 * Funcao para incrementar Caracteres a Esquerda de uma String;
 * @param string $p_texto Texto destino que ira receber os caracteres
 * @param char $p_caracter Caracter a ser incrementado
 * @param integer $p_quantidade Quantidade de caracteres a ser incrementado
 * @param boolean $p_reverse = false {Se true incrementa no final do texto}
 * @return string Texto com os caracteres incrementados
 */
function IncrementaCharEsqueda($p_texto, $p_caracter, $p_quantidade, $p_reverse = false)
{
	$texto = $p_texto;
	if (strlen($p_texto) > $p_quantidade)
		$texto = substr($p_texto, strlen($p_texto) - $p_quantidade, strlen($p_texto));

	if ($p_reverse) {
		for ($i = strlen($p_texto); $i < $p_quantidade; $i++) {
			$texto = $texto . $p_caracter;
		}
	} else {
		for ($i = strlen($p_texto); $i < $p_quantidade; $i++) {
			$texto = $p_caracter . $texto;
		}
	}
	return $texto;
}

/**
 * Funcao para remover acentos
 * @param string $p_var Texto com acentos
 * @return string Texto com os acentos removidos
 */
function RemoverAcentos($p_var)
{

	$var = $p_var;

	$var = ereg_replace("[���ê]", "A", $var);
	$var = ereg_replace("[���]", "U", $var);
	$var = ereg_replace("[����]", "U", $var);
	$var = ereg_replace("[�����]", "U", $var);
	$var = ereg_replace("[����]", "U", $var);
	$var = str_replace("�", "C", $var);

	$var = ereg_replace("[����]", "a", $var);
	$var = ereg_replace("[���]", "e", $var);
	$var = ereg_replace("[����]", "i", $var);
	$var = ereg_replace("[�����]", "o", $var);
	$var = ereg_replace("[���]", "u", $var);
	$var = str_replace("�", "c", $var);

	return $var;
}

/**
 * Funcao para converter Data em formato Banco de Dados para Time Stamp
 * @param date $p_data Data no formato DB
 * @return date Data em formato TimeStamp
 */
function DateDBToTimeStamp($p_data)
{
	$tmp_dia = substr($p_data, 8, 2);
	$tmp_mes = substr($p_data, 5, 2);
	$tmp_ano = substr($p_data, 0, 4);
	$tmp_hora = substr($p_data, 11, 2);
	$tmp_minuto = substr($p_data, 14, 2);
	$tmp_segundo = substr($p_data, 17, 2);
	return mktime($tmp_hora, $tmp_minuto, $tmp_segundo, $tmp_mes, $tmp_dia, $tmp_ano);
}

/**
 * Funcao para converter Data em formato Banco de Dados para Formato em DataSet {Utilizado em Delphi}
 * @param date $p_data Data no formato DB
 * @return date Data em formato DataSet
 */
function DateDBToTimeDataSet($p_data)
{
	$tmp_dia = substr($p_data, 8, 2);
	$tmp_mes = substr($p_data, 5, 2);
	$tmp_ano = substr($p_data, 0, 4);
	$tmp_hora = substr($p_data, 11, 2);
	$tmp_minuto = substr($p_data, 14, 2);
	$tmp_segundo = substr($p_data, 17, 2);
	$Resultado = $tmp_ano . $tmp_mes . $tmp_dia . "T" . $tmp_hora . ":" . $tmp_minuto . ":" . $tmp_segundo;
	return $Resultado;
}

/**
 * Funcao para verificar a validade do endere&ccedil; de e-mail
 * @param string $p_email Endere&ccedil;o de e-mail
 * @return boolean
 */
function isMail($email)
{
	$er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
	if (preg_match($er, $email)) {
		return true;
	} else {
		return false;
	}
}

/**
 * Funcao para calcular diferen&ccedil;as entre datas
 *
 * Calcular diferen?a entre Dias (3? par?metro D).
 * $d1 = "2011-01-01";
 * $d2 = "2011-01-10";
 * echo diffDate($d1,$d2,'D');
 *
 * Calcular diferen?a entre Meses (3? par?metro M).
 * $d1 = "2011-01-01";
 * $d2 = "2011-02-01";
 * echo diffDate($d1,$d2,'M');
 *
 * Calcular diferen?a em Minutos (3? par?metro MI).
 * $d1 = "2011-01-01";
 * $d2 = "2011-02-01";
 * echo diffDate($d1,$d2,'MI');
 *
 * Calcular diferen?a entre Anos (3? par?metro A).
 * $d1 = "2010-01-01";
 * $d2 = "2011-01-01";
 * echo diffDate($d1,$d2,'A');
 *
 * Calcular diferen?a em Horas (3? par?metro H).
 * $d1 = "2011-01-01";
 * $d2 = "2011-02-01";
 * echo diffDate($d1,$d2,'H');
 *
 * Calcular diferenca em Dias com separador ?/?  (3? par?metro D e 4? par?metro / ).
 * $d1 = "2011/01/01";
 * $d2 = "2011/02/01";
 * echo diffDate($d1,$d2,'D',"/");
 *
 * Calcular diferen?a em Segundos (omitindo o 3 e 4 parametro ).
 * $d1 = "2011-01-01";
 * $d2 = "2011-02-01";
 * echo diffDate($d1,$d2);
 *
 * @param date $d1 Data inicial
 * @param date $d2 Data final
 * @param string $type Tipo de calculo {A-Ano;M-Mes;D-Dia;H-Hora;MI-Minutos}
 * @return floor Valor da diferenca entre datas
 */

function diffDate($d1, $d2, $type = '', $sep = '-')
{
	$d1 = explode($sep, $d1);
	$tmpD1 = explode(" ", $d1[2]);
	$d1[2] = $tmpD1[0];

	$d2 = explode($sep, $d2);
	$tmpD2 = explode(" ", $d2[2]);
	$d2[2] = $tmpD2[0];

	switch ($type) {
		case 'A':
			$X = 31536000;
			break;
		case 'M':
			$X = 2592000;
			break;
		case 'D':
			$X = 86400;
			break;
		case 'H':
			$X = 3600;
			break;
		case 'MI':
			$X = 60;
			break;
		default:
			$X = 1;
	}

	//die("--".print_r($d1)." --- - ".print_r($d2)." -- '");
	$T1 = mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]);
	$T2 = mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]);
	$DT = $T2 - $T1;
	if ($DT < 0)
		$DT = $DT * -1;
	$DT = $DT / $X;
	return floor($DT);
}

/**
 * Funcao capturar o IP na internet
 * @return string Endere&ccedil;o IP
 */
function MeuIPNET()
{
	/*
																																														   $SiteIP = "http://www.kromus.com.br/meuip.php";
																																														   $LinhasSite = file_get_contents($SiteIP);
																																														   return $LinhasSite;
																																														   */
	return $_SERVER["REMOTE_ADDR"]; // este procedimento � tempor�rio
}

/**
 * Funcao para Converter Dados(array) em DataSet(xml)
 * @param array $P_Dados Dados a serem enviados
 * @param array $P_Campos Chaves dos Dados
 * @return string DataSet dados em XML
 */
function DadosToDataset($P_Dados, $P_Campos)
{
	$_Script_DataSet_Linhas = "";
	$_Script_DataSet_Fields = "";
	/* INICIO DO ESQUEMA XML */
	$_Script_DataSet = "<?xml version=\"1.0\" standalone=\"yes\"?>
	                 <DATAPACKET Version=\"2.0\">
	                 <METADATA>
	                 <FIELDS>";
	/* CAMPOS DOS DADOS XML */
	for ($i = 0; $i < count($P_Campos); $i++) {
		$_TipoDados_DataSet = $P_Campos[$i]['type'];
		switch ($_TipoDados_DataSet) {
			case "INTEGER":
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\" fieldtype=\"i" . $P_Campos[$i]['length'] . "\"/>";
				break;
			case "boolean":
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\"  fieldtype=\"boolean\"/>";
				break;
			case "DOUBLE PRECISION":
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\"  fieldtype=\"r8\"/>";
				break;
			case "TIMESTAMP":
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\"  fieldtype=\"DateTime\"/>";
				break;
			case "VARCHAR":
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\" fieldtype=\"string\" WIDTH=\"" . $P_Campos[$i]['length'] . "\" />";
				break;
			default:
				$_Script_DataSet_Fields .= "
			                           <FIELD attrname=\"" . $P_Campos[$i]['name'] . "\" fieldtype=\"bin.hex\" WIDTH=\"" . $P_Campos[$i]['length'] . "\" SUBTYPE=\"Text\"/>";
		}
	}
	$_Script_DataSet .= $_Script_DataSet_Fields;
	$_Script_DataSet .= "
	                   </FIELDS>
	                   </METADATA>
	                   <ROWDATA>";
	/* DADOS XML */
	for ($i = 0; $i < count($P_Dados); $i++) {
		$_Script_DataSet_Linhas .= "
		                           <ROW ";
		for ($j = 0; $j < count($P_Dados[$i]); $j++) {
			switch ($P_Campos[$j]['type']) {
				case "TIMESTAMP":
					$_Script_DataSet_Linhas .= $P_Campos[$j]['name'] . "=\"" . DateDBToTimeDataSet($P_Dados[$i][$P_Campos[$j]['name']]) . "\" ";
					break;
				default:
					$_Script_DataSet_Linhas .= $P_Campos[$j]['name'] . "=\"" . $P_Dados[$i][$P_Campos[$j]['name']] . "\" ";
			}
		}
		$_Script_DataSet_Linhas .= "/>";
	}
	$_Script_DataSet .= $_Script_DataSet_Linhas;
	/* FIM DO ESQUEMA XML */
	$_Script_DataSet .= "
	                    </ROWDATA>
	                    </DATAPACKET>";
	$R_XMLDataset = $_Script_DataSet;
	return $R_XMLDataset;
}
/**
 * Converte linhas CSV em um vetor de Dados
 * @param array $p_FileCSV Linhas do arquivo em CSV
 * @param array $p_ChavesCSV Colunas das linhas do arquivo em CSV {Vazio Retorna - Ordem num�rica}
 * @param boolean $p_LinhaChave0 Define se a linha Zero(0) � as chaves(colunas)
 * @return array Dados em uma matriz
 */
function CSV2Dados($p_LinhasCSV, $p_ChavesCSV = "", $p_LinhaChave0 = false)
{

	if ($p_LinhasCSV == "") {
		return false;
		exit;
	}

	$h = 0;
	for ($i = 0; $i < count($p_LinhasCSV); $i++) {
		if (trim($p_LinhasCSV[$i]) != '') {
			$tmp_LinhaCSV[$h] = explode(';', $p_LinhasCSV[$i]);
			if ($p_LinhaChave0 && ($i == 0)) {
				if (is_array($tmp_LinhaCSV[0])) {
					for ($p = 0; $p < count($tmp_LinhaCSV[0]); $p++) {
						$p_ChavesCSV[$p]['name'] = $tmp_LinhaCSV[0][$p];
					}
				}
			}
			if (($p_ChavesCSV != "") && is_array($p_ChavesCSV) && is_array($tmp_LinhaCSV[$h])) {
				for ($j = 0; $j < count($p_ChavesCSV); $j++) {
					if ($p_LinhaChave0) {
						if ($h > 0)
							$tmp_linhaRetorno[$h][$p_ChavesCSV[$j]['name']] = $tmp_LinhaCSV[$h][$j];
					} else {
						$tmp_linhaRetorno[$h][$p_ChavesCSV[$j]['name']] = $tmp_LinhaCSV[$h][$j];
					}
				}
			}
			$h++;
		}
	}
	if (isset($tmp_linhaRetorno))
		$tmp_LinhaCSV = $tmp_linhaRetorno;
	return $tmp_LinhaCSV;
}

/**
 * Converte um vetor de Dados em linhas CSV 
 * @param array $p_Dados Linhas do arquivo em CSV
 * @param boolean $p_LinhaChave0 Define se a linha Zero(0) � a chave(colunas)
 * @return Texto Retorno em CSV
 */
function Dados2CSV($p_Dados, $p_LinhaChave0 = false)
{

	if (!is_array($p_Dados)) {
		return false;
		exit;
	}
	$tmp_TextoCSV = "";

	$tmp_Chaves = array_keys($p_Dados[0]);
	if ($p_LinhaChave0) {
		$tmp_var = "";
		for ($i = 0; $i < count($tmp_Chaves); $i++) {
			$tmp_var .= $tmp_Chaves[$i] . ';';
		}
		$tmp_TextoCSV = $tmp_var . "\n";
	}

	for ($i = 0; $i < count($p_Dados); $i++) {
		$tmp_var = '';

		for ($j = 0; $j < count($tmp_Chaves); $j++) {
			$tmp_var .= $p_Dados[$i][$tmp_Chaves[$j]] . ';';
		}
		$tmp_TextoCSV .= $tmp_var . "\n";

	}

	return $tmp_TextoCSV;
}

/**
 * Funcao para converter Data do tipo texto em data UnixTime
 * @param texto $p_data Data do tipo texto
 * @param texto $p_formato Formato que a data se encontra
 * @return date Data em formato UnixTime
 */
function DateFormatToUnixTime($p_data, $p_formato)
{
	$p_data = str_replace('"', '', $p_data);
	$tmp_data = strptime($p_data, $p_formato);
	return mktime($tmp_data['tm_hour'], $tmp_data['tm_min'], $tmp_data['tm_sec'], $tmp_data['tm_mon'] + 1, $tmp_data['tm_mday'], $tmp_data['tm_year'] + 1900);

}

/**
 * Funcao para converter Segundos em Tempo
 * @param texto $p_TempoSegundos  Tempo em segundos
 * @return texto Formato de Tempo HH:mm:ss
 */
function SegundosToTempo($p_TempoSegundos)
{
	$tmp_Hora = '00';
	$tmp_Minuto = '00';
	$tmp_Segundos = '00';

	$tmp_Hora = floor($p_TempoSegundos / 3600);
	$tmp_Minuto = floor(($p_TempoSegundos - ($tmp_Hora * 3600)) / 60);
	$tmp_Segundos = ($p_TempoSegundos % 60);

	$tmp_Hora = IncrementaCharEsqueda($tmp_Hora, '0', 2);
	$tmp_Minuto = IncrementaCharEsqueda($tmp_Minuto, '0', 2);
	$tmp_Segundos = IncrementaCharEsqueda($tmp_Segundos, '0', 2);

	return $tmp_Hora . ':' . $tmp_Minuto . ':' . $tmp_Segundos;

}

############################################################################
#                          FORMATA_DADOS                                   #
#--------------------------------------------------------------------------#
# Descrição: Formata os valores de acordo com a necessidade.               #
#--------------------------------------------------------------------------#
############################################################################	
function FORMATA_DADOS($p_dados, $p_campo, $p_formato, $p_tipodado = '')
{

	for ($i = 0; $i < count($p_dados); $i++) {
		$tmp_data = $p_dados[$i][$p_campo];
		if ($p_tipodado == 'data') {
			if (!is_null($tmp_data)) {
				$tmp_dia = substr($tmp_data, 8, 2);
				$tmp_mes = substr($tmp_data, 5, 2);
				$tmp_ano = substr($tmp_data, 0, 4);
				$tmp_hora = substr($tmp_data, 11, 2);
				$tmp_minuto = substr($tmp_data, 14, 2);
				$tmp_segundo = substr($tmp_data, 17, 2);
				$tmp_data = date($p_formato, mktime($tmp_hora, $tmp_minuto, $tmp_segundo, $tmp_mes, $tmp_dia, $tmp_ano));
			}
		}
		if ($p_tipodado == 'moeda') {
			$tmp_data = $p_formato . number_format($tmp_data, 2, ',', '.');
		}
		@$p_dados[$i][$p_campo] = $tmp_data;
	}
	return $p_dados;

}
############################################################################
#                          ORDENA_DADOS                                    #
#--------------------------------------------------------------------------#
# Descrição: Formata os valores de acordo com a necessidade.               #
#--------------------------------------------------------------------------#
############################################################################	
function ORDENA_DADOS($p_dados, $p_campo, $p_ordem = "ASC")
{
	$tmp_dados = $p_dados;
	// Obter uma lista de colunas
	for ($i = 0; $i < count($tmp_dados); $i++) {
		$tmp_coluna[$i] = $tmp_dados[$i][$p_campo];
	}
	if ($p_ordem == "ASC") {
		array_multisort($tmp_coluna, SORT_ASC, $tmp_dados);
	} else {
		array_multisort($tmp_coluna, SORT_DESC, $tmp_dados);
	}
	return $tmp_dados;

}

function FORMATA_CAMPO($p_valor, $p_formato, $p_tipodado = '')
{

	$tmp_data = $p_valor;
	if ($p_tipodado == 'data') {
		if (!is_null($tmp_data)) {
			$tmp_dia = substr($tmp_data, 8, 2);
			$tmp_mes = substr($tmp_data, 5, 2);
			$tmp_ano = substr($tmp_data, 0, 4);
			$tmp_hora = substr($tmp_data, 11, 2);
			$tmp_minuto = substr($tmp_data, 14, 2);
			$tmp_segundo = substr($tmp_data, 17, 2);
			$tmp_data = date($p_formato, mktime($tmp_hora, $tmp_minuto, $tmp_segundo, $tmp_mes, $tmp_dia, $tmp_ano));
		}
	}
	if ($p_tipodado == 'moeda') {
		$tmp_data = $p_formato . number_format($tmp_data, 2, ',', '.');
	}

	return $tmp_data;

}


#ListarArquivosPasta
function ListarArquivosPasta($pLocal, $P_FiltroINI = "", $P_FiltroFIM = "")
{
	if (file_exists($pLocal)) {
		$_ResultArquivos = scandir($pLocal);
	} else {
		echo "\n Diret�rio ou Arquivo n�o existe! \t " . $this->Local . " \n";
		exit;
	}

	$j = -1;
	$VetorResultado = array();
	if (($P_FiltroINI == "") && ($P_FiltroFIM == "")) {
		$VetorResultado = $_ResultArquivos;
		return $VetorResultado;

	}

	if (($P_FiltroINI != "") && ($P_FiltroFIM == "")) {

		for ($i = 0; $i < count($_ResultArquivos); $i++) {
			if (strpos($_ResultArquivos[$i], $P_FiltroINI) === 0)
				$VetorResultado[++$j] = $_ResultArquivos[$i];
		}
		return $VetorResultado;
	}

	if (($P_FiltroFIM != "") && ($P_FiltroINI == "")) {
		for ($i = 0; $i < count($_ResultArquivos); $i++) {
			if (strpos($_ResultArquivos[$i], $P_FiltroFIM) === (strlen($_ResultArquivos[$i]) - strlen($P_FiltroFIM)))
				$VetorResultado[++$j] = $_ResultArquivos[$i];
		}
		return $VetorResultado;
	}

	if (($P_FiltroFIM != "") && ($P_FiltroINI != "")) {
		for ($i = 0; $i < count($_ResultArquivos); $i++) {
			if (
				(strpos($_ResultArquivos[$i], $P_FiltroFIM) === (strlen($_ResultArquivos[$i]) - strlen($P_FiltroFIM))) &&
				(strpos($_ResultArquivos[$i], $P_FiltroINI) === 0)
			)
				$VetorResultado[++$j] = $_ResultArquivos[$i];
		}
		return $VetorResultado;
	}

}
function RemoveExcessoEspaco($pString)
{
	return str_replace("  ", " ", $pString);
}
function RemoveExcessoCaracter($pString, $pCaracter)
{
	return str_replace($pCaracter . $pCaracter, $pCaracter, $pString);
}

function floordec($zahl, $decimals = 2)
{
	return floor($zahl * pow(10, $decimals)) / pow(10, $decimals);
}

function LimparCaracteresArquivo($pTexto)
{
	$Texto = str_replace(" ", "", $pTexto);
	$Texto = str_replace("��", "", $Texto);


	return $Texto;
}

function geraAPIKey($p_PalavraChave = 'SGPadrao', $tamanhoMaximo = 32)
{
	// Palavra-chave
	$palavraChave = 'PREFIXO_';

	// Obtém o timestamp atual
	$timestamp = time();

	// Gera uma string de bytes aleatórios
	$bytesAleatorios = random_bytes(16);  // 16 bytes (128 bits)

	// Combina o timestamp e os bytes aleatórios
	$combinedData = $timestamp . $bytesAleatorios;

	$combinedData = $combinedData . $p_PalavraChave;
	// Converte os bytes combinados para uma representação hexadecimal
	$combinedData = md5($combinedData);

	//$apiKey = bin2hex($combinedData);
	$apiKey = $combinedData;
	// Concatena a palavra-chave à API key

	// Remove caracteres especiais (deixa apenas letras e números)
	$apiKey = preg_replace('/[^a-zA-Z0-9]/', '', $apiKey);

	// Limita o tamanho da API key ao tamanho máximo desejado
	$apiKey = substr($apiKey, 0, $tamanhoMaximo);

	return $apiKey;
}