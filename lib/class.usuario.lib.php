<?php
/**
 * class.usuario.lib.php
 *
 * Classe Usuarios
 *
 * API para manipulacao de usuarios                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         000000000---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                               de dados dos usuarios dos sistemas
 *
 * @author Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version 1.1.0
 * @copyright Copyright � 2006, Marcio Queiroz Jr.
 * @package sistema
 * @subpackage usuarios
 * @category usuarios
 * @todo   Implementacao
 *           - Implementar o metodo Selecionar para todos, com a finalidade de carregar os valores contido em dados escolhido
 *           - Resumir o codigo utilizando mais a Classe ConexaoDB
 *         Documentacao
 *           - Colocar a documentacao em ordem
 *
 * @date 2011-10-20  v. 0.0.0
 * @update 2018-01-28  v. 0.0.1
 *   - Acrecentado as propriedades: {NOME_EXIBIR, FUNCAO, TITULO, DESCRICAO, IMAGEM}
 */
class usuario
{
  private $SISTEMA_;
  public $CODIGO = "";                  // Chave primária de toda tabela
  public $NOME = "";                    // Nome do usuário varchar(100)
  public $NOME_EXIBIR = "";             // Nome do usuário string(20)
  public $EMAIL = "";                   // E-mail do usuário/ login de acesso varchar(200)
  public $FUNCAO = "";                  // Função do usuário no sistema string(20)
  public $TITULO = "";                  // Título do usuário no sistema
  public $SENHA = "";                   // Senha do usuário
  public $PESSOA = "";                  // Código do usuário junto à tabela Pessoas
  public $TIPO = "";                    // Tipo de usuário (opcional)
  public $GRUPO = "";                   // Código do usuário junto à tabela Grupo de Usuários (opcional)
  public $DESCRICAO = "";               // Descrição do usuário no sistema TEXTO
  public $IMAGEM = "";                  // Nome da imagem do usuário que será exibida em seu perfil
  public $USUARIO_CRIOU = "";           // Código do usuário que criou junto à tabela de usuários
  public $SESSAO = "";                  // Código da sessão
  public $DATACRIACAO = "";             // Data de criação do registro
  public $REG_ATIVO = true;
  public $ENTIDADE_DB = "TBL_USUARIOS"; // Nome da tabela de usuários junto ao banco de dados
  public $BD_CONEXAO = null;            // Link de Conexão com o banco de dados
  public $DataBaseConfig = null;

  public function getSISTEMA()
  {
    return $this->SISTEMA_;
  }

  function __construct($p_SISTEMA)
  {
    $this->SISTEMA_ = $p_SISTEMA;
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE'];
    $this->ENTIDADE_DB = $this->DataBaseConfig['ENTIDADE_DB'];
    $this->SESSAO = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['CODIGO'];
    $this->USUARIO_CRIOU = $this->SISTEMA_['SESSAO']['DATABASE']['DATA']['USUARIO'];
    $this->DATACRIACAO = date('Y-m-d_H:i:s');
    $this->ConectaDB();
    //  $this->Connect();                                    # Realiza a Conex�o no Banco de Dados Definido
  }



  function __destruct()
  {
    if (is_object($this->BD_CONEXAO))
      $this->BD_CONEXAO->Disconnect();
    unset($this->BD_CONEXAO);
  }
  private function ConectaDB()
  {
    $this->DataBaseConfig = $this->SISTEMA_['CONFIG']['ARQUIVO']['DATABASE'];
    if ($this->BD_CONEXAO == null)
      $this->BD_CONEXAO = new ConexaoDB(
        $this->DataBaseConfig['HOSTNAME']
        ,
        $this->DataBaseConfig['USERNAME']
        ,
        $this->DataBaseConfig['PASSWORD']
        ,
        $this->DataBaseConfig['DATABASENAME']
        ,
        $this->DataBaseConfig['TIPODB']
      );
  }


