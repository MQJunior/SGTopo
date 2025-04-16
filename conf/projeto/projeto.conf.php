<?php
/**
 * 📄 projeto.conf.php - Configuração da entidade projeto
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: projeto | 📂 Subpacote: Config
 */

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['PROJETO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['PROJETO']['CONF']['DATABASE']['TBL_PROJETO'] = 'TBL_PROJETOS';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['PROJETO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

