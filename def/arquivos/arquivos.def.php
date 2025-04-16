<?php
/**
 * 📄 arquivos.def.php - Definição dos campos no Banco de Dados e UID da Sessao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: arquivos | 📂 Subpacote: Def
 */

/** 🆔 UID da Sessao */
$SistemaSessaoUID = $this->SISTEMA_['SESSAO']['CLIENTE']['SESSAO_UID'];
include "arquivos.idioma." . strtolower($this->SISTEMA_['CONFIG']['SISTEMA']['GERAL']['IDIOMA']) . ".def.php";

/** 🗄️ Definições dos Campos no Banco de Dados */
$EntidadeArquivosCampos['TXT_ARQUIVOS_CODIGO'] = ['NOME' => 'CODIGO', 'TIPO' => 'CODIGO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];

/** 🔄 Buscar no Banco de Dados */
$EntidadeArquivosCampos['TXT_ARQUIVOS_NOME']=array('NOME' =>'NOME'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);
$EntidadeArquivosCampos['TXT_ARQUIVOS_PROJETO']=array('NOME' =>'PROJETO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeArquivosCampos['TXT_ARQUIVOS_DOCUMENTO']=array('NOME' =>'DOCUMENTO'     , 'TIPO'=>'CODIGO_LINK'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>0);
$EntidadeArquivosCampos['TXT_ARQUIVOS_TIPO']=array('NOME' =>'TIPO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);
$EntidadeArquivosCampos['TXT_ARQUIVOS_CAMINHO']=array('NOME' =>'CAMINHO'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);
$EntidadeArquivosCampos['TXT_ARQUIVOS_STATUS']=array('NOME' =>'STATUS'     , 'TIPO'=>'NOME'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>100);
$EntidadeArquivosCampos['TXT_ARQUIVOS_DATAHORA_UPLOAD']=array('NOME' =>'DATAHORA_UPLOAD'     , 'TIPO'=>'DATA'    , 'EXIBIR'=>true , 'PESQUISAR'=>true , 'REQUERIDO'=>false , 'TAMANHO'=>20);

$EntidadeArquivosCampos['TXT_ARQUIVOS_SESSAO']       = ['NOME' => 'SESSAO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeArquivosCampos['TXT_ARQUIVOS_USUARIO']      = ['NOME' => 'USUARIO', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeArquivosCampos['TXT_ARQUIVOS_USUARIO_NOME'] = ['NOME' => 'USUARIO_NOME', 'TIPO' => 'CODIGO_LINK', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 0];
$EntidadeArquivosCampos['TXT_ARQUIVOS_DATACRIACAO']  = ['NOME' => 'DATACRIACAO', 'TIPO' => 'DATA', 'EXIBIR' => true, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 20];
$EntidadeArquivosCampos['TXT_ARQUIVOS_REG_ATIVO']    = ['NOME' => 'REG_ATIVO', 'TIPO' => 'TIPO', 'EXIBIR' => false, 'PESQUISAR' => false, 'REQUERIDO' => false, 'TAMANHO' => 1];
