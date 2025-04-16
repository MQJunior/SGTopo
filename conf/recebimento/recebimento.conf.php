<?php
/**
 * 📄 recebimento.conf.php - Configuração da entidade recebimento
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-03-04 | 🏷️ v0.0.0
 * 📦 Pacote: recebimento | 📂 Subpacote: Config
 */

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['RECEBIMENTO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['RECEBIMENTO']['CONF']['DATABASE']['TBL_RECEBIMENTO'] = 'TBL_RECEBIMENTOS';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['RECEBIMENTO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

