<?php
/**
 * 📄 fatura.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-12 | 🏷️ v0.0.0
 * 📦 Pacote: fatura | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "fatura.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadeFaturaCampos['TXT_FATURA_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadeFaturaCampos['TXT_FATURA_SOLICITANTE']=array('NOME' =>'SOLICITANTE'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>0);
$EntidadeFaturaCampos['TXT_FATURA_DATA_EMISSAO']=array('NOME' =>'DATA_EMISSAO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeFaturaCampos['TXT_FATURA_DATA_VENCIMENTO']=array('NOME' =>'DATA_VENCIMENTO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeFaturaCampos['TXT_FATURA_VALORTOTAL']=array('NOME' =>'VALORTOTAL'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);
$EntidadeFaturaCampos['TXT_FATURA_STATUS']=array('NOME' =>'STATUS'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>true , 'TAMANHO'=>100);

$EntidadeFaturaCampos['TXT_FATURA_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeFaturaCampos['TXT_FATURA_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeFaturaCampos['TXT_FATURA_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeFaturaCampos['TXT_FATURA_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadeFaturaCampos['TXT_FATURA_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
