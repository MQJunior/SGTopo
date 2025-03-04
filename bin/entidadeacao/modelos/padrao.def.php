<?php
/**
 * 📄 padrao.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2018-02-22 | 🏷️ v0.0.0
 * 📦 Pacote: padrao | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include("padrao.idioma.".strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']).".def.php");

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadePadraoCampos['TXT_PADRAO_CODIGO'] = array('NOME' =>'CODIGO', 'TIPO'=>'CODIGO', 'EXIBIR'=>false, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>0);

/** 🔄 Buscar no Banco de Dados */
$EntidadePadraoCampos['TXT_PADRAO_SESSAO'] = array('NOME' =>'SESSAO', 'TIPO'=>'CODIGO_LINK', 'EXIBIR'=>false, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_USUARIO'] = array('NOME' =>'USUARIO', 'TIPO'=>'CODIGO_LINK', 'EXIBIR'=>false, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_USUARIO_NOME'] = array('NOME' =>'USUARIO_NOME', 'TIPO'=>'CODIGO_LINK', 'EXIBIR'=>false, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>0);
$EntidadePadraoCampos['TXT_PADRAO_DATACRIACAO'] = array('NOME' =>'DATACRIACAO', 'TIPO'=>'DATA', 'EXIBIR'=>true, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>20);
$EntidadePadraoCampos['TXT_PADRAO_REG_ATIVO'] = array('NOME' =>'REG_ATIVO', 'TIPO'=>'TIPO', 'EXIBIR'=>false, 'PESQUISAR'=>false, 'REQUERIDO'=>false, 'TAMANHO'=>1);

?>
