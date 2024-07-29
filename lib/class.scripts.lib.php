<?php
/**
* @file class.scripts.lib.php
* @name scripts
* @desc
*   Classe para manipulaчуo da entidade scripts
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    scripts
* @subpackage classe
* @todo       
*   Descricao todo
*
* @date 2018-04-06  v. 0.0.0
* @update 2018-07-04 v. 0.0.0
*  - Adicionado Mщtodo Executar
*
*/

class Scripts{
/**
 * @var	array $SISTEMA_ Variavel Sistema
 * @access private
 */
  private $SISTEMA_=null;

/**
 * @var	link $TBL_SCRIPTS Nome da Tabela da Entidade
 * @access private
 */     
  private $TBL_SCRIPTS=null;
/**
 * @var	link $TBL_USUARIO Nome da Tabela onde possui registro dos Usuсrios (Relacionamento)
 * @access private
 */       
  private $TBL_USUARIO=null;

/**
 * @var	array $DataBaseConfig Vetor com as configuraчѕes de acesso ao banco de dados
 * @access private
 */   
  private $DataBaseConfig = null;
/**
 * @var	link $DataBaseLink Link de acesso ao Banco de Dados
 * @access private
 */   
  private $DataBaseLink = null;
/**
 * Retorna a Variavel SISTEMA manipulada pela classe
 * @return array Variavel SISTEMA
 * @access public
 */  
  public function getSISTEMA(){
    return $this->SISTEMA_;
  }
/**
 * Carrega a variavel SISTEMA, Configuraчуo do DB e Seta-se as tabelas a serem utilizadas
 * @param array $SISTEMA Variavel SISTEMA
 * @access constructor
 */  
  function __construct($p_SISTEMA){
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['SCRIPTS']['CONF']['DATABASE'];
    $this->TBL_SCRIPTS = $this->DataBaseConfig['TBL_SCRIPTS'];
    $this->TBL_USUARIO = $this->DataBaseConfig['TBL_USUARIO'];
    
  }
/**
 * Libera da Memѓria as variaveis e o Link de conexчуo do Banco de Dados
 * @access destruct
 */
  function __destruct() {
    if (is_object($this->DataBaseLink))
      $this->DataBaseLink->Disconnect();
    unset($this->DataBaseLink);
  }

/**
 * Realiza a conexчуo com o Banco de Dados
 * @access private
 */  
  private function ConectaDB(){
    if ($this->DataBaseLink == null)
      $this->DataBaseLink = new ConexaoDB($this->DataBaseConfig['HOSTNAME'],$this->DataBaseConfig['USERNAME'],$this->DataBaseConfig['PASSWORD'],$this->DataBaseConfig['DATABASENAME'],$this->DataBaseConfig['TIPODB'],$this->SISTEMA_);
  }

/**
 * Desativa um registro no Banco de Dados setando o Valor de REG_ATIVO para 0
 * Realiza a consulta do registro no Banco de Dados
 * @param integer $p_Codigo Chave do registro a ser desativado
 * @access public
 */  
  public function Desativar($p_Codigo){
    $this->ConectaDB();
    $sql_Alterar = "update ".$this->TBL_SCRIPTS." set REG_ATIVO='0' where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Alterar);
    $this->Consultar($p_Codigo);
  }
/**
 * Ativa um registro no Banco de Dados setando o Valor de REG_ATIVO para 1
 * Realiza a consulta do registro no Banco de Dados
 * @param integer $p_Codigo Chave do registro a ser ativado
 * @access public
 */ 
  public function Ativar($p_Codigo){
    $this->ConectaDB();
    $sql_Alterar = "update ".$this->TBL_SCRIPTS." set REG_ATIVO='1' where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Alterar);
    $this->Consultar($p_Codigo);
  }
/**
 * Exclui um registro no Banco de Dados 
 * @param integer $p_Codigo Chave do registro a ser excluido
 * @access public
 */   
  public function Excluir($p_Codigo){
    $this->ConectaDB();
    $sql_Excluir = "DELETE FROM ".$this->TBL_SCRIPTS." where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Excluir);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['EXCLUSAO'];
    $this->PesquisarNome();
  }
 /**
 * Executa um script a partir de um registro no Banco de Dados
 * @param integer $p_Codigo Chave do registro a ser executado
 * @access public
 * @desc Tipo 1-PHP; 2-SHELL; 3-CMD(Windows);
 */ 
  public function Executar($p_Codigo){
    $this->Consultar($p_Codigo);
    if ($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['TIPO']==1){
      eval($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['SCRIPT']);
    }
    
    if ($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['TIPO']==2){
      if (PHP_OS === 'Linux')
        exec($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['SCRIPT']);
    }
    
    if ($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['TIPO']==3){
      if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        exec($this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']['SCRIPT']);
    }
  }
/**
 * Lista os registro no Banco de Dados
 * @param boolean $p_Inativos Seta-se true para listar registros desativados
 * @param boolean $p_QtdeReg Seta-se a quantidade de registro exibido
 * @access public
 */     
  public function Listar($p_Inativos=false,$p_QtdeReg=null){
    $this->ConectaDB();
    $sql_QtdReg="";
    if($p_QtdeReg>0){
      $sql_QtdReg=" FIRST ".$p_QtdeReg;
    }
    $sql_Condicao = "(Scripts.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
    $sql_Listar = "select ".$sql_QtdReg." Scripts.*
    FROM  ".$this->TBL_SCRIPTS." as Scripts
      where
        ".$sql_Condicao."
    order by Scripts.NOME";
    
    $this->DataBaseLink->Query($sql_Listar);
    $this->SISTEMA_['ENTIDADE']['SCRIPTS']['DADOS']= $this->DataBaseLink->ResultConsult();
  }
/**
 * Pesquisa os registro no Banco de Dados pelo CAMPO nome
 * @param string $p_NOME Seta-se o nome a ser pesquisado
 * @param boolean $p_Inativos Seta-se true para listar registros desativados
 * @param boolean $p_QtdeReg Seta-se a quantidade de registro exibido
 * @access public
 */     
  public function PesquisarNome($p_NOME='',$p_Inativos=false,$p_QtdeReg=null){
    $this->ConectaDB();
    $sql_QtdReg="";
    if($p_QtdeReg>0)
      $sql_QtdReg=" FIRST ".$p_QtdeReg;
    
    $sql_Condicao = "(Scripts.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
      
    $sql_Condicao .= " and (Scripts.NOME like '".$p_NOME."%')";
    
    $sql_PesquisarNome = "select ".$sql_QtdReg." Scripts.*
    FROM  ".$this->TBL_SCRIPTS." as Scripts
      where
        ".$sql_Condicao."
    order by Scripts.NOME";
    
    $this->DataBaseLink->Query($sql_PesquisarNome);
    $this->SISTEMA_['ENTIDADE']['SCRIPTS']['DADOS']= $this->DataBaseLink->ResultConsult();
  }
/**
 * Pesquisa os registro no Banco de Dados pelo CAMPO Selecionado
 * @param string $p_CAMPO Seta-se o nome do campo
 * @param string $p_VALOR Seta-se o valor a ser pesquisado
 * @param boolean $p_Inativos Seta-se true para listar registros desativados
 * @param integer $p_QtdeReg Seta-se a quantidade de registro exibido
 * @access public
 */     
  public function Pesquisar($p_CAMPO='NOME',$p_VALOR='',$p_Inativos=false,$p_QtdeReg=null){
    $this->ConectaDB();
    $sql_QtdReg="";
    if($p_QtdeReg>0)
      $sql_QtdReg=" FIRST ".$p_QtdeReg;
    
    $sql_Condicao = "(Scripts.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
      
    $sql_Condicao .= " and (Scripts.$p_CAMPO like '".$p_VALOR."%')";
    
    $sql_PesquisarNome = "select ".$sql_QtdReg." Scripts.*, Usuario.NOME_EXIBIR USUARIO_NOME
    FROM  ".$this->TBL_SCRIPTS." as Scripts
    Left join
        ".$this->TBL_USUARIO." as Usuario on (Usuario.codigo = Scripts.usuario) 
      where
        ".$sql_Condicao."
    order by Scripts.".$p_CAMPO;
    
    $this->DataBaseLink->Query($sql_PesquisarNome);
    $this->SISTEMA_['ENTIDADE']['SCRIPTS']['DADOS']= $this->DataBaseLink->ResultConsult();
  }
/**
 * Consulta um registro no Banco de Dados 
 * @param integer $p_Codigo Chave do registro a ser consultado
 * @access public
 */    
  public function Consultar($p_Codigo){
    $this->ConectaDB();
    $sql_Consultar = "select Scripts.*, Usuario.NOME_EXIBIR USUARIO_NOME
    FROM  ".$this->TBL_SCRIPTS." as Scripts
    Left join
        ".$this->TBL_USUARIO." as Usuario on (Usuario.codigo = Scripts.usuario)
      where
        Scripts.codigo = '".$p_Codigo."'";
    
    $this->DataBaseLink->Query($sql_Consultar);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    $this->SISTEMA_['ENTIDADE']['SCRIPTS']['VARS']=$tmpDados[0];
  }
/**
 * Inclui um registro no Banco de Dados 
 * @param array $p_Dados Vetor com as Chaves e valores a serem inseridos no Banco de Dados
 * @access public
 */     
  public function Incluir($p_Dados){
    $this->ConectaDB();
    $this->DataBaseLink->Data=array();
    $this->DataBaseLink->Data=$p_Dados;
    $this->DataBaseLink->Data['USUARIO'] = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    $this->DataBaseLink->Data['SESSAO'] = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
    $this->DataBaseLink->Data['DATACRIACAO'] = date($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_HORA_ARMAZENAMENTO_FORMATO']);
    $this->DataBaseLink->Data['REG_ATIVO'] = '1';
    $this->DataBaseLink->Insert($this->TBL_SCRIPTS);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['MENSAGEM'];
    $this->Consultar($this->DataBaseLink->Id());
  }
/**
 * Altera um registro no Banco de Dados 
 * @param array $p_Dados Vetor com as Chaves e valores a serem alterados no Banco de Dados
 * @param array $p_Codigo Chave do Registro a ser alterado
 * @access public
 */       
  public function Alterar($p_Dados, $p_Codigo){
    $this->ConectaDB();
    $sql_Complemento =" codigo=".$p_Codigo;
    foreach($p_Dados as $tmpCampo => $tmpValor){
      if (($tmpValor=="null")||($tmpValor==null))
        $sql_Complemento.=", ".$tmpCampo." = null ";
      else
        $sql_Complemento.=", ".$tmpCampo." = '".$tmpValor."' ";
    }
    $sql_Alterar = "update ".$this->TBL_SCRIPTS." set ".$sql_Complemento." where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Alterar);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['SCRIPTS']['MENSAGEM']['SUCESSO']['MENSAGEM'];
    $this->Consultar($p_Codigo);
  }
}
?>