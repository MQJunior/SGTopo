<?php
/**
* @file class.tarefas.lib.php
* @name tarefas
* @desc
*   Classe para manipulaчуo da entidade tarefas
*
* @author     Mсrcio Queiroz Jr <mqjunior@gmail.com>
* @version    0.0.0 
* @copyright  Copyright Љ 2006, Mсrcio Queiroz Jr.
* @package    tarefas
* @subpackage classe
* @todo       
*   Descricao todo
*
* @date 2018-03-11  v. 0.0.0
*
*/

class Tarefas{
/**
 * @var	array $SISTEMA_ Variavel Sistema
 * @access private
 */
  private $SISTEMA_=null;

/**
 * @var	link $TBL_TAREFAS Nome da Tabela da Entidade
 * @access private
 */     
  private $TBL_TAREFAS=null;
/**
 * @var	link $TBL_TAREFA_STATUS Nome da Tabela de Status da Tarefa
 * @access private
 */     
  private $TBL_TAREFA_STATUS=null;  
/**
 * @var	link $TBL_USUARIO Nome da Tabela onde possui registro dos Usuсrios (Relacionamento)
 * @access private
 */       
  private $TBL_USUARIO=null;
/**
 * @var	link $TBL_ENTIDADE Nome da Tabela onde possui registro das Entidades (Relacionamento)
 * @access private
 */       
  private $TBL_ENTIDADE=null;
/**
 * @var	link $TBL_ENTIDADEACAO Nome da Tabela onde possui registro das Aчoes das Entidades (Relacionamento)
 * @access private
 */       
  private $TBL_ENTIDADEACAO=null;
  
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
    $this->DataBaseConfig = $this->SISTEMA_['ENTIDADE']['TAREFAS']['CONF']['DATABASE'];
    $this->TBL_TAREFAS = $this->DataBaseConfig['TBL_TAREFAS'];
    $this->TBL_USUARIO = $this->DataBaseConfig['TBL_USUARIO'];
    $this->TBL_TAREFA_STATUS = $this->DataBaseConfig['TBL_TAREFA_STATUS'];

    $this->TBL_ENTIDADE = $this->DataBaseConfig['TBL_ENTIDADE'];
    $this->TBL_ENTIDADEACAO = $this->DataBaseConfig['TBL_ENTIDADEACAO'];

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
    $sql_Alterar = "update ".$this->TBL_TAREFAS." set REG_ATIVO='0' where codigo='".$p_Codigo."'";
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
    $sql_Alterar = "update ".$this->TBL_TAREFAS." set REG_ATIVO='1' where codigo='".$p_Codigo."'";
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
    $sql_Excluir = "DELETE FROM ".$this->TBL_TAREFAS." where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Excluir);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['EXCLUSAO'];
    $this->PesquisarNome();
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
    $sql_Condicao = "(Tarefas.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
    $sql_Listar = "select ".$sql_QtdReg." Tarefas.*
    FROM  ".$this->TBL_TAREFAS." as Tarefas
      where
        ".$sql_Condicao."
    order by Tarefas.NOME";
    
    $this->DataBaseLink->Query($sql_Listar);
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['DADOS']= $this->DataBaseLink->ResultConsult();
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
    
    $sql_Condicao = "(Tarefas.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
      
    $sql_Condicao .= " and (Tarefas.NOME like '".$p_NOME."%')";
    
    $sql_PesquisarNome = "select ".$sql_QtdReg." Tarefas.*, Usuario.NOME_EXIBIR USUARIO_NOME, Entidade.NOME ENTIDADE, EntidadeAcao.NOME ENTIDADEACAO_NOME
    FROM  ".$this->TBL_TAREFAS." as Tarefas
    Left join
        ".$this->TBL_USUARIO." as Usuario on (Usuario.codigo = Tarefas.usuario)
    Left join
        ".$this->TBL_ENTIDADEACAO." as EntidadeAcao on (EntidadeAcao.codigo = Tarefas.entidadeacao)
    Full join
        ".$this->TBL_ENTIDADE." as Entidade on (Entidade.nome = EntidadeAcao.entidade)
      where
        ".$sql_Condicao."
    order by Tarefas.NOME";
    
    $this->DataBaseLink->Query($sql_PesquisarNome);
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['DADOS']= $this->DataBaseLink->ResultConsult();
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
    
    $sql_Condicao = "(Tarefas.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
      
    $sql_Condicao .= " and (Tarefas.$p_CAMPO like '".$p_VALOR."%')";
    
    $sql_PesquisarNome = "select ".$sql_QtdReg." Tarefas.*, Usuario.NOME_EXIBIR USUARIO_NOME , Entidade.NOME ENTIDADE, EntidadeAcao.NOME ENTIDADEACAO_NOME
    FROM  ".$this->TBL_TAREFAS." as Tarefas
    Left join
        ".$this->TBL_USUARIO." as Usuario on (Usuario.codigo = Tarefas.usuario)
    Left join
        ".$this->TBL_ENTIDADEACAO." as EntidadeAcao on (EntidadeAcao.codigo = Tarefas.entidadeacao)
    Full join
        ".$this->TBL_ENTIDADE." as Entidade on (Entidade.nome = EntidadeAcao.entidade)
      where
        ".$sql_Condicao."
    order by Tarefas.".$p_CAMPO;
    
