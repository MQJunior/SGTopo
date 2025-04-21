<?php
/**
 * 📄 permissao.conf.php - Configuração da entidade permissao
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-20 | 🏷️ v0.0.0
 * 📦 Pacote: permissao | 📂 Subpacote: Config
 */

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['PERMISSAO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['PERMISSAO']['CONF']['DATABASE']['TBL_PERMISSAO'] = 'TBL_PERMISSAO';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['PERMISSAO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