  public function incluir()
  {
    unset($this->Data);
    $this->DATACRIACAO = date('Y-m-d H:i:s');

    $this->BD_CONEXAO->Data['NOME'] = $this->NOME;
    $this->BD_CONEXAO->Data['NOME_EXIBIR'] = $this->NOME_EXIBIR;
    $this->BD_CONEXAO->Data['EMAIL'] = $this->EMAIL;
    $this->BD_CONEXAO->Data['FUNCAO'] = $this->FUNCAO;
    $this->BD_CONEXAO->Data['TITULO'] = $this->TITULO;
    $this->BD_CONEXAO->Data['SENHA'] = $this->SENHA;
    $this->BD_CONEXAO->Data['PESSOA'] = $this->PESSOA;
    $this->BD_CONEXAO->Data['TIPO'] = $this->TIPO;
    $this->BD_CONEXAO->Data['GRUPO'] = $this->GRUPO;
    $this->BD_CONEXAO->Data['DESCRICAO'] = $this->DESCRICAO;
    $this->BD_CONEXAO->Data['IMAGEM'] = $this->IMAGEM;
    $this->BD_CONEXAO->Data['USUARIO_CRIOU'] = $this->USUARIO_CRIOU;
    $this->BD_CONEXAO->Data['SESSAO'] = $this->SESSAO;
    $this->BD_CONEXAO->Data['DATACRIACAO'] = $this->DATACRIACAO;
    $this->BD_CONEXAO->Insert($this->ENTIDADE_DB);
    $this->CODIGO = $this->BD_CONEXAO->Id();
    return $this->CODIGO;
  }

  public function alterar()
  {
    unset($this->BD_CONEXAO->Data);                  # Limpa o valor Data contido no ultimo resultado do BD
    $this->BD_CONEXAO->Data['NOME'] = $this->NOME;
    $this->BD_CONEXAO->Data['NOME_EXIBIR'] = $this->NOME_EXIBIR;
    $this->BD_CONEXAO->Data['EMAIL'] = $this->EMAIL;
    $this->BD_CONEXAO->Data['FUNCAO'] = $this->FUNCAO;
    $this->BD_CONEXAO->Data['TITULO'] = $this->TITULO;
    $this->BD_CONEXAO->Data['SENHA'] = $this->SENHA;
    $this->BD_CONEXAO->Data['PESSOA'] = $this->PESSOA;
    $this->BD_CONEXAO->Data['TIPO'] = $this->TIPO;
    $this->BD_CONEXAO->Data['GRUPO'] = $this->GRUPO;
    $this->BD_CONEXAO->Data['DESCRICAO'] = $this->DESCRICAO;
    $this->BD_CONEXAO->Data['IMAGEM'] = $this->IMAGEM;
    $this->BD_CONEXAO->Data['USUARIO_CRIOU'] = $this->USUARIO_CRIOU;
    $this->BD_CONEXAO->Data['SESSAO'] = $this->SESSAO;
    $this->BD_CONEXAO->Data['DATACRIACAO'] = $this->DATACRIACAO;

    $condicao = " CODIGO = '" . $this->CODIGO . "' ";             # Adiciona a Condi��o no registro, se houver
    return $this->BD_CONEXAO->Update($this->BD_CONEXAO->Data, $condicao, $this->ENTIDADE_DB);     # Executa a Alteração do registro no BD
  }


  public function excluir()
  {
    $condicao = " CODIGO = '" . $this->CODIGO . "' ";             # Adiciona a Condi��o no registro, se houver
    return $this->BD_CONEXAO->Exclude($condicao, $this->ENTIDADE_DB);            # Executa a Exclus�o do Registro no BD
  }


  public function listar($p_ordem = "NOME")
  {
    //$sqlListar = "SELECT * FROM ".$this->ENTIDADE_DB." ORDER BY ".$p_ordem;                                  # Seta-se o SQL para realizar a pesquisa dos registros no BD
    $sqlListar = "select USUARIO1.*, USUARIO2.NOME_EXIBIR AS USUARIO_CRIOU_NOME from " . $this->ENTIDADE_DB . " as USUARIO1, " . $this->ENTIDADE_DB . " as USUARIO2
    WHERE
        USUARIO1.USUARIO_CRIOU=USUARIO2.CODIGO ORDER BY USUARIO1." . $p_ordem;


    $this->BD_CONEXAO->Query($sqlListar);                                                   # Executa o comando SQL no BD
    return $this->BD_CONEXAO->ResultConsult();                                               # Retorna com o valor do SQL
  }


