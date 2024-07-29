<?php
/**
 * @file sgpadrao.login.bin.php
 * @name login
 * @desc
 *   Script para verificar a autenticacao do usuario
 *
 * @author     Marcio Queiroz Jr <mqjunior@gmail.com>
 * @version    0.0.0 
 * @copyright  Copyright � 2006, Marcio Queiroz Jr.
 * @package    sgpadrao
 * @subpackage bin
 * @todo       
 *
 *
 * @date 2018-01-12  v. 0.0.0
 */

$this->SISTEMA_['SESSAO']['STATUS']['AUTENTICADO'] = false;
$USUARIO_ = new usuario($this->SISTEMA_);

$TMP_AUTENTICADO = false;


// Verificar outros Métodos de Autenticacao Aqui
// Padrão Autenticacao de Usuario (Email, Senha)
$TMP_AUTENTICADO = $USUARIO_->login();
// Fim da Verificacao



if ($TMP_AUTENTICADO) {

  $TMP_SESSAO = new Sessao($USUARIO_->getSISTEMA());
  unset($USUARIO_);

  $TMP_SESSAO->Liberar();
  $TMP_SESSAO->Inicializar();


 

  $this->SISTEMA_ = $TMP_SESSAO->getSISTEMA();
  unset($TMP_SESSAO);

  $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADEPADRAO'];
  $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = "PRINCIPAL";
  unset($this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS']);

} else {
  if (isset($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['LAYOUT_PADRAO'])) {
    $SAIDA_MENSAGEM_ERROR = "As informa��es est�o incorretas!";
    $this->SISTEMA_['ERROR'][] = $SAIDA_MENSAGEM_ERROR;
    $this->SISTEMA_['EXECUTAR']['COMANDO']['ENTIDADE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ENTIDADEPADRAO'];
    $this->SISTEMA_['EXECUTAR']['COMANDO']['ACAO'] = $this->SISTEMA_['CONFIG']['SISTEMA']['ACAOPADRAO'];
    unset($this->SISTEMA_['EXECUTAR']['COMANDO']['PARAMETROS']);
    die("senha errada!" . __LINE__ . ' - ' . __FILE__);
  }
}

$this->ExecutarComando();
