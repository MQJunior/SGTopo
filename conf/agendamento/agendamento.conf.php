<?php
/**
 * 📄 agendamento.conf.php - Configuração da entidade agendamento
 * 👤 Autor: Márcio Queiroz Jr <mqjunior@gmail.com> | 📅 2025-04-09 | 🏷️ v0.0.0
 * 📦 Pacote: agendamento | 📂 Subpacote: Config
 */

/* CONFIGURAÇÃO DO BANCO DE DADOS */ 
$this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['CONF']['DATABASE'] = $this->SISTEMA_['CONFIG']['SISTEMA']['DATABASE'];
/* NOME DA TABELA DA ENTIDADE NO BANCO DE DADOS */
$this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['CONF']['DATABASE']['TBL_AGENDAMENTO'] = 'TBL_AGENDAMENTO';

/* TABELA USUARIO NO BANCO DE DADOS - RELACIONADA  */
$this->SISTEMA_['ENTIDADE']['AGENDAMENTO']['CONF']['DATABASE']['TBL_USUARIO'] = $this->SISTEMA_['CONFIG']['USUARIO']['DATABASE']['ENTIDADE_DB'];

