<?php
/**
 * 📄 recebimento.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "recebimento.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_PROJETO_SERVICO']=array('NOME' =>'PROJETO_SERVICO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>0);
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_TIPO']=array('NOME' =>'TIPO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_DATA_RECEBIMENTO']=array('NOME' =>'DATA_RECEBIMENTO'     , 'TIPO'=>'DATA'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>20);
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_VALOR']=array('NOME' =>'VALOR'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_COMPROVANTE']=array('NOME' =>'COMPROVANTE'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);

$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadeRecebimentoCampos['TXT_RECEBIMENTO_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