  public function consultar($p_ID = "")
  {
    if ($p_ID == "") {
      die("Código Inválido! - Consulta Usuário");
    }
    $sqlConsultar = "SELECT * FROM " . $this->ENTIDADE_DB . " WHERE CODIGO='" . $p_ID . "'";

    $this->BD_CONEXAO->Query($sqlConsultar);                                            # Executa o comando SQL no BD
    $dados = $this->BD_CONEXAO->ResultConsult();
    $tmp_Formato = $this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['DATA_EXIBICAO_FORMATO'];
    $dados = $this->BD_CONEXAO->FORMATA_DADOS($dados, "DATACRIACAO", $tmp_Formato, "data");
    $this->CODIGO = $dados[0]['CODIGO'];        # Seta-se o valor de $dados[0]['CODIGO']
    $this->NOME = $dados[0]['NOME'];        # Seta-se o valor de $dados[0]['NOME']
    $this->NOME_EXIBIR = $dados[0]['NOME_EXIBIR'];        # Seta-se o valor de $dados[0]['NOME_EXIBIR']
    $this->EMAIL = $dados[0]['EMAIL'];        # Seta-se o valor de $dados[0]['EMAIL']
    $this->FUNCAO = $dados[0]['FUNCAO'];        # Seta-se o valor de $dados[0]['FUNCAO']
    $this->TITULO = $dados[0]['TITULO'];        # Seta-se o valor de $dados[0]['TITULO']
    $this->SENHA = $dados[0]['SENHA'];        # Seta-se o valor de $dados[0]['SENHA']
    $this->PESSOA = $dados[0]['PESSOA'];        # Seta-se o valor de $dados[0]['PESSOA']
    $this->TIPO = $dados[0]['TIPO'];        # Seta-se o valor de $dados[0]['TIPO']
    $this->GRUPO = $dados[0]['GRUPO'];        # Seta-se o valor de $dados[0]['GRUPO']
    $this->DESCRICAO = $dados[0]['DESCRICAO'];        # Seta-se o valor de $dados[0]['DESCRICAO']
    $this->IMAGEM = $dados[0]['IMAGEM'];        # Seta-se o valor de $dados[0]['IMAGEM']
    $this->USUARIO_CRIOU = $dados[0]['USUARIO_CRIOU'];        # Seta-se o valor de $dados[0]['USUARIO_CRIOU']
    $this->SESSAO = $dados[0]['SESSAO'];        # Seta-se o valor de $dados[0]['SESSAO']
    $this->DATACRIACAO = $dados[0]['DATACRIACAO'];        # Seta-se o valor de $dados[0]['DATACRIACAO']
    $this->REG_ATIVO = $dados[0]['REG_ATIVO'];        # Seta-se o valor de $dados[0]['DATACRIACAO']

    return true;                       # Retorna Verdadeiro se a consulta foi bem sucedida.
  }

  public function pesquisar($p_campo = "NOME", $p_valor = "")
  {
    if ($p_campo == "")                                                 # Verifica se o campo foi informado para a pesquisa
      $p_campo = "NOME";                                # Atribui-se o campo para pesquisa
    $sqlListar = "SELECT * FROM " . $this->ENTIDADE_DB . " WHERE " . $p_campo . " LIKE '" . $p_valor . "%' ORDER BY " . $p_campo;    # Atribui o sql para a Pesquisa
    $this->BD_CONEXAO->Query($sqlListar);                                        # Executa o comando SQL no BD
    return $this->BD_CONEXAO->ResultConsult();                                    # Retorna com o valor do SQL
  }


  public function login($p_usuario = "", $p_senha = "")
  {
    $tmp_Parametros = $this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS'];
    if ($p_usuario == "") {
      $p_usuario = $tmp_Parametros['txtLoginEmail'];
    }
    if ($p_senha == "") {
      $p_senha = $tmp_Parametros['txtLoginSenha'];
    }
    $sqlLogar = "SELECT * FROM " . $this->ENTIDADE_DB . " WHERE EMAIL='" . $p_usuario . "' AND SENHA='" . $p_senha . "' AND REG_ATIVO='1'";
    $this->BD_CONEXAO->Query($sqlLogar);
    $dados = $this->BD_CONEXAO->ResultConsult();
    //var_dump($this->BD_CONEXAO);die("afasfasfas");

    if ($dados[0]['CODIGO'] == "") {
      $this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = false;
      return false;
    } else {
      $this->Consultar($dados[0]['CODIGO']);
      $this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = true;
      $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'] = $this->CODIGO;
      $this->SISTEMA_['SESSAO']['USUARIO']['NOME'] = $this->NOME;
      return true;
    }
  }

  /**
   * Altera a senha de um determinado Usuário
   * @param string $p_usuario Username para acesso ao sistema
   * @param string $p_senha Password para acesso ao sistema
   * @param string $p_novaSenha Password a ser modificado
   * @access public
   * @uses ./lib/class.conexao.lib.php Arquivo de manipula��o do banco de dados
   * @return Link
   */
  public function alterarSenha($p_usuario, $p_senha, $p_novaSenha)
  {
    $sqlLogar = "SELECT * FROM " . $this->ENTIDADE_DB . " WHERE EMAIL='" . $p_usuario . "' AND SENHA='" . $p_senha . "'";
    $this->BD_CONEXAO->Query($sqlLogar);
    $dados = $this->BD_CONEXAO->ResultConsult();
    //var_dump($this->BD_CONEXAO);die("afasfasfas");

    if ($dados[0]['CODIGO'] == "")
      return false;
    else {
      $sqlAlterarSenha = "update " . $this->ENTIDADE_DB . " set SENHA='" . $p_novaSenha . "' WHERE CODIGO='" . $dados[0]['CODIGO'] . "'";
      $this->BD_CONEXAO->Query($sqlAlterarSenha);
      $this->Consultar($dados[0]['CODIGO']);
      return true;
    }
  }

