<?php
/**
 * 📄 pessoa.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: pessoa | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "pessoa.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadePessoaCampos['TXT_PESSOA_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadePessoaCampos['TXT_PESSOA_NOME']=array('NOME' =>'NOME'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadePessoaCampos['TXT_PESSOA_CPF_CNPJ']=array('NOME' =>'CPF_CNPJ'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadePessoaCampos['TXT_PESSOA_TELEFONE']=array('NOME' =>'TELEFONE'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);
$EntidadePessoaCampos['TXT_PESSOA_EMAIL']=array('NOME' =>'EMAIL'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);

$EntidadePessoaCampos['TXT_PESSOA_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadePessoaCampos['TXT_PESSOA_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadePessoaCampos['TXT_PESSOA_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadePessoaCampos['TXT_PESSOA_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadePessoaCampos['TXT_PESSOA_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
