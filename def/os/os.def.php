<?php
/**
 * 📄 os.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: os | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "os.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadeOsCampos['TXT_OS_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadeOsCampos['TXT_OS_AGENDAMENTO']=array('NOME' =>'AGENDAMENTO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeOsCampos['TXT_OS_LOCAL']=array('NOME' =>'LOCAL'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeOsCampos['TXT_OS_PROJETO']=array('NOME' =>'PROJETO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeOsCampos['TXT_OS_SOLICITANTE']=array('NOME' =>'SOLICITANTE'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeOsCampos['TXT_OS_DESCRICAO']=array('NOME' =>'DESCRICAO'     , 'TIPO'=>'NOME_TEXTO'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>500);
$EntidadeOsCampos['TXT_OS_VALORTOTAL']=array('NOME' =>'VALORTOTAL'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeOsCampos['TXT_OS_SITUACAO']=array('NOME' =>'SITUACAO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeOsCampos['TXT_OS_STATUS']=array('NOME' =>'STATUS'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeOsCampos['TXT_OS_FATURA']=array('NOME' =>'FATURA'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);

$EntidadeOsCampos['TXT_OS_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeOsCampos['TXT_OS_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeOsCampos['TXT_OS_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeOsCampos['TXT_OS_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadeOsCampos['TXT_OS_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