    $this->DataBaseLink->Query($sql_PesquisarNome);
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['DADOS']= $this->DataBaseLink->ResultConsult();
  }
/**
 * Consulta um registro no Banco de Dados 
 * @param integer $p_Codigo Chave do registro a ser consultado
 * @access public
 */    
  public function Consultar($p_Codigo){
    $this->ConectaDB();
    $sql_Consultar = "select Tarefas.*, Usuario.NOME_EXIBIR USUARIO_NOME, Entidade.NOME ENTIDADE, EntidadeAcao.NOME ENTIDADEACAO_NOME
    FROM  ".$this->TBL_TAREFAS." as Tarefas
    Left join
        ".$this->TBL_USUARIO." as Usuario on (Usuario.codigo = Tarefas.usuario)
    Left join
        ".$this->TBL_ENTIDADEACAO." as EntidadeAcao on (EntidadeAcao.codigo = Tarefas.entidadeacao)
    Full join
        ".$this->TBL_ENTIDADE." as Entidade on (Entidade.nome = EntidadeAcao.entidade)
      where
        (Tarefas.codigo = '".$p_Codigo."') ";
    
    //echo $sql_Consultar;
    $this->DataBaseLink->Query($sql_Consultar);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS']=$tmpDados[0];
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
    $this->DataBaseLink->Insert($this->TBL_TAREFAS);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['MENSAGEM'];
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
    $sql_Alterar = "update ".$this->TBL_TAREFAS." set ".$sql_Complemento." where codigo='".$p_Codigo."'";
    $this->DataBaseLink->Query($sql_Alterar);
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['TITULO']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['TITULO'];
    $this->SISTEMA_['MENSAGEM']['SUCESSO']['MENSAGEM']=$this->SISTEMA_['ENTIDADE']['TAREFAS']['MENSAGEM']['SUCESSO']['MENSAGEM'];
    $this->Consultar($p_Codigo);
  }
/**
 * Lista as Entidade e Aчѕes no Banco de Dados
 * @param boolean $p_Inativos Seta-se true para listar registros desativados
 * @param boolean $p_QtdeReg Seta-se a quantidade de registro exibido
 * @access public
 */     
  public function ListarEntidadeAcao($p_Inativos=false,$p_QtdeReg=null){
    $this->ConectaDB();
    $sql_QtdReg="";
    if($p_QtdeReg>0){
      $sql_QtdReg=" FIRST ".$p_QtdeReg;
    }
    $sql_Condicao = "(EntidadeAcao.REG_ATIVO=1)";
    $sql_Condicao = "(1=1)";
    if ($p_Inativos)
      $sql_Condicao = "(1=1)";
    $sql_Listar = "select Entidade.NOME ENTIDADE, EntidadeAcao.NOME ENTIDADEACAO_NOME, EntidadeAcao.CODIGO ENTIDADEACAO_CODIGO
    FROM  ".$this->TBL_ENTIDADEACAO." as EntidadeAcao
    Left join
        ".$this->TBL_ENTIDADE." as Entidade on (Entidade.nome = EntidadeAcao.entidade)
      where
        ".$sql_Condicao." AND (EntidadeAcao.NOME LIKE '%EXECUTAR%')
    order by Entidade.NOME, EntidadeAcao.NOME";
    
    $this->DataBaseLink->Query($sql_Listar);
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['ENTIDADEACAO']['DADOS']= $this->DataBaseLink->ResultConsult();
  }
/**
 * Lista os registros das Entidade e Aчѕes no Banco de Dados
 * @param boolean $p_Inativos Seta-se true para listar registros desativados
 * @access public
 */     
  public function ListarRegistrosEntidade($p_EntidadeAcao=null){
    $this->ConectaDB();
    
    if ($p_EntidadeAcao == null)
      $p_EntidadeAcao = $this->SISTEMA_['ENTIDADE']['TAREFAS']['VARS']['ENTIDADEACAO'];
    
    $sql_NomeTabela = "select Entidade.NOME ENTIDADE, Entidade.TABELA TABELA, EntidadeAcao.CODIGO ENTIDADEACAO_CODIGO
    FROM  ".$this->TBL_ENTIDADEACAO." as EntidadeAcao
    Left join
        ".$this->TBL_ENTIDADE." as Entidade on (Entidade.nome = EntidadeAcao.entidade)
      where
        (EntidadeAcao.CODIGO = '".$p_EntidadeAcao."')
    order by Entidade.TABELA";
    
    $this->DataBaseLink->Query($sql_NomeTabela);
    $tmpDados = $this->DataBaseLink->ResultConsult();
    
    $tmpNomeTabela = $tmpDados[0]['TABELA'];
    
    
    $sql_Listar = "select TABELA.*
    FROM  ".$tmpNomeTabela." as TABELA
        
    order by TABELA.NOME";
    
    $this->DataBaseLink->Query($sql_Listar);
    $this->SISTEMA_['ENTIDADE']['TAREFAS']['TABELAS']['DADOS']= $this->DataBaseLink->ResultConsult();
  }  
}
?>