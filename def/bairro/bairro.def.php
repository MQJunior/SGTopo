<?php
/**
 * 📄 bairro.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: bairro | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "bairro.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadeBairroCampos['TXT_BAIRRO_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadeBairroCampos['TXT_BAIRRO_NOME']=array('NOME' =>'NOME'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeBairroCampos['TXT_BAIRRO_CIDADE']=array('NOME' =>'CIDADE'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>0);
$EntidadeBairroCampos['TXT_BAIRRO_COORDENADAS']=array('NOME' =>'COORDENADAS'     , 'TIPO'=>'NOME_TEXTO'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>500);
$EntidadeBairroCampos['TXT_BAIRRO_CAMINHO']=array('NOME' =>'CAMINHO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);

$EntidadeBairroCampos['TXT_BAIRRO_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeBairroCampos['TXT_BAIRRO_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeBairroCampos['TXT_BAIRRO_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeBairroCampos['TXT_BAIRRO_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadeBairroCampos['TXT_BAIRRO_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