  /**
   * Redefine a senha de um determinado Usuário
   * @param string $p_usuario_ID Codigo do usuario
   * @param string $p_novaSenha Password a ser modificado
   * @access public
   * @uses ./lib/class.conexao.lib.php Arquivo de manipula��o do banco de dados
   * @return Link
   */
  public function redefinirSenha($p_usuario_ID, $p_novaSenha)
  {

    $sqlAlterarSenha = "update " . $this->ENTIDADE_DB . " set SENHA='" . $p_novaSenha . "' WHERE CODIGO='" . $p_usuario_ID . "'";
    $this->BD_CONEXAO->Query($sqlAlterarSenha);
  }
  /**
   * Altera a imagem de um determinado Usuário
   * @access public
   * @uses ./lib/class.conexao.lib.php Arquivo de manipula��o do banco de dados
   * @return Link
   */
  public function AlterarImagem()
  {
    $this->IMAGEM = null;
    $this->CODIGO = $this->SISTEMA_['SESSAO']['USUARIO']['CODIGO'];
    if (class_exists('Arquivo')) {
      $ARQUIVO_ = new Arquivo($this->SISTEMA_);
      $arquivos = $ARQUIVO_->UploadFile();
      unset($ARQUIVO_);
      foreach ($arquivos as $tmp_arquivos) {
        $this->IMAGEM = $tmp_arquivos['CODIGO'];
        $sqlAlterarImagem = "update " . $this->ENTIDADE_DB . " set IMAGEM='" . $this->IMAGEM . "' WHERE CODIGO='" . $this->CODIGO . "'";
        $this->BD_CONEXAO->Query($sqlAlterarImagem);
      }
    }
  }
  /**
   * Exibir a imagem de um determinado Usuário
   * @access public
   * @uses ./lib/class.conexao.lib.php Arquivo de manipula��o do banco de dados
   * @return Link
   */
  public function ExibirImagem()
  {
    //$this->IMAGEM=null;
    $arquivoLink = null;
    if (($this->CODIGO == "") || ($this->CODIGO == null))
      $this->CODIGO = $this->consultar($this->SISTEMA_['SESSAO']['USUARIO']['CODIGO']);
    if (($this->IMAGEM != null) && ($this->IMAGEM != ""))
      if (class_exists('Arquivo')) {
        $ARQUIVO_ = new Arquivo($this->SISTEMA_);
        $arquivoLink = $ARQUIVO_->DownloadFile($this->IMAGEM);
        $arquivoLink = $arquivoLink['LINK'];
        unset($ARQUIVO_);
      }
    return $arquivoLink;
  }


  public function PesquisarTodos($p_PESQUISA = '', $p_Inativos = false, $p_QtdeReg = null)
  {
    $this->ConectaDB();
    $sql_QtdReg = "";
    if ($p_QtdeReg > 0)
      $sql_QtdReg = " FIRST " . $p_QtdeReg;

    $sql_Condicao = "AND (USUARIO1.REG_ATIVO=1)";
    if ($p_Inativos)
      $sql_Condicao = "AND (1=1)";

    $p_PESQUISA = strtoupper($p_PESQUISA);

    $sql_Condicao .= " and (
          (UPPER(USUARIO1.NOME) like '" . $p_PESQUISA . "%') OR 
          (UPPER(USUARIO1.EMAIL) like '" . $p_PESQUISA . "%') OR 
          (UPPER(USUARIO2.NOME_EXIBIR) like '" . $p_PESQUISA . "%') OR 
          (UPPER(USUARIO1.NOME_EXIBIR) like '" . $p_PESQUISA . "%')
          )";

    $sqlListar = "select " . $sql_QtdReg . " USUARIO1.*, USUARIO2.NOME_EXIBIR AS USUARIO_CRIOU_NOME from " . $this->ENTIDADE_DB . " as USUARIO1, " . $this->ENTIDADE_DB . " as USUARIO2
    WHERE
        (USUARIO1.USUARIO_CRIOU=USUARIO2.CODIGO)
        " . $sql_Condicao . "
        ORDER BY USUARIO1.NOME";
    $this->BD_CONEXAO->Query($sqlListar);                                                   # Executa o comando SQL no BD
    return $this->BD_CONEXAO->ResultConsult();                                               # Retorna com o valor do SQL
  }

}

